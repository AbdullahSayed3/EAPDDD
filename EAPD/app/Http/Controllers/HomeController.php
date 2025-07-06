<?php

namespace App\Http\Controllers;

use App\Forms\Settings\SupportMemberForm;
use App\Models\Aid;
use App\Models\Application;
use App\Models\Course;
use App\Models\Expert;
use App\Models\Scholarships;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\App;
use Illuminate\View\View;
use Kris\LaravelFormBuilder\FormBuilder;

class HomeController extends Controller
{
    protected $keys;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->keys = ['name', 'email', 'password'];

    }

    /**
     * Show the application dashboard.
     */
    public function index()
    {
        $active = 'home';
        $courses = Course::count();
        $applicants = Application::count();
        $scholarships = Scholarships::count();
        $aids = Aid::count();
        $total = Aid::sum('cost'); 
    // return view('home', compact('active', 'courses', 'applicants', 'scholarships', 'aids', 'total'));
     // Chart 1: عدد المتدربين حسب مجال التدريب
     $field = App::getLocale() == 'ar' ? 'field.name_ar' : 'field.name_en';
        $traineesPerField = Course::with('field', 'applications')
            ->get()
            ->groupBy($field)
            ->map(function ($courses, $fieldName) {
                return [
                    'field' => $fieldName ?? 'غير محدد',
                    'trainees' => $courses->sum(function ($course) {
                        return $course->applications->count();
                    })
                ];
            })
            ->values();
        // return $traineesPerField;

        // Chart 2: نوع الدورة وعدد الدورات والمتدربين (ذكور – إناث – إجمالي)
        $coursesByType = Course::with('type', 'applications')
            ->get()
            ->groupBy('type.name_ar')
            ->map(function ($courses, $typeName) {
                $totalCourses = $courses->count();
                $allApplications = $courses->flatMap->applications;
                
                $maleTrainees = $allApplications->where('gender', 'male')->count();
                $femaleTrainees = $allApplications->where('gender', 'female')->count();
                $totalTrainees = $allApplications->count();
                return [
                    'type' => $typeName ?? 'غير محدد',
                    'courses_count' => $totalCourses,
                    'male_trainees' => $maleTrainees,
                    'female_trainees' => $femaleTrainees,
                    'total_trainees' => $totalTrainees
                ];
            })
            ->values();

         // Chart 3: عدد الخبراء حسب التخصص
        $expertsBySpecialist = Expert::select('specialist')
            ->selectRaw('COUNT(*) as experts_count')
            ->groupBy('specialist')
            ->get()
            ->map(function ($item) {
                return [
                    'specialist' => $item->specialist ?? 'غير محدد',
                    'experts_count' => $item->experts_count
                ];
            });

        // Chart 4: عدد المنح وجهات المنح
        $scholarshipsByOwner = Scholarships::with('field')
            ->selectRaw('COUNT(*) as scholarships_count')
            ->groupBy('department')
            ->get()
            ->map(function ($item) {
                return [
                    'owner' => App::getLocale() == 'ar' ? optional($item->field)->name_ar ?? '-' :optional($item->field)->name_en ?? '-',
                    'scholarships_count' => $item->scholarships_count
                ];
            });
        // Pie Chart: توزيع المتدربين حسب النوع (العام الحالي)
        $currentYear = date('Y');
        $genderDistribution = Application::whereYear('created_at', $currentYear)
            ->selectRaw('gender, COUNT(*) as count')
            ->groupBy('gender')
            ->get()
            ->mapWithKeys(function ($item) {
                $gender = $item->gender == 'male' ? 'ذكور' : ($item->gender == 'female' ? 'إناث' : 'غير محدد');
                return [$gender => $item->count];
            });

        // Bar Chart: مقارنة بين آخر عامين
        $lastYear = $currentYear - 1;
        $genderComparison = [
            'current_year' => [
                'year' => $currentYear,
                'male' => Application::whereYear('created_at', $currentYear)->where('gender', 'male')->count(),
                'female' => Application::whereYear('created_at', $currentYear)->where('gender', 'female')->count(),
            ],
            'last_year' => [
                'year' => $lastYear,
                'male' => Application::whereYear('created_at', $lastYear)->where('gender', 'male')->count(),
                'female' => Application::whereYear('created_at', $lastYear)->where('gender', 'female')->count(),
            ]
        ];

        // Line Chart: تزايد أعداد المتدربين والدورات مع مرور الوقت (آخر 12 شهر)
        $monthlyData = [];
        for ($i = 11; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $month = $date->format('Y-m');
            $monthName = $date->format('M Y');
            
            $traineesCount = Application::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count();
                
            $coursesCount = Course::whereYear('start_date', $date->year)
                ->whereMonth('start_date', $date->month)
                ->count();
                
            $monthlyData[] = [
                'month' => $monthName,
                'trainees' => $traineesCount,
                'courses' => $coursesCount
            ];
        }


        return view('home', compact(
            'active', 
            'courses', 
            'applicants', 
            'scholarships', 
            'aids', 
            'total',
            'traineesPerField',
            'coursesByType',
            'expertsBySpecialist',
            'scholarshipsByOwner',
            'genderDistribution',
            'genderComparison',
            'monthlyData'
        ));

    }

    public function settings(FormBuilder $formBuilder)
    {
        $model = User::find(auth()->user()->id);
        if (empty($model)) {
            flash(awtTrans('لم نجد تلك القيمه'))->error();

            return redirect(route('home'));
        }

        $form = $formBuilder->create(SupportMemberForm::class, [
            'method' => 'POST',
            'class' => 'box-body form-element row',
            'model' => $model,                              // Not passed to view, just used in form class
            'url' => route('Savesettings'),
        ], ['edit' => true, 'profile' => true]);

        $form_title = awtTrans('الاعدادات الشخصيه');
        $active = awtTrans('الاعدادات الشخصيه');
        $route = 'settings';

        return view('Fixed.edit', compact('model', 'form', 'form_title', 'active', 'route'));

    }

    public function saveSettings(FormBuilder $formBuilder): RedirectResponse
    {
        $model = User::find(auth()->user()->id);
        if (empty($model)) {
            flash(awtTrans('لم نجد تلك القيمه'))->error();

            return redirect(route('home'));
        }

        $form = $formBuilder->create(SupportMemberForm::class, [], ['edit' => true, 'profile' => true]);

        if (! $form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }
        $request = request();
        $data = $request->only($this->keys);
        if ($data['email'] != $model->email) {

            $checkEmail = User::where('email', $data['email'])->first();
            if ($checkEmail) {
                flash(awtTrans('تم استخدام هذا البريد من قبل'))->error();

                return redirect()->back();
            }
        }

        if (! isset($data['password'])) {
            unset($data['password']);
        }
        $model->update($data);

        flash(awtTrans('تم تعديل القيمه بنجاح'))->success();

        return redirect(route('settings'));
    }
}
