<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Course;
use App\Exports\ApplicationExport;
use App\Exports\ExportApplicant;
use App\Forms\ApplicationForm;
use App\Http\MyExcel;
use App\Imports\ApplicationImport;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Kris\LaravelFormBuilder\FormBuilder;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Calculation\Category;
use Yajra\DataTables\DataTables;

class ApplicantsController extends Controller
{
    protected $active;

    protected $view;

    protected $route;

    protected $form;

    protected $model;

    protected $title;

    protected $keys;

    protected $table;

    protected $wrapper_class;

    /**
     * Websites Controller constructor.
     */
    public function __construct()
    {
        $this->active = 'applicants';
        $this->view = 'applicants';
        $this->route = 'applicants';
        $this->form = ApplicationForm::class;
        $this->model = Application::class;
        $this->title = 'applicants';
        $this->keys = [
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

        ];
        $this->table = [
            ['name' => 'chk', 'display' => '<input id="check-all" type="checkbox" class="iCheck-square chk-all">', 'data' => 'chk', 'orderable' => 'false', 'searchable' => 'false'],
            ['name' => 'id', 'display' => '#', 'data' => 'id', 'orderable' => 'true', 'searchable' => 'false'],
            ['name' => 'first_name', 'display' => awtTrans('الاسم'), 'data' => 'name', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'gender', 'display' => awtTrans('النوع'), 'data' => 'gender', 'orderable' => 'true', 'searchable' => 'false'],
            ['name' => 'nationality', 'display' => awtTrans('الجنسيه'), 'data' => 'nationality', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'course_name', 'display' => awtTrans('الدورة الحالية'), 'data' => 'course_name', 'orderable' => 'false', 'searchable' => 'false'],
            ['name' => 'course_date', 'display' => awtTrans('تاريخ الدورة	'), 'data' => 'course_date', 'orderable' => 'false', 'searchable' => 'false'],
            ['name' => 'current_employer', 'display' => awtTrans('الوظيفة'), 'data' => 'current_employer', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'age', 'display' => awtTrans('السن'), 'data' => 'age', 'orderable' => 'false', 'searchable' => 'false'],
            ['name' => 'email_address', 'display' => awtTrans('البريد الالكتروني'), 'data' => 'email_address', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'phone', 'display' => awtTrans('الهاتف'), 'data' => 'phone', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'passport_id', 'display' => awtTrans('رقم جواز السفر'), 'data' => 'passport_id', 'orderable' => 'true', 'searchable' => 'true'],
            //            ['name' => 'exported', 'display' => trans('main.exported'), 'data' => 'exported', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'country', 'display' => awtTrans('الدولة'), 'data' => 'country', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'edit', 'display' => awtTrans('تعديل'), 'data' => 'edit', 'orderable' => 'true', 'searchable' => 'true'],

        ];
        $this->wrapper_class = 'form-group';
        $this->middleware('can:show_applicants')->only(['index', 'show']);
        $this->middleware('can:create_applicants')->only(['create', 'store']);
        $this->middleware('can:edit_applicants')->only(['edit', 'update']);
        $this->middleware('can:delete_applicants')->only(['delete']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $this->table = [
            ['name' => 'chk', 'display' => '<input id="check-all" type="checkbox" class="iCheck-square chk-all">', 'data' => 'chk', 'orderable' => 'false', 'searchable' => 'false'],
            ['name' => 'id', 'display' => '#', 'data' => 'id', 'orderable' => 'true', 'searchable' => 'false'],
            ['name' => 'first_name', 'display' => awtTrans('الاسم'), 'data' => 'name', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'gender', 'display' => awtTrans('النوع'), 'data' => 'gender', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'nationality', 'display' => awtTrans('الجنسيه'), 'data' => 'nationality', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'course_id  ', 'display' => awtTrans('الدورة الحالية'), 'data' => 'course_name', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'course_start_date', 'display' => awtTrans('تاريخ البدء'), 'data' => 'course_start_date', 'orderable' => 'false', 'searchable' => 'false'],
            ['name' => 'course_end_date', 'display' => awtTrans('تاريخ الإنتهاء'), 'data' => 'course_end_date', 'orderable' => 'false', 'searchable' => 'false'],
            ['name' => 'current_employer', 'display' => awtTrans('الوظيفة'), 'data' => 'current_employer', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'birth_date', 'display' => awtTrans('السن'), 'data' => 'age', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'email_address', 'display' => awtTrans('البريد الالكتروني'), 'data' => 'email_address', 'orderable' => 'true', 'searchable' => 'true'],
            // ['name' => 'phone', 'display' => awtTrans('الهاتف'), 'data' => 'phone', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'passport_id', 'display' => awtTrans('رقم جواز السفر'), 'data' => 'passport_id', 'orderable' => 'true', 'searchable' => 'true'],
            //            ['name' => 'exported', 'display' => trans('main.exported'), 'data' => 'exported', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'country', 'display' => awtTrans('الدولة'), 'data' => 'country', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'edit', 'display' => awtTrans('تعديل'), 'data' => 'edit', 'orderable' => 'false', 'searchable' => 'false'],

        ];
        $active = $this->active;
        $table_rows = $this->table;
        $route = $this->route;

        if (isset($_GET['course_id'])) {
            $course = Course::find($_GET['course_id']);
            if (empty($course)) {
                return view($this->view . '.index', compact('active', 'table_rows', 'route'));
            } else {
                return view($this->view . '.index', compact('active', 'table_rows', 'route', 'course'));
            }
        } else {

            return view($this->view . '.index', compact('active', 'table_rows', 'route'));
        }

        return view($this->view . '.index', compact('active', 'table_rows', 'route'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(FormBuilder $formBuilder): View
    {

        $form = $formBuilder->create($this->form, [
            'method' => 'POST',
            'url' => route($this->route . '.store'),
            'class' => 'row',

        ]);

        $form_title = 'Add ' . $this->title;
        $active = $this->active;
        $route = $this->route;

        return view($this->view . '.form', compact('form', 'form_title', 'active', 'route'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FormBuilder $formBuilder, Request $request): RedirectResponse
    {
        $form = $formBuilder->create($this->form);

        if (! $form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        $personal_photo = null;
        if ($request->hasFile('personal_picture')) {
            $file = $request->personal_picture;
            $image = $file;
            $name = time() . rand(1000, 555555555) . '_' . rand(1000, 555555555) . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/applications');
            $image->move($destinationPath, $name);
            $personal_photo = $name;
        }

        $passport_photos = [];
        if ($request->hasFile('passport_photos')) {
            foreach ($request->passport_photos as $file) {
                $image = $file;
                $name = time() . rand(1000, 555555555) . '_' . rand(1000, 555555555) . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('/uploads/applications');
                $image->move($destinationPath, $name);
                $passport_photos[] = $name;
            }
        }

        $qualification_certificates = [];
        if ($request->hasFile('qualification_certificates')) {
            foreach ($request->qualification_certificates as $file) {
                $image = $file;
                $name = time() . rand(1000, 555555555) . '_' . rand(1000, 555555555) . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('/uploads/applications');
                $image->move($destinationPath, $name);
                $qualification_certificates[] = $name;
            }
        }

        $cv_file = null;
        if ($request->hasFile('cv_file')) {
            $file = $request->cv_file;
            $image = $file;
            $name = time() . rand(1000, 555555555) . '_' . rand(1000, 555555555) . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/applications');
            $image->move($destinationPath, $name);
            $cv_file = $name;
        }

        $health_certificates = [];
        if ($request->hasFile('health_certificates')) {
            foreach ($request->health_certificates as $file) {
                $image = $file;
                $name = time() . rand(1000, 555555555) . '_' . rand(1000, 555555555) . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('/uploads/applications');
                $image->move($destinationPath, $name);
                $health_certificates[] = $name;
            }
        }

        $other_certificates = [];
        if ($request->hasFile('other_certificates')) {
            foreach ($request->other_certificates as $file) {
                $image = $file;
                $name = time() . rand(1000, 555555555) . '_' . rand(1000, 555555555) . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('/uploads/applications');
                $image->move($destinationPath, $name);
                $other_certificates[] = $name;
            }
        }

        $phone_number = $request->phone_number;
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
            'wait_list',
        ]);

        $data['course_id'] = $request->course_id;
        $data['phone_number'] = $phone_number;
        $data['personal_picture'] = $personal_photo;
        $data['passport_photos'] = serialize($passport_photos);
        $data['qualification_certificates'] = serialize($qualification_certificates);
        $data['languages'] = serialize($languages);
        $data['employer_phone'] = serialize($employer_phone);
        $data['cv_file'] = $cv_file;
        $data['health_certificates'] = serialize($health_certificates);
        $data['other_certificates'] = serialize($other_certificates);
        if (empty($data['country'])) {
            $data['country'] = $data['nationality'];
        }

        Application::create($data);

        flash(trans('main.thank_you_for_apply'))->success();

        return redirect(route($this->route . '.create'));

        // Do saving and other things...
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(int $id, FormBuilder $formBuilder)
    {

        $model = $this->model::find($id);
        if (empty($model)) {
            flash(awtTrans('لم نجد تلك القيمه'))->error();

            return redirect(route($this->route . '.index'));
        }

        $form = $formBuilder->create($this->form, [
            'method' => 'PUT',
            'model' => $model->toArray(),                              // Not passed to view, just used in form class
            'url' => route($this->route . '.update', [$model['id']]),
        ], ['id' => $model->id]);

        $form_title = 'Edit ' . $this->title;
        $active = $this->active;
        $route = $this->route;

        return view($this->view . '.show', compact('model', 'form_title', 'active', 'route'));
    }

    public function edit($id, FormBuilder $formBuilder)
    {

        $model = $this->model::find($id);
        if (empty($model)) {
            flash(awtTrans('لم نجد تلك القيمه'))->error();

            return redirect(route($this->route . '.index'));
        }

        $model->phone_number = $model->phone_number;
        $model->user_languages = implode("\n", unserialize($model->languages ?? 'a:0:{}'));
        $model->employer_phone = implode("\n", unserialize($model->employer_phone ?? 'a:0:{}'));
        $form = $formBuilder->create($this->form, [
            'method' => 'PUT',
            'model' => $model->toArray(),                              // Not passed to view, just used in form class
            'url' => route($this->route . '.update', [$model['id']]),
        ], ['id' => $model->id, 'edit' => true]);

        $form_title = 'Edit ' . $this->title;
        $active = $this->active;
        $route = $this->route;

        return view($this->view . '.edit', compact('form', 'form_title', 'active', 'route', 'model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function update(int $id, FormBuilder $formBuilder): RedirectResponse
    {

        $model = $this->model::find($id);
        if (empty($model)) {
            flash('Can`t find this value')->error();

            return redirect(route($this->route . '.index'));
        }

        $form = $formBuilder->create($this->form, [], ['id' => $model->id, 'edit' => true]);

        if (! $form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        $request = request();
        $personal_photo = $model->personal_picture;
        if ($request->hasFile('personal_picture')) {
            $file = $request->personal_picture;
            $image = $file;
            $name = time() . rand(1000, 555555555) . '_' . rand(1000, 555555555) . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/applications');
            $image->move($destinationPath, $name);
            $personal_photo = $name;
        }

        $passport_photos = unserialize($model->passport_photos);
        if ($request->hasFile('passport_photos')) {
            foreach ($request->passport_photos as $file) {
                $image = $file;
                $name = time() . rand(1000, 555555555) . '_' . rand(1000, 555555555) . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('/uploads/applications');
                $image->move($destinationPath, $name);
                $passport_photos[] = $name;
            }
        }

        $qualification_certificates = unserialize($model->qualification_certificates);
        if ($request->hasFile('qualification_certificates')) {
            foreach ($request->qualification_certificates as $file) {
                $image = $file;
                $name = time() . rand(1000, 555555555) . '_' . rand(1000, 555555555) . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('/uploads/applications');
                $image->move($destinationPath, $name);
                $qualification_certificates[] = $name;
            }
        }

        $cv_file = $model->cv_file;
        if ($request->hasFile('cv_file')) {
            $file = $request->cv_file;
            $image = $file;
            $name = time() . rand(1000, 555555555) . '_' . rand(1000, 555555555) . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/applications');
            $image->move($destinationPath, $name);
            $cv_file = $name;
        }

        $health_certificates = unserialize($model->health_certificates);
        if ($request->hasFile('health_certificates')) {
            foreach ($request->health_certificates as $file) {
                $image = $file;
                $name = time() . rand(1000, 555555555) . '_' . rand(1000, 555555555) . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('/uploads/applications');
                $image->move($destinationPath, $name);
                $health_certificates[] = $name;
            }
        }

        $other_certificates = unserialize($model->other_certificates);
        if ($request->hasFile('other_certificates')) {
            foreach ($request->other_certificates as $file) {
                $image = $file;
                $name = time() . rand(1000, 555555555) . '_' . rand(1000, 555555555) . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('/uploads/applications');
                $image->move($destinationPath, $name);
                $other_certificates[] = $name;
            }
        }

        $phone_number = $request->phone_number;
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
            'wait_list',

        ]);

        $data['course_id'] = $request->course_id;
        $data['phone_number'] = $phone_number;
        $data['personal_picture'] = $personal_photo;
        $data['passport_photos'] = serialize($passport_photos);
        $data['qualification_certificates'] = serialize($qualification_certificates);
        $data['languages'] = serialize($languages);
        $data['employer_phone'] = serialize($employer_phone);
        $data['cv_file'] = $cv_file;
        $data['health_certificates'] = serialize($health_certificates);
        $data['other_certificates'] = serialize($other_certificates);

        $model->update($data);
        flash(awtTrans('تم تعديل الطلب بنجاح'))->success();
        echo '<script type="text/javascript"> history.go(-2); </script>;';
    }

    public function delete()
    {

        $request = request();
        $dataArray = filterDatatableGet($_GET);
        $model = $this->model::select('applications.*')->join('courses', 'applications.course_id', '=', 'courses.id')->orderBy('courses.start_date', 'asc');
        if (isset($dataArray['waitList'])) {
            $model->where('wait_list', 'true');
        } else {
            $model->where('wait_list', 'false');
        }

        if (isset($dataArray['country'])) {
            $model->where('country', 'Like', '%' . $dataArray['country'] . '%');
        }

        if (isset($dataArray['course'])) {
            $model->where('course_id', $dataArray['course']);
        }

        if (isset($dataArray['organization'])) {
            $orgId = $dataArray['organization'];
            $model->whereHas('course', function ($query) use ($orgId) {
                $query->where('organization_id', $orgId);
            });
        }
        if (isset($dataArray['gender'])) {
            $model->where('gender', $dataArray['gender']);
        }

        if (isset($dataArray['first_name'])) {
            $first_name = $dataArray['first_name'];

            $model->where(function ($query) use ($first_name) {
                $query->where('first_name', 'Like', '%' . $first_name . '%');
            });
        }
        if (isset($dataArray['second_name'])) {
            $second_name = $dataArray['second_name'];
            $model->where(function ($query) use ($second_name) {
                $query->where('middle_name', 'Like', '%' . $second_name . '%');
            });
        }
        if (isset($dataArray['third_name'])) {
            $third_name = $dataArray['third_name'];
            $model->where(function ($query) use ($third_name) {
                $query->where('last_name', 'Like', '%' . $third_name . '%');
            });
        }

        if (isset($dataArray['date_from'])) {
            $fromA = $dataArray['date_from'];

            if (isset($dataArray['date_to'])) {
                $ToA = $dataArray['date_to'];
                $model->whereHas('course', function ($query) use ($fromA, $ToA) {
                    $query->whereBetween('start_date', [$fromA, $ToA]);
                });
            } else {

                $model->whereHas('course', function ($query) use ($fromA) {
                    $query->where('start_date', '>=', $fromA);
                });
            }
        }
        if (isset($_GET['course_id'])) {
            $model->where('course_id', $_GET['course_id']);
        }
        $applicants = $model->where('wait_list', 'false')->get();

        if (! isset($request->courses)) {
            if ($request->submit == 'export') {

                return (new ExportApplicant([], $this->view))->download('Applications.xlsx');
            }
            if ($request->submit == 'print') {
                return view($this->view . '.print', [
                    'data' => $applicants,
                    'print' => 'true',
                    'lang' => App::getLocale(),

                ]);
            }
            if ($request->submit == 'print2') {
                if ($request->input('print_choices') == null) {
                    flash(awtTrans('يجب اختيار خانه واحده علي الاقل'))->error();

                    return redirect(route($this->route . '.index'));
                }

                return view($this->view . '.print2', [
                    'data' => $applicants,
                    'print' => 'true',
                    'title' => $request->input('print_title'),
                    'print_choices' => $request->input('print_choices'),
                    'lang' => App::getLocale(),

                ]);
            }
            flash(trans('main.select_rows_to_delete'))->error();

            return redirect(route($this->route . '.index'));
        }

        if ($request->submit == 'delete') {

            $rows = $this->model::whereIn('id', $request->courses)->get();
            foreach ($rows as $row) {
                $row->delete();
            }
            flash(trans('main.rows_deleted_successfully'))->success();
        } elseif ($request->submit == 'export') {
            return (new ExportApplicant($request->courses, $this->view))->download('Applications.xlsx');
        } elseif ($request->submit == 'print') {
            return view($this->view . '.print', [
                'data' => Application::whereIn('id', $request->courses)->get(),
                'print' => 'true',
                'lang' => App::getLocale(),
            ]);
        } elseif ($request->submit == 'print2') {
            if ($request->input('print_choices') == null) {
                flash(awtTrans('يجب اختيار خانه واحده علي الاقل'))->error();

                return redirect(route($this->route . '.index'));
            }

            return view($this->view . '.print2', [
                'data' => Application::whereIn('id', $request->courses)->get(),
                'print_choices' => $request->input('print_choices'),
                'title' => $request->input('print_title'),
                'print' => 'true',
                'lang' => App::getLocale(),
            ]);
        } elseif ($request->submit == 'move_wait_list') {
            $rows = $this->model::whereIn('id', $request->courses)->first();

            $rows->wait_list = 'false';
            $rows->save();
        }

        return redirect(route($this->route . '.index'));
    }

    /*
     * Countries Datatable
     *
     *
     */

    public function datatable()
    {
        $dataArray = filterDatatableGet($_GET);

        $model = $this->model::select('applications.*')->join('courses', 'applications.course_id', '=', 'courses.id')->orderBy('courses.start_date', 'asc');
        if (isset($dataArray['waitList'])) {
            $model->where('wait_list', 'true');
        } else {
            $model->where('wait_list', 'false');
        }

        if (isset($dataArray['country'])) {
            $model->where('nationality', 'Like', '%' . $dataArray['country'] . '%');
        }

        if (isset($dataArray['course'])) {
            $model->where('course_id', $dataArray['course']);
        }

        if (isset($dataArray['organization'])) {
            $orgId = $dataArray['organization'];
            $model->whereHas('course', function ($query) use ($orgId) {
                $query->where('organization_id', $orgId);
            });
        }
        if (isset($dataArray['gender'])) {
            $model->where('gender', $dataArray['gender']);
        }

        if (isset($dataArray['first_name'])) {
            $first_name = $dataArray['first_name'];

            $model->where(function ($query) use ($first_name) {
                $query->where('first_name', 'Like', '%' . $first_name . '%');
            });
        }
        if (isset($dataArray['second_name'])) {
            $second_name = $dataArray['second_name'];
            $model->where(function ($query) use ($second_name) {
                $query->where('middle_name', 'Like', '%' . $second_name . '%');
            });
        }
        if (isset($dataArray['third_name'])) {
            $third_name = $dataArray['third_name'];
            $model->where(function ($query) use ($third_name) {
                $query->where('last_name', 'Like', '%' . $third_name . '%');
            });
        }

        if (isset($dataArray['date_from'])) {
            $fromA = $dataArray['date_from'];

            if (isset($dataArray['date_to'])) {
                $ToA = $dataArray['date_to'];
                $model->whereHas('course', function ($query) use ($fromA, $ToA) {
                    $query->whereBetween('start_date', [$fromA, $ToA]);
                });
            } else {

                $model->whereHas('course', function ($query) use ($fromA) {
                    $query->where('start_date', '>=', $fromA);
                });
            }
        }

        if (isset($_GET['course_id'])) {
            $model->where('course_id', $_GET['course_id']);
        }

        return DataTables::of($model)->addColumn('action', function ($model) {
            $data = '<a href="' . route($this->route . '.show', [$model->id]) . '" style="    margin-right: 10px;" class="btn btn-sm btn-primary"><i class="vl_pencil"></i>' . trans('main.edit') . '</a>';

            return $data;
        })->editColumn('chk', function ($model) {
            return '<input type="checkbox" name="courses[]" value="' . $model->id . '" class="iCheck-square chk-item">';
        })

            ->editColumn('course_name', function ($model) {

                if (empty($model->course)) {
                    return 'N\A';
                }

                return $model->course->name();
            })
            ->editColumn('id', function ($model) {
                return '<a href="' . route($this->route . '.edit', [$model->id]) . '">' . $model->id . '</a>';
            })
            ->editColumn('nationality', function ($model) {

                if (empty($model->nationality)) {
                    return 'N\A';
                }

                return getCountry($model->nationality);
            })
            ->editColumn('country', function ($model) {

                if (empty($model->country)) {
                    return 'N\A';
                }

                return getCountry($model->country);
            })
            ->editColumn('course_start_date', function ($model) {
                if (empty($model->course)) {
                    return 'N\A';
                }

                return $model->course->start_date->format('Y-m-d');
            })
            ->editColumn('course_end_date', function ($model) {
                if (empty($model->course)) {
                    return 'N\A';
                }

                return $model->course->end_date->format('Y-m-d');
            })
            ->editColumn('name', function ($model) {
                $name = $model->first_name . ' ' . $model->middle_name . ' ' . $model->last_name;

                return '<a href="' . route($this->route . '.show', [$model->id]) . '">' . $name . '</a>';
            })

            ->editColumn('trainee_status', function ($model) {
                return $model->trainee_status;
            })
            ->editColumn('edit', function ($model) {
                return '<a href="' . route($this->route . '.show', [$model->id]) . '">' . awtTrans('تعديل') . '</a>';
            })
            ->editColumn('gender', function ($model) {
                if ($model->gender == 'male') {
                    return awtTrans('ذكر');
                } elseif ($model->gender == null) {
                    return 'N/A';
                }

                return awtTrans('انثي');
            })->editColumn('date', function ($model) {
                return $model->created_at ? $model->created_at->format('Y-m-d') : 'N/A'; // Or any default value
            })->editColumn('age', function ($model) {
                if (! empty($model->birth_date)) {
                    return Carbon::createFromTimeString($model->birth_date)->diff(Carbon::now())->format('%y');
                } else {
                    return 'فارغ';
                }
            })->editColumn('exported', function ($model) {
                return $model->export_status;
            })->editColumn('phone', function ($model) {
                $phones = serialize($model->phone_number);

                return $phones[0];
            })
            ->rawColumns(['id', 'action', 'chk', 'name', 'country', 'course_name', 'trainee_status', 'date', 'edit'])->make(true);
    }

    public function export($request)
    {
        $ids = $request->applicants;
        if (is_null($ids)) {
            return redirect()->back();
        }

        return (new ApplicationExport($ids))->download('applicants.xlsx');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     *
     * @throws \PHPExcel_Exception
     * @throws \PHPExcel_Reader_Exception
     */
    // public function import(): RedirectResponse
    // {
    //     $request = \request();
    //     if ($request->hasFile('zip_file')) {

    //         $file = $request->zip_file;
    //         $zip = $file;
    //         $ext = $zip->getClientOriginalExtension();
    //         if ($ext != 'zip') {
    //             flash(awtTrans('يجب ان يكون الملف بصيغه zip'))->error();

    //             return redirect(route($this->route.'.index'));
    //         }
    //         $name = 'TempUpload.zip';
    //         $destinationPath = public_path('/uploads/zipFiles');
    //         $zip->move($destinationPath, $name);

    //         $zip = new \ZipArchive;
    //         if ($zip->open(public_path('/uploads/zipFiles/'.$name)) === true) {
    //             $zip->extractTo(public_path('/uploads/'));
    //             $zip->close();

    //             $exFile = public_path('uploads/excel/applicants.xlsx');
    //             $handle = fopen($exFile, 'r');
    //             $excel = new MyExcel($exFile);
    //             $data = $excel->toArray();
    //             dd( $data);
    //             foreach ($data as $row) {
    //                 unset($row['id']);
    //                 unset($row['export_status']);
    //                 $row['wait_list'] = 'true';
    //                 Application::create($row);
    //             }
    //             flash(awtTrans('تم رفع البيانات بنجاح'))->success();

    //             return redirect(route($this->route.'.index'));
    //         } else {
    //             flash(awtTrans('الملف المضغوط للمتدريب خاطئ'))->error();

    //             return redirect(route($this->route.'.index'));
    //         }
    //     } else {
    //         flash(awtTrans('الملف المضغوط للمتدريب مطلوب'))->error();

    //         return redirect(route($this->route.'.index'));
    //     }
    // }

    public function import()
    {
        $request = request();

        if (!$request->hasFile('zip_file')) {
            flash(awtTrans('الملف المضغوط للمتدريب مطلوب'))->error();
            return redirect(route($this->route . '.create'));
        }

        $file = $request->file('zip_file');
        if ($file->getClientOriginalExtension() !== 'zip') {
            flash(awtTrans('يجب ان يكون الملف بصيغه zip'))->error();
            return redirect(route($this->route . '.create'));
        }

        // Save the uploaded zip file
        $zipPath = public_path('/uploads/zipFiles/TempUpload.zip');
        $file->move(public_path('/uploads/zipFiles'), 'TempUpload.zip');

        // Clear old extracted Excel files
        \File::deleteDirectory(public_path('uploads/excel'));
        \File::makeDirectory(public_path('uploads/excel'));

        // Extract the new zip file
        $zip = new \ZipArchive;
        if ($zip->open($zipPath) === true) {
            $zip->extractTo(public_path('uploads/excel'));
            $zip->close();
        } else {
            flash(awtTrans('فشل في فتح الملف المضغوط'))->error();
            return redirect(route($this->route . '.create'));
        }

        // Find the Excel file dynamically
        $excelFiles = glob(public_path('uploads/excel/*.xlsx'));
        if (count($excelFiles) === 0) {
            flash(awtTrans('لم يتم العثور على أي ملف Excel داخل الملف المضغوط'))->error();
            return redirect(route($this->route . '.create'));
        }

        $exFile = $excelFiles[0]; // Use the first (only) Excel file
        $excel = new MyExcel($exFile);
        $data = $excel->toArray();
        // dd($data);
        // Filter out empty rows or header-only rows
        $validData = array_filter($data, function ($row) {
            return !empty(array_filter($row)); // Filters rows with all empty cells
        });

        // Optional: dd if needed
        // dd($validData);

        foreach ($validData as $row) {
            unset($row['id'], $row['export_status']);
            // $row['wait_list'] = 'true';

            // Only insert if required fields are filled (adjust fields as needed)
            if (!empty($row['First name'] ?? null)) {
                // Try to find course by name
                $course = Course::where('name_ar', trim($row['Course Name']))
                    ->orWhere('name_en', trim($row['Course Name']))
                    ->orWhere('name_fr', trim($row['Course Name']))
                    ->first();
                if (! $course) {
                    return;
                    flash(trans('awt.Not applicable'))->error();
                }
                $id = $course->id ?? null;


                Application::create([
                    'course_id' => $id,
                    'first_name' => $row['First name'],
                    'middle_name' => $row['Middle name'],
                    'last_name' => $row['Last Name'],
                    'gender' => $row['gender'],
                    'nationality' => $row['nationality'],
                    'address' => $row['Address'],
                    'phone_number' => $row['Phone Number'],
                    'email_address' => $row['Email Address'],
                    'birth_date' => Carbon::parse($row['Birth Date']),
                    'passport_id' => $row['Passport Number'],
                    'qualification' => $row['Qualification'],
                    'languages' => $row['Languages'],
                    'country' => getCountryByName($row['Country']),
                    'current_employer' => $row['Current Employer'],
                ]);

                // Application::create($row);
            }
        }

        flash(awtTrans('تم رفع البيانات بنجاح'))->success();
        return redirect(route($this->route . '.index'));
    }

    //     public function updatePhone(){
    //             $error_reporting = error_reporting(error_reporting() ^ E_NOTICE);
    //             $applicants=Application::all();
    //             foreach($applicants as $applicant){
    //                 $y = unserialize($applicant->phone_number);
    //                 if($y==true){
    //                     foreach($y as $row){
    //                         $app=Application::where('phone_number',$applicant->phone_number)->update([
    //                             'phone_number'=> $row
    //                         ]);
    //                     }
    //                 }

    //             }
    //             return '<h1>Phones Updated successfully</h1>';

    //         error_reporting($error_reporting);
    //     }

    //     public function updateCountry()
    //     //update null Country
    //     {
    //         $error_reporting = error_reporting(error_reporting() ^ E_NOTICE);
    //     $applicants=Application::where('country' , nuwaitll)->get();

    //     foreach($applicants as $applicant){

    //                 $app=Application::where('id',$applicant->id)->update([
    //                     'country'=>  $applicant->nationality
    //                 ]);

    //     }
    //     return '<h1>Countries Updated successfully</h1>';

    // error_reporting($error_reporting);
    // }
    public function updateEmail()
    {
        $arr = [
            'test@test.com',
            'لا يوجد',
            'mail@155mail.com',
            '00@hotmail.com',
            '00@yahoo.com',
            'mail@99mail.com',
            'mail@mail.com',
            'MAIL@MAIL.COM',
            'mail@100mail.com',
            'mail@123mail.com',
            'mail@123mail.com',
            'mail@155mail.com',
            'mail@188mail.com',
            'mail@2589mail.com',
            'mail@258mail.com',
            'mail@258mail.com',
            'mail@3574mail.com',
            'mail@468mail.com',
            'mail@472mail.com',
            'mail@4785mail.com',
            'mail@58mail.com',
            'mail@7415mail.com',
            'mail@741mail.com',
            'mail@7895mail.com',
            'mail@7896mail.com',
            'mail@789mail.com',
            'mail@85236mail.com',
            'mail@85296mail.com',
            'mail@963mail.com',
            'mail@852mail.com',
            'mail@99mail.com',
            'mail@852mail.com',
            'mail@85mail.com',
            'mail@999mail.com',
        ];
        $update = DB::table('applications')->whereIn('email_address', $arr)->update(['email_address' => '']);
        dd($update);
    }

    // public function importExcel(Request $request)
    // {
    //     $request->validate([
    //         'file' => 'required|mimes:xlsx,xls,csv'
    //     ]);

    //     try {
    //         Excel::import(new ApplicationImport, $request->file('file'));

    //         return back()->with('success', 'Applicant imported successfully!');
    //     } catch (\Exception $e) {
    //         return back()->withErrors('Error importing file: ' . $e->getMessage());
    //     }
    // }
}
