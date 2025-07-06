<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Course;
use App\Forms\ApplicationForm;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Kris\LaravelFormBuilder\FormBuilder;

class ApplicationController extends Controller
{
    /**
     * Show the application dashboard.
     */
    public function __construct(){
        $this->middleware('can:show_application')->only(['index', 'show']);
        $this->middleware('can:create_application')->only(['create', 'store']);
        $this->middleware('can:edit_application')->only(['edit', 'update']);
        $this->middleware('can:delete_application')->only(['delete']);

    }
    public function index($code, FormBuilder $formBuilder): View
    {
        $course = Course::where('application_code', $code)->where('application_status', 'show')->first();
        if (empty($course)) {
            abort(404, 'NOT FOUND');
        }
        $form = $formBuilder->create(ApplicationForm::class, [
            'method' => 'POST',
            'url' => route('application_link.post', ['code' => $code]),
            'class' => 'row',

        ]);

        return view('application_form', compact('course', 'form'));
    }

    public function store($code, FormBuilder $formBuilder, Request $request): RedirectResponse
    {

        $course = Course::where('application_code', $code)->where('application_status', 'show')->first();
        if (empty($course)) {
            abort(404, 'NOT FOUND');
        }

        $form = $formBuilder->create(ApplicationForm::class);

        if (! $form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        $personal_photo = null;
        if ($request->hasFile('personal_picture')) {
            $file = $request->personal_picture;
            $image = $file;
            $name = time().rand(1000, 555555555).'_'.rand(1000, 555555555).'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/applications');
            $image->move($destinationPath, $name);
            $personal_photo = $name;
        }

        $passport_photos = [];
        if ($request->hasFile('passport_photos')) {
            foreach ($request->passport_photos as $file) {
                $image = $file;
                $name = time().rand(1000, 555555555).'_'.rand(1000, 555555555).'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/uploads/applications');
                $image->move($destinationPath, $name);
                $passport_photos[] = $name;
            }
        }

        $qualification_certificates = [];
        if ($request->hasFile('qualification_certificates')) {
            foreach ($request->qualification_certificates as $file) {
                $image = $file;
                $name = time().rand(1000, 555555555).'_'.rand(1000, 555555555).'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/uploads/applications');
                $image->move($destinationPath, $name);
                $qualification_certificates[] = $name;
            }
        }

        $cv_file = null;
        if ($request->hasFile('cv_file')) {
            $file = $request->cv_file;
            $image = $file;
            $name = time().rand(1000, 555555555).'_'.rand(1000, 555555555).'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/applications');
            $image->move($destinationPath, $name);
            $cv_file = $name;
        }

        $health_certificates = [];
        if ($request->hasFile('health_certificates')) {
            foreach ($request->health_certificates as $file) {
                $image = $file;
                $name = time().rand(1000, 555555555).'_'.rand(1000, 555555555).'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/uploads/applications');
                $image->move($destinationPath, $name);
                $health_certificates[] = $name;
            }
        }

        $other_certificates = [];
        if ($request->hasFile('other_certificates')) {
            foreach ($request->other_certificates as $file) {
                $image = $file;
                $name = time().rand(1000, 555555555).'_'.rand(1000, 555555555).'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/uploads/applications');
                $image->move($destinationPath, $name);
                $other_certificates[] = $name;
            }
        }

        $languages = explode("\n", $request->user_languages);
        $employer_phone = explode("\n", $request->employer_phone);

        $data = $request->only([
            'course_id',
            'first_name',
            'middle_name',
            'last_name',
            'gender',
            'nationality',
            'address',
            'phone_number',
            'email_address',
            'birth_date',
            'personal_picture',
            'passport_id',
            'passport_photos',
            'qualification',
            'qualification_certificates',
            'languages',
            'country',
            'current_employer',
            'employer_address',
            'employer_phone',
            'employer_email',
            'cv_file',
            'health_certificates',
            'other_certificates',
            'trainee_status',
            'export_status',
        ]);

        $data['course_id'] = $course->id;
        $data['phone_number'] = $phone_number;
        $data['personal_picture'] = $personal_photo;
        $data['passport_photos'] = serialize($passport_photos);
        $data['qualification_certificates'] = serialize($qualification_certificates);
        $data['languages'] = serialize($languages);
        $data['employer_phone'] = serialize($employer_phone);
        $data['cv_file'] = $cv_file;
        $data['health_certificates'] = serialize($health_certificates);
        $data['other_certificates'] = serialize($other_certificates);
        $data['export_status'] = 'false';
        //        dd($data);
        Application::create($data);

        //        try{
        //            Application::create($data);
        //        }catch (\Exception $e)
        //        {
        // //            dd($e->getMessage());
        //        }

        flash(trans('main.thank_you_for_apply'))->success();

        return redirect(route('application_link', ['code' => $code]));

    }

    public function changeLang($id): RedirectResponse
    {
        session(['lang' => $id]);

        return redirect()->back();
    }
}
