<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Course;
use App\Models\Aid;
use App\Models\Events;
use App\Models\Expert;
use App\Models\Scholarships;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ReportsController extends Controller
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
        $this->middleware('can:show_reports');
    }

    /**
     * Show the application dashboard.
     */
    public function index(): View
    {
        $active = 'reports';

        return view('reports.index', compact('active'));
    }

    public function RenderReport($id)
    {
        switch ($id) {
            case 1:
                return $this->Render1thReport();
                break;

            case 2:
                return $this->Render2thReport();
                break;

            case 3:
                return $this->Render3thReport();
                break;

            case 4:
                return $this->Render4thReport();
                break;
            case 5:
                return $this->Render5thReport();
                break;
            case 6:
                return $this->Render6thReport();
                break;
            case 7:
                return $this->Render7thReport();
                break;
            case 8:
                return $this->Render10thReport('تقرير مجمع عن دورات الجيش');
                break;
            case 9:
                return $this->Render10thReport('تقرير مجمع عن دورات الشرطة');
                break;
            case 10:
                return $this->Render10thReport();
                break;
            case 11:
                return $this->Render11thReport();
                break;
            case 12:
                return $this->Render11thReport('تقرير عن الخبراء الموفدين إلى دولة خلال فترة معينة');
                break;
            case 13:
                return $this->Render11thReport('تقرير عن الخبراء الموفدين في مجال معين');
                break;
            case 14:
                return $this->Render14thReport();
                break;
            case 15:
                return $this->Render14thReport('تقرير عن المعونات المقدمة إلى دولة خلال فترة معينة ');
                break;
            case 16:
                return $this->Render14thReport('تقرير عن المعونات المقدمة من نوعية محددة');
                break;
            case 17:
                return $this->Render17thReport();
                break;
            case 18:
                return $this->Render18thReport();
                break;
            case 19:
                return $this->Render19thReport();
                break;

            case 20:
                return $this->Render20thReport();
                break;
            case 21:
                return $this->Render21thReport();
                break;
        }
    }

    public function Render1thReport(): View
    {
        $model = Course::query();
        $scholarships = Scholarships::query();

        $country = getRequest('country');
        $scholarships = Scholarships::query();
        $scholarships = $scholarships->where('participants', 'Like', '%' . $country . '%');
        $scholarships = $scholarships->get();  // This returns an Eloquent Collection, which should work correctly
        $from = getRequest('date_from');
        $to = getRequest('date_to');
        $title = 'تقرير شامل لاستفادة دولة معينة من أنشطة الوكالة';
        $active = 'reports';
        $appsCourses = [];
        $aids = [];
        $courses = [];
        $experts = [];
        $costs = [];
        $costs['aids'] = 0;
        $costs['scholarships'] = 0;
        $costs['experts'] = 0;
        $costs['courses'] = 0;
        $costs['applicants'] = 0;
        $coursesDetails['city_cost'] = 0;
        $coursesDetails = [];
        $appsDetails = [];
        $mainDetails = [];
        $mainDetails['total'] = 0;
        $mainDetails['total_apps'] = 0;
        $mainDetails['total_fapps'] = 0;
        $mainDetails['total_city'] = 0;
        $mainDetails['total_army'] = 0;
        $mainDetails['total_police'] = 0;
        if (isset($country)) {
            $aids = Aid::where('country_id', 'LIKE', '%' . $country . '%')->orderBy('ship_date', 'ASC')->get();
            $scholarships = $scholarships->where('participants', 'Like', '%' . $country . '%');

            if (isset($from)) {
                if (isset($to)) {
                    $scholarships = $scholarships->whereBetween('start_date', [$from, $to])->orderBy('start_date', 'ASC');
                    $aids = Aid::where('country_id', 'LIKE', '%' . $country . '%')->whereBetween('ship_date', [$from, $to])->orderBy('ship_date', 'ASC')->get();
                } else {
                    $aids = Aid::where('country_id', 'LIKE', '%' . $country . '%')->where('ship_date', '>', $from)->orderBy('ship_date', 'ASC')->get();
                    $scholarships = $scholarships->where('start_date', '>', $from)->orderBy('start_date', 'ASC');
                }
            }
            // dd($scholarships);
            $scholarships = $scholarships->get();

            foreach ($scholarships as $scholarship) {
                if (!isset($costs['scholarships'])) {

                    $costs['scholarships'] = 0;
                }
                $costs['scholarships'] += $scholarship->annual_cost;
            }
            foreach ($aids as $aid) {
                if (!isset($costs['aids'])) {

                    $costs['aids'] = 0;
                }
                $costs['aids'] += $aid->cost;
            }

            $applicants = Application::where('nationality', $country)->get();
            $applicants = $applicants->groupBy('course_id');
            $ids = [];
            foreach ($applicants as $applicant) {
                foreach ($applicant as $applicant_id) {
                    $ids[] = $applicant_id->course_id;
                }
            }

            $model = $model->whereIn('id', $ids)->orderBy('start_date', 'ASC');
            if (isset($from)) {
                if (isset($to)) {
                    $model = $model->whereIn('id', $ids)
                        ->whereBetween('start_date', [$from, $to])
                        ->orderBy('start_date', 'ASC');
                } else {
                    $model = $model->whereIn('id', $ids)
                        ->where('start_date', '>', $from)
                        ->orderBy('start_date', 'ASC');
                }
            }
            $courses = $model->get();

            if (!isset($costs['courses'])) {

                $costs['courses'] = 0;
            }
            if (!isset($coursesDetails['total_apps'])) {

                $coursesDetails['total_apps'] = 0;
            }
            if (!isset($coursesDetails['total_fapps'])) {

                $coursesDetails['total_fapps'] = 0;
            }

            if (!isset($coursesDetails['city'])) {

                $coursesDetails['city'] = 0;
            }
            if (!isset($coursesDetails['city_cost'])) {

                $coursesDetails['city_cost'] = 0;
            }
            if (!isset($coursesDetails['other_cost'])) {

                $coursesDetails['other_cost'] = 0;
            }
            if (!isset($coursesDetails['other'])) {

                $coursesDetails['other'] = 0;
            }

            foreach ($courses as $item) {

                $fCost = $item->applications()->where('nationality', 'LIKE', '%' . $country . '%')->count();
                $costs['courses'] += ($fCost * $item->cost);
                $coursesDetails['total_apps'] += $fCost;
                if ($item->type_id == 'citizan') {
                    $coursesDetails['city_cost'] += ($fCost * $item->cost);
                    $coursesDetails['city'] += 1;
                } else {
                    $coursesDetails['other_cost'] += ($fCost * $item->cost);
                    $coursesDetails['other'] += 1;
                }

                $mainDetails['total_apps'] += $fCost;
                $mainDetails['total_fapps'] += $item->applications()->where('nationality', 'LIKE', '%' . $country . '%')->where('gender', 'female')->count();

                $mainDetails['total'] += 1;

                if ($item->type_id == 'citizan') {
                    $mainDetails['total_city'] += 1;
                }
                if ($item->type_id == 'army') {
                    $mainDetails['total_army'] += 1;
                }
                if ($item->type_id == 'police') {
                    $mainDetails['total_police'] += 1;
                }
            }

            $experts = Expert::where('delegate_country', 'LIKE', '%' . $country . '%')->get();

            if (isset($from)) {
                if (isset($to)) {
                    $experts = Expert::where('delegate_country', 'LIKE', '%' . $country . '%')->whereBetween('contract_date', [$from, $to])->get();
                } else {
                    $experts = Expert::where('delegate_country', 'LIKE', '%' . $country . '%')->where('contract_date', '>', $from)->get();
                }
            }

            foreach ($experts as $item) {
                if (!isset($costs['experts'])) {

                    $costs['experts'] = 0;
                }
                $costs['experts'] += $item->cost;
            }
        }

        foreach ($costs as $value) {
            if (!isset($costs['total'])) {
                $costs['total'] = 0;
            }
            $costs['total'] += $value;
        }

        if (getRequest('print') == 'true') {
            $print_choices = getRequest('print_choices');

            $lang = getRequest('lang');
            if (empty($lang)) {
                $lang = 'ar';
            }
            App::setLocale($lang);
            $title = awtTrans($title);

            if (getRequest('rep_title') != null) {
                $title = getRequest('rep_title');
            }

            return view('reports.pdf.1th', compact('lang', 'scholarships', 'print_choices', 'country', 'mainDetails', 'appsCourses', 'appsDetails', 'title', 'active', 'aids', 'courses', 'experts', 'costs', 'coursesDetails'));
        }

        return view('reports.1th', compact('title', 'scholarships', 'country', 'mainDetails', 'appsCourses', 'appsDetails', 'active', 'aids', 'courses', 'experts', 'costs', 'coursesDetails'));
    }

    public function Render2thReport(): View
    {
        $country = getRequest('country');
        $from = getRequest('date_from');
        $to = getRequest('date_to');
        $title = 'تقرير عن مشاركة دولة في الدورات خلال فترة محددة';
        $active = 'reports';
        $appsCourses = [];
        $aids = [];
        $courses = [];
        $experts = [];
        $costs = [];
        $costs['aids'] = 0;
        $costs['experts'] = 0;
        $costs['courses'] = 0;
        $coursesDetails = [];
        $mainDetails = [];
        $appsDetails = [];
        $mainDetails['total'] = 0;
        $mainDetails['total_apps'] = 0;
        $mainDetails['total_fapps'] = 0;
        $mainDetails['total_city'] = 0;
        $mainDetails['total_army'] = 0;
        $mainDetails['total_police'] = 0;
        $model = Course::query();

        if (isset($country)) {
            $applicants = Application::where('nationality', $country)->get();
            $applicants = $applicants->groupBy('course_id');
            $ids = [];
            foreach ($applicants as $applicant) {
                foreach ($applicant as $applicant_id) {
                    $ids[] = $applicant_id->course_id;
                }
            }
            $model = Course::whereIn('id', $ids);
            if (isset($from)) {
                if (isset($to)) {
                    $model->whereBetween('start_date', [$from, $to]);
                } else {
                    $model->where('start_date', '=>', $from);
                }
            }
            // $courses =  $model->get();
            $courses = $model->orderBy('start_date', 'ASC')->get();

            foreach ($courses as $key => $course) {
                $total_coursers_year = 0;
                $total_apps_year = 0;
                $total_apps_fe_year = 0;
                $total_city_year = 0;
                $total_army_year = 0;
                $total_police_year = 0;

                $total_coursers_year += 1;
                $total_apps_year += $course->applications()->where('nationality', $country)->count();
                $total_apps_fe_year += $course->applications()->where('nationality', $country)->where('gender', 'female')->count();
                if ($course->type_id == 'citizan') {
                    $total_city_year += 1;
                }
                if ($course->type_id == 'army') {
                    $total_army_year += 1;
                }
                if ($course->type_id == 'police') {
                    $total_police_year += 1;
                }
                $mainDetails['total_apps'] += $course->applications()->where('nationality', $country)->count();
                $mainDetails['total_fapps'] += $course->applications()->where('nationality', $country)->where('gender', 'female')->count();
                $mainDetails['total'] += 1;
                if ($course->type_id == 'citizan') {
                    $mainDetails['total_city'] += 1;
                }
                if ($course->type_id == 'army') {
                    $mainDetails['total_army'] += 1;
                }
                if ($course->type_id == 'police') {
                    $mainDetails['total_police'] += 1;
                }
            }

            // $coursesDetails['total_coursers_year_data'] = $values;
            // $coursesDetails['total_coursers_year'] = $total_coursers_year;
            // $coursesDetails['total_apps_year'] = $total_apps_year;
            // $coursesDetails['total_apps_fe_year'] = $total_apps_fe_year;
            // $coursesDetails['total_city_year'] = $total_city_year;
            // $coursesDetails['total_army_year'] = $total_army_year;
            // $coursesDetails['total_police_year'] = $total_police_year;
            // }
        }

        if (getRequest('print') == 'true') {
            $lang = getRequest('lang');
            if (empty($lang)) {
                $lang = 'ar';
            }
            App::setLocale($lang);
            $title = awtTrans($title);

            if (getRequest('rep_title') != null) {
                $title = getRequest('rep_title');
            }

            return view('reports.pdf.2th', compact('country', 'title', 'appsCourses', 'appsDetails', 'lang', 'active', 'aids', 'courses', 'experts', 'costs', 'coursesDetails', 'mainDetails'));
        }

        return view('reports.2th', compact('country', 'title', 'appsCourses', 'appsDetails', 'active', 'aids', 'courses', 'experts', 'costs', 'coursesDetails', 'mainDetails'));
    }

    public function Render3thReport()
    {
        $country = getRequest('country');
        $from = getRequest('date_from');
        $to = getRequest('date_to');
        $title = 'تقرير عن مشاركة دولة في الدورات خلال فترة محددة شامل التكلفة التقديرية';
        $active = 'reports';
        $appsCourses = [];

        $aids = [];
        $courses = [];
        $experts = [];
        $costs = [];
        $costs['aids'] = 0;
        $costs['experts'] = 0;
        $costs['courses'] = 0;
        $coursesDetails = [];
        $mainDetails = [];
        $appsDetails = [];
        $mainDetails['total'] = 0;
        $mainDetails['total_apps'] = 0;
        $mainDetails['total_fapps'] = 0;
        $mainDetails['total_city'] = 0;
        $mainDetails['total_army'] = 0;
        $mainDetails['total_police'] = 0;
        $mainDetails['total_cost'] = 0;

        if (isset($country)) {
            $applicants = Application::where('nationality', $country)->get();
            $applicants = Application::where('nationality', $country)->get();
            $applicants = $applicants->groupBy('course_id');
            $ids = [];
            foreach ($applicants as $applicant) {
                foreach ($applicant as $applicant_id) {
                    $ids[] = $applicant_id->course_id;
                }
            }
            $model = Course::whereIn('id', $ids);

            if (isset($from)) {
                if (isset($to)) {
                    $model->whereBetween('start_date', [$from, $to]);
                } else {
                    $model->where('start_date', '=>', $from);
                }
            }
            $courses = $model->get();
            // $courses =  $model->get()->groupBy(function ($date) {
            //     return Carbon::parse($date->start_date)->format('Y');
            // })->sortKeys();
            $total_coursers_year = 0;
            $total_apps_year = 0;
            $total_apps_fe_year = 0;
            $total_city_year = 0;
            $total_army_year = 0;
            $total_police_year = 0;
            $total_city__cost_year = 0;
            $total_army__cost_year = 0;
            $total_police__cost_year = 0;
            foreach ($courses as $key => $course) {

                $mainDetails['total_cost'] += $course->applications()->where('nationality', $country)->count() * $course->cost;
                $mainDetails['total_apps'] += $course->applications()->where('nationality', $country)->count();
                $mainDetails['total_fapps'] += $course->applications()->where('nationality', $country)->where('gender', 'female')->count();
                // foreach ($values as $course) {
                $total_coursers_year += 1;
                $total_apps_year += $course->applications()->where('nationality', $country)->count();
                $total_apps_fe_year += $course->applications()->where('nationality', $country)->where('gender', 'female')->count();
                if ($course->type_id == 'citizan') {
                    $total_city_year += 1;
                    $total_city__cost_year += $course->applications()->where('nationality', $country)->count() * $course->cost;
                }
                if ($course->type_id == 'army') {
                    $total_army_year += 1;
                    $total_army__cost_year += $course->applications()->where('nationality', $country)->count() * $course->cost;
                }
                if ($course->type_id == 'police') {
                    $total_police_year += 1;
                    $total_police__cost_year += $course->applications()->where('nationality', $country)->count() * $course->cost;
                }

                $mainDetails['total'] += 1;
                if ($course->type_id == 'citizan') {
                    $mainDetails['total_city'] += 1;
                }
                if ($course->type_id == 'army') {
                    $mainDetails['total_army'] += 1;
                }
                if ($course->type_id == 'police') {
                    $mainDetails['total_police'] += 1;
                }
            }

            // }

            // $coursesDetails['total_coursers_year_data'] = $values;
            // $coursesDetails['total_coursers_year'] = $total_coursers_year;
            // $coursesDetails['total_apps_year'] = $total_apps_year;
            // $coursesDetails['total_apps_fe_year'] = $total_apps_fe_year;
            // $coursesDetails['total_city_year'] = $total_city_year;
            // $coursesDetails['total_army_year'] = $total_army_year;
            // $coursesDetails['total_police_year'] = $total_police_year;
            // $coursesDetails['total_city__cost_year'] = $total_city__cost_year;
            // $coursesDetails['total_army__cost_year'] = $total_army__cost_year;
            // $coursesDetails['total_police__cost_year'] = $total_police__cost_year;
        }

        foreach ($costs as $value) {
            if (!isset($costs['total'])) {
                $costs['total'] = 0;
            }
            $costs['total'] += $value;
        }

        if (getRequest('print') == 'true') {
            $lang = getRequest('lang');
            if (empty($lang)) {
                $lang = 'ar';
            }
            App::setLocale($lang);
            $title = awtTrans($title);

            if (getRequest('rep_title') != null) {
                $title = getRequest('rep_title');
            }

            return view('reports.pdf.3th', compact('country', 'title', 'appsCourses', 'appsDetails', 'lang', 'active', 'aids', 'courses', 'experts', 'costs', 'coursesDetails', 'mainDetails'));
        }

        return view('reports.3th', compact('country', 'title', 'appsCourses', 'appsDetails', 'active', 'aids', 'courses', 'experts', 'costs', 'coursesDetails', 'mainDetails'));
    }

    public function Render4thReport(): View
    {
        $country = getRequest('country');
        $from = getRequest('date_from');
        $to = getRequest('date_to');
        $title = 'تقرير مختصر عن مشاركة دولة بالدورات خلال فترة معينة';
        $active = 'reports';
        $aids = [];
        $courses = [];
        $experts = [];
        $costs = [];
        $costs['aids'] = 0;
        $costs['experts'] = 0;
        $costs['courses'] = 0;
        $appsCourses = [];

        $coursesDetails = [];
        $mainDetails = [];
        $appsDetails = [];
        $mainDetails['total'] = 0;
        $mainDetails['total_apps'] = 0;
        $mainDetails['total_fapps'] = 0;
        $mainDetails['total_city'] = 0;
        $mainDetails['total_army'] = 0;
        $mainDetails['total_police'] = 0;
        $applicants = [];

        if (isset($country)) {

            $applicants = Application::where('nationality', $country)->get();
            $applicants = $applicants->groupBy('course_id');
            $ids = [];
            foreach ($applicants as $applicant) {
                foreach ($applicant as $applicant_id) {
                    $ids[] = $applicant_id->course_id;
                }
            }

            $courses = Course::whereIn('id', $ids)->orderBy('start_date', 'ASC')->get();

            if (isset($from)) {
                if (isset($to)) {
                    $courses = Course::whereIn('id', $ids)
                        ->whereBetween('start_date', [$from, $to])
                        ->orderBy('start_date', 'ASC')->get();
                } else {
                    $courses = Course::whereIn('id', $ids)
                        ->where('start_date', '>', $from)
                        ->orderBy('start_date', 'ASC')->get();
                }
            }

            foreach ($courses as $item) {

                if (!isset($costs['courses'])) {

                    $costs['courses'] = 0;
                }
                if (!isset($coursesDetails['total_apps'])) {

                    $coursesDetails['total_apps'] = 0;
                }
                if (!isset($coursesDetails['total_fapps'])) {

                    $coursesDetails['total_fapps'] = 0;
                }

                if (!isset($coursesDetails['city'])) {

                    $coursesDetails['city'] = 0;
                }
                if (!isset($coursesDetails['city_cost'])) {

                    $coursesDetails['city_cost'] = 0;
                }
                if (!isset($coursesDetails['other_cost'])) {

                    $coursesDetails['other_cost'] = 0;
                }
                if (!isset($coursesDetails['other'])) {

                    $coursesDetails['other'] = 0;
                }
                $fCost = $item->applications()->where('country', 'LIKE', '%' . $country . '%')->count();
                //                    $fCost = $item->applications->count();
                $costs['courses'] += ($fCost * $item->cost);
                $coursesDetails['total_apps'] += $fCost;
                //                $coursesDetails[$key]['total_fapps']+=$item->applications()->where('gender','female')->count();

                if ($item->type_id == 'citizan') {
                    $coursesDetails['city_cost'] += ($fCost * $item->cost);
                    $coursesDetails['city'] += 1;
                } else {
                    $coursesDetails['other_cost'] += ($fCost * $item->cost);
                    $coursesDetails['other'] += 1;
                }

                $mainDetails['total_apps'] += $fCost;
                $mainDetails['total_fapps'] += $item->applications()->where('country', 'LIKE', '%' . $country . '%')->where('gender', 'female')->count();

                $mainDetails['total'] += 1;

                if ($item->type_id == 'citizan') {
                    $mainDetails['total_city'] += 1;
                }
                if ($item->type_id == 'army') {
                    $mainDetails['total_army'] += 1;
                }
                if ($item->type_id == 'police') {
                    $mainDetails['total_police'] += 1;
                }
            }
        }

        foreach ($costs as $value) {
            if (!isset($costs['total'])) {
                $costs['total'] = 0;
            }
            $costs['total'] += $value;
        }

        if (getRequest('print') == 'true') {
            $lang = getRequest('lang');
            if (empty($lang)) {
                $lang = 'ar';
            }
            App::setLocale($lang);
            $title = awtTrans($title);

            if (getRequest('rep_title') != null) {
                $title = getRequest('rep_title');
            }

            return view('reports.pdf.4th', compact('country', 'title', 'applicants', 'appsCourses', 'appsDetails', 'lang', 'active', 'aids', 'courses', 'experts', 'costs', 'coursesDetails', 'mainDetails'));
        }

        //        dd($appsCourses);
        return view('reports.4th', compact('country', 'title', 'applicants', 'appsCourses', 'appsDetails', 'active', 'aids', 'courses', 'experts', 'costs', 'coursesDetails', 'mainDetails'));
    }

    public function Render5thReport(): View
    {
        $Mcountry = getRequest('country');
        $from = getRequest('date_from');
        $to = getRequest('date_to');
        $experts = [];
        $costs = [];
        $coursesDetails = [];
        $mainDetails = [];

        if (getRequest('inv') != null) {
            $title = 'تقرير مجمع عن دعوة/مشاركة مجموعة من الدول بالدورات خلال فترة معينة';
        } else {

            $title = 'تقرير مجمع عن مشاركة مجموعة من الدول بالدورات خلال فترة زمنية';
        }
        $active = 'reports';

        $array = [];
        $coures = Course::orderBy('start_date', 'ASC')->get();
        if (isset($from)) {
            if (isset($to)) {
                $coures = Course::whereBetween('start_date', [$from, $to])
                    ->orderBy('start_date', 'ASC')->get();
            } else {
                $coures = Course::where('start_date', '>', $from)
                    ->orderBy('start_date', 'ASC')->get();
            }
        }
        $conAr = [];

        if (isset($Mcountry)) {

            foreach ($coures as $course) {

                $countries = unserialize($course->countries);

                if (getRequest('inv') != null) {
                    $countryArray = [];
                    foreach ($countries as $country) {
                        if (!in_array($country, $Mcountry)) {
                            continue;
                        }

                        if (isset($conAr[$country])) {
                            continue;
                        }
                        $totalApp = 0;
                        $totalAppFem = 0;
                        $totalCost = 0;
                        $totalCity = 0;
                        $totalArmy = 0;
                        $totalPolice = 0;
                        $ccCourses = [];
                        $applicants = Application::where('nationality', $country)->get();
                        $applicants = $applicants->groupBy('course_id');
                        $ids = [];
                        foreach ($applicants as $applicant) {
                            foreach ($applicant as $applicant_id) {
                                $ids[] = $applicant_id->course_id;
                            }
                        }
                        $countryCourse = Course::whereIn('id', $ids)->get();

                        foreach ($countryCourse as $c) {
                            if (isset($countryArray[$country])) {
                                continue;
                            }
                            $totalApp += $c->applications()->where('nationality', $country)->count();
                            $totalAppFem += $c->applications()->where('nationality', $country)->where('gender', 'female')->count();
                            $totalCost += $totalApp * $c->cost;

                            if (!isset($ccCourses[$c->id])) {

                                if ($c->type_id == 'citizan') {
                                    $totalCity += 1;
                                }

                                if ($c->type_id == 'army') {
                                    $totalArmy += 1;
                                }

                                if ($c->type_id == 'police') {
                                    $totalPolice += 1;
                                }
                            }
                        }
                        $countryArray[$country]['name'] = getCountry($country);
                        $countryArray[$country]['total_courses'] = $countryCourse->count();
                        $countryArray[$country]['total_in_courses'] = count($ids);
                        $countryArray[$country]['total_apps'] = $totalApp;
                        $countryArray[$country]['total_city'] = $totalCity;
                        $countryArray[$country]['total_army'] = $totalArmy;
                        $countryArray[$country]['total_police'] = $totalPolice;
                        $countryArray[$country]['total_apps_fem'] = $totalAppFem;
                        $countryArray[$country]['cost'] = $totalCost;
                        $conAr[$country] = true;
                    }

                    foreach ($countryArray as $key => $value) {

                        $array[] = $value;
                    }
                } else {

                    $countryArray = [];
                    foreach ($course->applications as $application) {
                        if (!in_array($application->country, $Mcountry)) {
                            continue;
                        }

                        if (isset($conAr[$application->country])) {
                            continue;
                        }

                        $country = $application->country;
                        $countryCourse = Application::where('nationality', $application->country)->get();
                        $invcountryCourse = Course::where('countries', 'like', '%' . $country . '%')->get();

                        $totalApp = 0;
                        $totalAppFem = 0;
                        $totalCost = 0;
                        $totalCity = 0;
                        $totalArmy = 0;
                        $totalPolice = 0;
                        $ccCourses = [];
                        //                        dd($countryCourse);
                        foreach ($countryCourse as $c) {
                            if (isset($countryArray[$country])) {
                                continue;
                            }
                            $totalApp++;
                            if ($c->gender == 'female') {
                                $totalAppFem++;
                            }
                            // $totalCost += $c->course->cost;

                            if (!isset($ccCourses[$c->course->id])) {

                                if ($c->course->type_id == 'citizan') {
                                    $totalCity += 1;
                                }

                                if ($c->course->type_id == 'army') {
                                    $totalArmy += 1;
                                }

                                if ($c->course->type_id == 'police') {
                                    $totalPolice += 1;
                                }
                            }

                            $ccCourses[$c->course->id] = true;
                        }
                        $countryArray[$country]['name'] = getCountry($country);
                        $countryArray[$country]['total_courses'] = count($ccCourses);
                        $countryArray[$country]['total_in_courses'] = count($invcountryCourse);
                        $countryArray[$country]['total_apps'] = $totalApp;
                        $countryArray[$country]['total_city'] = $totalCity;
                        $countryArray[$country]['total_army'] = $totalArmy;
                        $countryArray[$country]['total_police'] = $totalPolice;
                        $countryArray[$country]['total_apps_fem'] = $totalAppFem;
                        $countryArray[$country]['cost'] = $totalCost;
                        $conAr[$country] = true;
                    }
                    //                    dd($countryArray);

                    foreach ($countryArray as $key => $value) {

                        $array[] = $value;
                    }
                }
            }
        }

        $countries = $array;
        $countryArrayData['total_courses'] = 0;
        $countryArrayData['total_in_courses'] = 0;
        $countryArrayData['total_apps'] = 0;
        $countryArrayData['total_city'] = 0;
        $countryArrayData['total_army'] = 0;
        $countryArrayData['total_police'] = 0;
        $countryArrayData['total_apps_fem'] = 0;
        $countryArrayData['cost'] = 0;
        $conArr = [];
        foreach ($countries as $country) {
            if (isset($conArr[$country['name']])) {
                continue;
            }
            $countryArrayData['total_courses'] += $country['total_courses'];
            $countryArrayData['total_in_courses'] += $country['total_in_courses'];
            $countryArrayData['total_apps'] += $country['total_apps'];
            $countryArrayData['total_city'] += $country['total_city'];
            $countryArrayData['total_army'] += $country['total_army'];
            $countryArrayData['total_police'] += $country['total_police'];
            $countryArrayData['total_apps_fem'] += $country['total_apps_fem'];
            $countryArrayData['cost'] += $country['cost'];
            $conArr[$country['name']] = true;
        }

        if (getRequest('print') == 'true') {
            $lang = getRequest('lang');
            if (empty($lang)) {
                $lang = 'ar';
            }
            App::setLocale($lang);
            $title = awtTrans($title);

            if (getRequest('rep_title') != null) {
                $title = getRequest('rep_title');
            }

            return view('reports.pdf.5th', compact('title', 'lang', 'active', 'countries', 'countryArrayData', 'experts', 'costs', 'coursesDetails', 'mainDetails'));
        }

        return view('reports.5th', compact('title', 'active', 'countries', 'countryArrayData', 'experts', 'costs', 'coursesDetails', 'mainDetails'));
    }

    public function Render6thReport(): View
    {
        $Mcountry = getRequest('country');
        $from = getRequest('date_from');
        $to = getRequest('date_to');
        $country = [];
        $experts = [];
        $costs = [];
        $coursesDetails = [];
        $mainDetails = [];
        if (getRequest('inv') != null) {
            $title = 'تقرير مجمع عن دعوة/مشاركة مجموعة من الدول بالدورات خلال فترة زمنية شامل التكلفة';
        } else {

            $title = 'تقرير مجمع عن مشاركة مجموعة من الدول بالدورات خلال فترة زمنية شامل التكلفة التقديرية';
        }
        $active = 'reports';

        $array = [];
        $coures = Course::orderBy('start_date', 'ASC')->get();

        if (isset($from)) {
            if (isset($to)) {
                $coures = Course::whereBetween('start_date', [$from, $to])
                    ->orderBy('start_date', 'ASC')->get();
            } else {
                $coures = Course::where('start_date', '>', $from)
                    ->orderBy('start_date', 'ASC')->get();
            }
        }
        $conAr = [];
        if (isset($Mcountry)) {

            foreach ($coures as $course) {
                $countries = unserialize($course->countries);
                if (getRequest('inv') == 55) {
                    $countryArray = [];
                    foreach ($countries as $country) {
                        if (!in_array($country, $Mcountry)) {
                            continue;
                        }

                        if (isset($conAr[$country])) {
                            continue;
                        }
                        $countryCourse = Course::where('countries', 'like', '%' . $country . '%')->get();
                        $totalApp = 0;
                        $totalAppFem = 0;
                        $totalCost = 0;
                        $totalCity = 0;
                        $totalArmy = 0;
                        $totalPolice = 0;
                        $ccCourses = [];
                        $applicants = Application::where('country', $country)->get();
                        //            $app = \App\Application::where('country', 'SD')->get();
                        $applicants = $applicants->groupBy('course_id');
                        //    $app
                        $ids = [];
                        foreach ($applicants->toArray() as $id => $val) {
                            $ids[] = $id;
                        }
                        foreach ($countryCourse as $c) {

                            $totalApps = $c->applications()->where('country', 'like', '%' . $country . '%')->count();
                            $totalApp += $c->applications()->where('country', 'like', '%' . $country . '%')->count();
                            $totalAppFem += $c->applications()->where('country', 'like', '%' . $country . '%')->where('gender', 'female')->count();
                            $totalCost += $totalApps * $c->cost;

                            if ($c->type_id == 'citizan') {
                                $totalCity += 1;
                            }

                            if ($c->type_id == 'army') {
                                $totalArmy += 1;
                            }

                            if ($c->type_id == 'police') {
                                $totalPolice += 1;
                            }
                        }
                        $countryArray[$country]['name'] = getCountry($country);
                        $countryArray[$country]['total_courses'] = $countryCourse->count();
                        $countryArray[$country]['total_in_courses'] = count($ids);

                        $countryArray[$country]['total_apps'] = $totalApp;
                        $countryArray[$country]['total_city'] = $totalCity;
                        $countryArray[$country]['total_army'] = $totalArmy;
                        $countryArray[$country]['total_police'] = $totalPolice;
                        $countryArray[$country]['total_apps_fem'] = $totalAppFem;
                        $countryArray[$country]['cost'] = $totalCost;
                        $conAr[$country] = true;
                    }

                    foreach ($countryArray as $key => $value) {

                        $array[] = $value;
                    }
                } else {

                    $countryArray = [];
                    foreach ($course->applications as $application) {
                        if (!in_array($application->country, $Mcountry)) {
                            continue;
                        }

                        if (isset($conAr[$application->country])) {
                            continue;
                        }

                        $country = $application->country;
                        $countryCourse = Application::where('country', 'like', '%' . $application->country . '%')->get();
                        $totalApp = 0;
                        $totalAppFem = 0;
                        $totalCost = 0;
                        $totalCity = 0;
                        $totalArmy = 0;
                        $totalPolice = 0;
                        $ccCourses = [];
                        $invcountryCourse = Course::where('countries', 'like', '%' . $country . '%')->get();

                        //                        dd($countryCourse);
                        foreach ($countryCourse as $c) {
                            if (isset($countryArray[$country])) {
                                continue;
                            }
                            $totalApp++;
                            if ($c->gender == 'female') {
                                $totalAppFem++;
                            }
                            $totalCost += $c->course->cost;

                            if (!isset($ccCourses[$c->course->id])) {

                                if ($c->course->type_id == 'citizan') {
                                    $totalCity += 1;
                                }

                                if ($c->course->type_id == 'army') {
                                    $totalArmy += 1;
                                }

                                if ($c->course->type_id == 'police') {
                                    $totalPolice += 1;
                                }
                            }

                            $ccCourses[$c->course->id] = true;
                        }
                        $countryArray[$country]['name'] = getCountry($country);
                        $countryArray[$country]['total_courses'] = count($ccCourses);
                        $countryArray[$country]['total_in_courses'] = count($invcountryCourse);

                        $countryArray[$country]['total_apps'] = $totalApp;
                        $countryArray[$country]['total_city'] = $totalCity;
                        $countryArray[$country]['total_army'] = $totalArmy;
                        $countryArray[$country]['total_police'] = $totalPolice;
                        $countryArray[$country]['total_apps_fem'] = $totalAppFem;
                        $countryArray[$country]['cost'] = $totalCost;
                        $conAr[$country] = true;
                    }
                    //                    dd($countryArray);

                    foreach ($countryArray as $key => $value) {

                        $array[] = $value;
                    }
                }
            }
        }

        $countries = $array;
        $countryArrayData['total_courses'] = 0;
        $countryArrayData['total_in_courses'] = 0;
        $countryArrayData['total_apps'] = 0;
        $countryArrayData['total_city'] = 0;
        $countryArrayData['total_army'] = 0;
        $countryArrayData['total_police'] = 0;
        $countryArrayData['total_apps_fem'] = 0;
        $countryArrayData['cost'] = 0;
        foreach ($countries as $country) {
            $countryArrayData['total_courses'] += $country['total_courses'];
            $countryArrayData['total_in_courses'] += $country['total_in_courses'];
            $countryArrayData['total_apps'] += $country['total_apps'];
            $countryArrayData['total_city'] += $country['total_city'];
            $countryArrayData['total_army'] += $country['total_army'];
            $countryArrayData['total_police'] += $country['total_police'];
            $countryArrayData['total_apps_fem'] += $country['total_apps_fem'];
            $countryArrayData['cost'] += $country['cost'];
        }

        if (getRequest('print') == 'true') {
            $lang = getRequest('lang');
            if (empty($lang)) {
                $lang = 'ar';
            }
            App::setLocale($lang);
            $title = awtTrans($title);

            if (getRequest('rep_title') != null) {
                $title = getRequest('rep_title');
            }

            return view('reports.pdf.6th', compact('title', 'country', 'lang', 'active', 'countries', 'countryArrayData', 'experts', 'costs', 'coursesDetails', 'mainDetails'));
        }

        return view('reports.6th', compact('title', 'country', 'active', 'countries', 'countryArrayData', 'experts', 'costs', 'coursesDetails', 'mainDetails'));
    }

    public function Render7thReport(): View
    {

        $course = getRequest('course');
        $title = 'تقرير عن تفاصيل دورة محددة';
        $active = 'reports';
        $course = Course::where('id', $course)->first();
        $countryArrayData = [];
        $experts = [];
        $costs = [];
        $coursesDetails = [];
        $mainDetails = [];
        $cost = getRequest('cost');

        if (empty($course)) {
            $course = [];
        }
        $model = $course;
        if (getRequest('print') == 'true') {
            $print_choices = getRequest('print_choices');
            $lang = getRequest('lang');
            if (empty($lang)) {
                $lang = 'ar';
            }
            App::setLocale($lang);
            $title = awtTrans($title);

            if (getRequest('rep_title') != null) {
                $title = getRequest('rep_title');
            }

            return view('reports.pdf.7th', compact('title', 'print_choices', 'lang', 'active', 'model', 'countryArrayData', 'experts', 'costs', 'coursesDetails', 'mainDetails'));
        }

        return view('reports.7th', compact('title', 'cost', 'active', 'model', 'countryArrayData', 'experts', 'costs', 'coursesDetails', 'mainDetails'));
    }

    public function Render8thReport(): View
    {

        $course = getRequest('course');
        $title = 'تقرير مجمع عن دورات الجيش';
        $active = 'reports';

        $course = Course::where('id', $course)->first();
        if (empty($course)) {
            $course = [];
        }
        $model = $course;

        return view('reports.8th', compact('title', 'active', 'model', 'countryArrayData', 'experts', 'costs', 'coursesDetails', 'mainDetails'));
    }

    public function Render9thReport(): View
    {

        $course = getRequest('course');
        $title = 'تقرير مجمع عن دورات الشرطة';
        $active = 'reports';
        $course = Course::where('id', $course)->first();
        if (empty($course)) {
            $course = [];
        }
        $model = $course;

        return view('reports.9th', compact('title', 'active', 'model', 'countryArrayData', 'experts', 'costs', 'coursesDetails', 'mainDetails'));
    }

    public function Render10thReport($title = null)
    {

        $country = getRequest('country');

        if ($country == null) {
            $country = 'all';
        }
        $from = getRequest('date_from');
        $type = getRequest('type');
        $field = getRequest('field');
        $to = getRequest('date_to');
        if ($type == 'citizan') {

            $title = 'تقرير عن الدورات المنعقدة في مجال محدد خلال فترة زمنية';
        } elseif ($type == 'army') {

            $title = 'تقرير مجمع عن دورات الجيش';
        } elseif ($type == 'police') {

            $title = 'تقرير مجمع عن دورات الشرطه';
        }

        $active = 'reports';
        $countryArrayData = [];
        $experts = [];
        $mainDetails = [];

        $coursesDetails = [];
        $mainDetails['total'] = 0;
        $mainDetails['total_apps'] = 0;
        $mainDetails['total_fapps'] = 0;
        $mainDetails['total_city'] = 0;
        $mainDetails['total_army'] = 0;
        $mainDetails['total_police'] = 0;
        $costs = [];
        $costs['courses'] = 0;
        $courses = [];
        $ids = [];
        if (getRequest('country') == 'all') {

            // $applicants = Application::get();
            // // $model = Course::where('type_id', $type);
            // $applicants = $applicants->groupBy('course_id');
            // $ids = [];
            // foreach ($applicants as $applicant ) {
            //     foreach($applicant as $applicant_id){
            //         $ids[] = $applicant_id->course_id;
            //     }
            // }
            if ($type == null) {
                $model = Course::query();
            } else {
                $model = Course::where('type_id', $type);
            }
        } else {
            $applicants = Application::where('nationality', $country)->get();
            $applicants = $applicants->groupBy('course_id');
            $ids = [];
            foreach ($applicants as $applicant) {
                foreach ($applicant as $applicant_id) {
                    $ids[] = $applicant_id->course_id;
                }
            }
            $model = Course::whereIn('id', $ids);
        }

        if (isset($from)) {
            if (isset($to)) {
                $model
                    ->whereBetween('start_date', [$from, $to]);
                //                        ->groupBy(function ($date) {
                //                            return Carbon::parse($date->start_date)->format('Y'); // grouping by years
                //                            //return Carbon::parse($date->created_at)->'m'); // grouping by months
                //                        });

            } else {
                $model->where('start_date', '>=', $from);
                //                        ->groupBy(function ($date) {
                //                            return Carbon::parse($date->start_date)->format('Y'); // grouping by years
                //                            //return Carbon::parse($date->created_at)->format('m'); // grouping by months
                //                        });
            }
        }

        if (isset($from)) {
            if (isset($to)) {
                $model->whereBetween('start_date', [$from, $to]);
            } else {
                $model->where('start_date', '>=', $from);
            }
        }

        $courses = $model->orderBy('start_date', 'ASC')->get();
        foreach ($courses as $key => $item) {

            if (isset($type)) {
                if (isset($item->type_id) && $item->type_id != $type) {
                    unset($courses[$key]);

                    continue;
                }
            }

            if (isset($field)) {
                if ($item->field_id != $field) {
                    unset($courses[$key]);

                    continue;
                }
            }

            if (!isset($costs['courses'])) {

                $costs['courses'] = 0;
            }
            if (!isset($coursesDetails['total_apps'])) {

                $coursesDetails['total_apps'] = 0;
            }
            if (!isset($coursesDetails['total_fapps'])) {

                $coursesDetails['total_fapps'] = 0;
            }

            if (!isset($coursesDetails['city'])) {

                $coursesDetails['city'] = 0;
            }
            if (!isset($coursesDetails['city_cost'])) {

                $coursesDetails['city_cost'] = 0;
            }
            if (!isset($coursesDetails['other_cost'])) {

                $coursesDetails['other_cost'] = 0;
            }
            if (!isset($coursesDetails['other'])) {

                $coursesDetails['other'] = 0;
            }
            $fCost = 0;

            if (count($item->applications) > 0) {
                if ($country == 'all') {
                    $fCost = $item->applications()->count();
                } else {
                    $fCost = $item->applications()->where('nationality', $country)->count();
                }
            }

            $costs['courses'] += ($fCost * $item->cost);
            $coursesDetails['total_apps'] += $fCost;
            //                $coursesDetails[$key]['total_fapps']+=$item->applications()->where('gender','female')->count();

            if ($item->type_id == 'citizan') {
                $coursesDetails['city_cost'] += ($fCost * $item->cost);
                $coursesDetails['city'] += 1;
            } else {
                $coursesDetails['other_cost'] += ($fCost * $item->cost);
                $coursesDetails['other'] += 1;
            }

            $mainDetails['total'] += 1;
            $mainDetails['total_apps'] += $fCost;
            $mainDetails['total_fapps'] = $item->applications->where('gender', 'female')->count();

            if ($item->type_id == 'citizan') {
                $mainDetails['total_city'] += 1;
            }
            if ($item->type_id == 'army') {
                $mainDetails['total_army'] += 1;
            }
            if ($item->type_id == 'police') {
                $mainDetails['total_police'] += 1;
            }
        }

        foreach ($costs as $value) {
            if (!isset($costs['total'])) {
                $costs['total'] = 0;
            }
            $costs['total'] += $value;
        }

        if (getRequest('print') == 'true') {
            $lang = getRequest('lang');
            if (empty($lang)) {
                $lang = 'ar';
            }
            App::setLocale($lang);
            $title = awtTrans($title);

            if (getRequest('rep_title') != null) {
                $title = getRequest('rep_title');
            }

            return view('reports.pdf.10th', compact('title', 'country', 'lang', 'active', 'courses', 'countryArrayData', 'experts', 'costs', 'coursesDetails', 'mainDetails'));
        }

        return view('reports.10th', compact('title', 'country', 'active', 'courses', 'countryArrayData', 'experts', 'costs', 'coursesDetails', 'mainDetails'));
    }

    public function Render11thReport($title = null): View
    {
        $country = getRequest('country');
        $dcountry = getRequest('dcountry');
        $type = getRequest('type');
        $from = getRequest('date_from');
        $type = getRequest('type');
        $to = getRequest('date_to');
        $status = getRequest('status');

        if ($title == null) {
            $title = 'تقرير مجمع عن خبراء الوكالة خلال فترة معينة';
        }

        $active = 'reports';

        $courses = [];
        $experts = [];
        $countryArrayData = [];
        $coursesDetails = [];
        $mainDetails = [];

        if (isset($country) || isset($from)) {

            if (isset($dcountry)) {
                if (isset($status)) {
                    $courses = Expert::where('country', 'LIKE', '%' . $country . '%')->where('delegate_country', 'LIKE', '%' . $dcountry . '%')->where('status', $status)->orderBy('contract_date', 'asc')->get();
                } else {
                    $courses = Expert::where('country', 'LIKE', '%' . $country . '%')->where('delegate_country', 'LIKE', '%' . $dcountry . '%')->orderBy('contract_date', 'asc')->get();
                }
                $courses = Expert::where('country', 'LIKE', '%' . $country . '%')->where('delegate_country', 'LIKE', '%' . $dcountry . '%')->orderBy('contract_date', 'asc')->get();
                if (isset($from)) {
                    if (isset($to)) {
                        if (isset($status)) {
                            $courses = Expert::where('country', 'LIKE', '%' . $country . '%')->where('status', $status)->where('delegate_country', 'LIKE', '%' . $dcountry . '%')
                                ->whereBetween('contract_date', [$from, $to])
                                ->orderBy('contract_date', 'asc')->get();
                        } else {
                            $courses = Expert::where('country', 'LIKE', '%' . $country . '%')->where('delegate_country', 'LIKE', '%' . $dcountry . '%')
                                ->whereBetween('contract_date', [$from, $to])
                                ->orderBy('contract_date', 'asc')->get();
                        }
                    } else {
                        if (isset($status)) {
                            $courses = Expert::where('country', 'LIKE', '%' . $country . '%')->where('status', $status)->where('delegate_country', 'LIKE', '%' . $dcountry . '%')
                                ->where('contract_date', '>', $from)
                                ->orderBy('contract_date', 'asc')->get();
                        } else {
                            $courses = Expert::where('country', 'LIKE', '%' . $country . '%')->where('delegate_country', 'LIKE', '%' . $dcountry . '%')
                                ->where('contract_date', '>', $from)
                                ->orderBy('contract_date', 'asc')->get();
                        }
                    }
                }
            } else {

                if (isset($status)) {
                    $courses = Expert::where('country', 'LIKE', '%' . $country . '%')->where('status', $status)->orderBy('contract_date', 'asc')->get();
                } else {
                    $courses = Expert::where('country', 'LIKE', '%' . $country . '%')->orderBy('contract_date', 'asc')->get();
                }

                if (isset($from)) {
                    if (isset($to)) {

                        if (isset($status)) {
                            $courses = Expert::where('country', 'LIKE', '%' . $country . '%')
                                ->where('status', $status)->whereBetween('contract_date', [$from, $to])
                                ->orderBy('contract_date', 'asc')->get();
                        } else {
                            $courses = Expert::where('country', 'LIKE', '%' . $country . '%')
                                ->whereBetween('contract_date', [$from, $to])
                                ->orderBy('contract_date', 'asc')->get();
                        }
                    } else {
                        if (isset($status)) {
                            $courses = Expert::where('country', 'LIKE', '%' . $country . '%')
                                ->where('status', $status)
                                ->where('contract_date', '>', $from)
                                ->orderBy('contract_date', 'asc')->get();
                        } else {
                            $courses = Expert::where('country', 'LIKE', '%' . $country . '%')
                                ->where('contract_date', '>', $from)
                                ->orderBy('contract_date', 'asc')->get();
                        }
                    }
                }
            }
        } elseif (isset($dcountry)) {

            if (isset($status)) {
                $courses = Expert::where('delegate_country', 'LIKE', '%' . $country . '%')->where('status', $status)->orderBy('contract_date', 'asc')->get();
            } else {
                $courses = Expert::where('delegate_country', 'LIKE', '%' . $dcountry . '%')->orderBy('contract_date', 'asc')->get();
            }

            if (isset($from)) {
                if (isset($to)) {

                    if (isset($status)) {
                        $courses = Expert::where('delegate_country', 'LIKE', '%' . $country . '%')
                            ->where('status', $status)->whereBetween('contract_date', [$from, $to])
                            ->orderBy('contract_date', 'asc')->get();
                    } else {
                        $courses = Expert::where('delegate_country', 'LIKE', '%' . $dcountry . '%')
                            ->whereBetween('contract_date', [$from, $to])
                            ->orderBy('contract_date', 'asc')->get();
                    }
                } else {

                    if (isset($status)) {
                        $courses = Expert::where('delegate_country', 'LIKE', '%' . $dcountry . '%')
                            ->where('status', $status)
                            ->where('contract_date', '>', $from)
                            ->orderBy('contract_date', 'asc')->get();
                    } else {
                        $courses = Expert::where('delegate_country', 'LIKE', '%' . $dcountry . '%')
                            ->where('contract_date', '>', $from)
                            ->orderBy('contract_date', 'asc')->get();
                    }
                }
            }
        } else {
            if (isset($status)) {
                $courses = Expert::where('status', $status)->orderBy('contract_date', 'asc')->get();
            } else {
                $courses = Expert::orderBy('contract_date', 'asc')->get();
            }
            if (isset($from)) {
                if (isset($to)) {
                    if (isset($status)) {
                        $courses = Expert::where('status', $status)->whereBetween('contract_date', [$from, $to])
                            ->orderBy('contract_date', 'asc')->get();
                    } else {
                        $courses = Expert::whereBetween('contract_date', [$from, $to])
                            ->orderBy('contract_date', 'asc')->get();
                    }
                } else {
                    if (isset($status)) {
                        $courses = Expert::where('status', $status)->where('contract_date', '>', $from)
                            ->orderBy('contract_date', 'asc')->get();
                    } else {
                        $courses = Expert::where('contract_date', '>', $from)
                            ->orderBy('contract_date', 'asc')->get();
                    }
                }
            }
        }

        $experts = $courses;

        $costs['experts'] = 0;
        foreach ($experts as $key => $aid) {

            $costs['experts'] += $aid->cost;
        }

        if (getRequest('print') == 'true') {
            $lang = getRequest('lang');
            if (empty($lang)) {
                $lang = 'ar';
            }
            $print_choices = getRequest('print_choices');

            App::setLocale($lang);
            $title = awtTrans($title);
            if (getRequest('rep_title') != null) {
                $title = getRequest('rep_title');
            }

            return view('reports.pdf.11th', compact('title', 'print_choices', 'dcountry', 'lang', 'active', 'experts', 'countryArrayData', 'experts', 'costs', 'coursesDetails', 'mainDetails'));
        }

        return view('reports.11th', compact('title', 'dcountry', 'active', 'experts', 'countryArrayData', 'experts', 'costs', 'coursesDetails', 'mainDetails'));
    }

    public function Render14thReport($title = null): View
    {
        $country = getRequest('country');
        $type = getRequest('type');
        $from = getRequest('date_from');
        $type = getRequest('type');
        $to = getRequest('date_to');
        if ($title == null) {
            $title = 'تقرير مجمع عن المعونات المقدمة من الوكالة خلال فترة معينة';
        }
        $active = 'reports';
        $countryArrayData = [];
        $experts = [];
        $costs = [];
        $coursesDetails = [];
        $mainDetails = [];
        $courses = [];
        if (isset($country) || isset($from)) {

            $courses = Aid::where('country_id', 'LIKE', '%' . $country . '%')->orderBy('ship_date', 'asc')->get();
            if (isset($from)) {
                if (isset($to)) {
                    $courses = Aid::where('country_id', 'LIKE', '%' . $country . '%')
                        ->whereBetween('ship_date', [$from, $to])
                        ->orderBy('ship_date', 'asc')->get();
                } else {
                    $courses = Aid::where('country_id', 'LIKE', '%' . $country . '%')
                        ->where('ship_date', '>', $from)
                        ->orderBy('ship_date', 'asc')->get();
                }
            }
        } else {
            $courses = Aid::orderBy('ship_date', 'asc')->get();
            if (isset($from)) {
                if (isset($to)) {
                    $courses = Aid::whereBetween('ship_date', [$from, $to])
                        ->orderBy('ship_date', 'asc')->get();
                } else {
                    $courses = Aid::where('ship_date', '>', $from)
                        ->orderBy('ship_date', 'asc')->get();
                }
            }
        }

        $aids = $courses;

        $costs['aids'] = 0;
        foreach ($aids as $key => $aid) {
            if (isset($type)) {
                if ($aid->type_id != $type) {
                    unset($aids[$key]);

                    continue;
                }
            }
            $costs['aids'] += $aid->cost;
        }
        $aidsByCountry = [];

        foreach ($aids as $a) {
            if ($a->suppliers != null) {
                $Aidsuppliers = unserialize($a->suppliers);
            } else {
                $Aidsuppliers = [];
            }
            //            dd($Aidsuppliers);
            $a->suppArray = $Aidsuppliers;
            $aidsByCountry[$a->country_id]['aids'][] = $a;
            $aidsByCountry[$a->country_id]['total_suppliers'] = count($Aidsuppliers);
        }

        //        dd($aidsByCountry);
        if (getRequest('print') == 'true') {
            $lang = getRequest('lang');
            if (empty($lang)) {
                $lang = 'ar';
            }
            App::setLocale($lang);
            $title = awtTrans($title);

            if (getRequest('rep_title') != null) {
                $title = getRequest('rep_title');
            }

            return view('reports.pdf.12th', compact('aidsByCountry', 'title', 'lang', 'active', 'aids', 'countryArrayData', 'experts', 'costs', 'coursesDetails', 'mainDetails'));
        }

        return view('reports.12th', compact('aidsByCountry', 'title', 'active', 'aids', 'countryArrayData', 'experts', 'costs', 'coursesDetails', 'mainDetails'));
    }

    public function Render17thReport(): View
    {

        $from = getRequest('date_from');
        $type = getRequest('type');
        $to = getRequest('date_to');
        $title = 'تقرير مجمع عن أعمال الوكالة خلال فترة معينة';
        if (getRequest('cost') == 1) {
            $title = 'تقرير مجمع عن أعمال الوكالة خلال فترة معينة شامل التكلفه';
        }
        $active = 'reports';
        $countryArrayData = [];
        $experts = [];
        $costs = [];
        $coursesDetails = [];
        $mainDetails = [];
        $courses = Course::all();
        $countries = [];
        if (isset($from)) {
            if (isset($to)) {
                $courses = Course::whereBetween('start_date', [$from, $to])
                    ->get();
            } else {
                $courses = Course::where('start_date', '>', $from)
                    ->get();
            }
        }
        $applicants = Application::select('applications.*')->join('courses', 'applications.course_id', '=', 'courses.id')->orderBy('courses.start_date', 'asc')->get();
        if (isset($from) || isset($to)) {
            $ids = [];
            foreach ($courses as $course) {
                $ids[] = $course->id;
            }
            $applicants = Application::whereIn('course_id', $ids)->get();
        }
        $aids = Aid::all();
        if (isset($from)) {
            if (isset($to)) {
                $aids = Aid::whereBetween('ship_date', [$from, $to])
                    ->get();
            } else {
                $aids = Aid::where('ship_date', '>', $from)
                    ->get();
            }
        }

        $experts = Expert::all();
        if (isset($from)) {
            if (isset($to)) {
                $experts = Expert::whereBetween('contract_date', [$from, $to])
                    ->get();
            } else {
                $experts = Expert::where('contract_date', '>', $from)
                    ->get();
            }
        }
        foreach ($experts as $expert) {
            $countriesEX[$expert->country] = $expert->country;
        }
        foreach ($aids as $aid) {
            $countriesAids[$aid->country_id] = $aid->country_id;
        }

        $mainData = [];
        $mainData['total_courses'] = count($courses);
        $mainData['total_citizen'] = 0;
        $mainData['total_army'] = 0;
        $mainData['total_police'] = 0;
        $mainData['total_apps'] = count($applicants);
        $mainData['total_female'] = 0;
        $mainData['total_aids'] = count($aids);
        $mainData['total_experts'] = count($experts);
        $mainData['total_countries'] = 0;
        $mainData['total_c_cost'] = 0;
        $mainData['total_a_cost'] = 0;
        $mainData['total_e_cost'] = 0;

        $countries = [];
        foreach ($courses as $course) {
            if ($course->type_id == 'citizan') {
                $mainData['total_citizen'] += 1;
            }

            if ($course->type_id == 'army') {
                $mainData['total_army'] += 1;
            }

            if ($course->type_id == 'police') {
                $mainData['total_police'] += 1;
            }
            $app = $course->applications->count();
            $mainData['total_c_cost'] += $course->cost * $app;
        }

        foreach ($applicants as $applicant) {
            if ($applicant->gender == 'female') {
                $mainData['total_female'] += 1;
            }
            $countriesApp[$applicant->nationality] = $applicant->nationality;
        }
        foreach ($aids as $aid) {

            $mainData['total_a_cost'] += $aid->cost;
        }
        foreach ($experts as $expert) {

            $mainData['total_e_cost'] += $expert->cost;
        }

        $countries = $countriesApp + $countriesEX + $countriesAids;

        $mainData['total_countries'] += count(array_unique($countries));
        if (getRequest('print') == 'true') {
            $lang = getRequest('lang');
            if (empty($lang)) {
                $lang = 'ar';
            }
            App::setLocale($lang);
            $title = awtTrans($title);

            if (getRequest('rep_title') != null) {
                $title = getRequest('rep_title');
            }

            return view('reports.pdf.13th', compact('title', 'lang', 'active', 'aids', 'countryArrayData', 'experts', 'costs', 'coursesDetails', 'mainData'));
        }

        return view('reports.13th', compact('title', 'active', 'aids', 'countryArrayData', 'experts', 'costs', 'coursesDetails', 'mainData'));
    }

    public function Render18thReport()
    {
        $from = getRequest('date_from');
        $type = getRequest('type');
        $to = getRequest('date_to');
        $title = 'تقرير مجمع عن أعمال الوكالة مرتبة بالعام المالي';
        if (getRequest('cost') == 1) {
            $title = 'تقرير مجمع عن أعمال الوكالة مرتبة بالعام المالي شامل التكلفه ';
        }

        $active = 'reports';
        $countryArrayData = [];
        $experts = [];
        $costs = [];
        $coursesDetails = [];
        $mainDetails = [];
        // $applicants = Application::get();
        // $applicants = $applicants->groupBy('course_id');

        // $ids = [];
        // foreach ($applicants as $applicant) {
        //     foreach ($applicant as $applicant_id) {
        //         $ids[] = $applicant_id->course_id;
        //     }
        // }
        // $course_model->whereIn('id', $ids)->get();

        $course_model = Course::query();
        $aids_model = Aid::query();
        $experts_model = Expert::query();
        $scholarships_model = Scholarships::query();
        if (isset($from)) {
            if (isset($to)) {
                $course_model->whereBetween('start_date', [$from, $to]);
                $scholarships_model->whereBetween('start_date', [$from, $to]);
                $aids_model->whereBetween('ship_date', [$from, $to]);
                $experts_model->whereBetween('contract_date', [$from, $to]);
            } else {
                $course_model->where('start_date', '=>', $from);
                $scholarships_model->where('start_date', '=>', $from);
                $aids_model->where('ship_date', '>', $from);
                $experts_model->where('contract_date', '>', $from);
            }
        }
        $courses = $course_model->get();
        $scholarships = $scholarships_model->get();
        // $courses =  $course_model->get()->groupBy(function ($date) {
        //     return Carbon::parse($date->start_date)->format('Y');
        // })->sortKeys();
        $aids = $aids_model->get();
        // $aids =  $aids_model->get()->groupBy(function ($date) {
        //     return Carbon::parse($date->ship_date)->format('Y');
        // })->sortKeys();
        $experts = $experts_model->get();
        // $experts =  $experts_model->get()->groupBy(function ($date) {
        //     return Carbon::parse($date->contract_date)->format('Y');
        // })->sortKeys();

        $mainData = [];

        $total_coursers_year = 0;
        $total_countries_year = 0;
        $total_cost_courses_year = 0;
        $total_apps_year = 0;
        $total_apps_fe_year = 0;
        $total_city_year = 0;
        $total_army_year = 0;
        $total_police_year = 0;
        $countries = [];

        foreach ($courses as $key => $course) {
            // foreach ($value as $course) {

            $total_coursers_year += 1;
            $total_apps_year += $course->applications()->count();
            $total_apps_fe_year += $course->applications()->where('gender', 'female')->count();
            $total_cost_courses_year += $course->applications()->count() * $course->cost;
            if ($course->type_id == 'citizan') {
                $total_city_year += 1;
            }
            if ($course->type_id == 'army') {
                $total_army_year += 1;
            }
            if ($course->type_id == 'police') {
                $total_police_year += 1;
            }
            // عدد الدول المستفيده
            foreach ($course->applications()->groupBy('nationality')->get(['nationality']) as $applicant) {
                $countries[$applicant->nationality] = $applicant->nationality;
            }
            // $total_courses_countries_year=count(array_unique($courses_countries));
            // }

        }
        $mainData['total_sc_cost'] = 0;
        foreach ($scholarships as $scholarship) {
            $mainData['total_sc_cost'] += $scholarship->annual_cost;

            foreach (unserialize($scholarship->participants) as $c) {
                $countries[$c] = $c;
            }
        }

        $mainData['total_scholarships'] = count($scholarships);
        $mainData['total_courses'] = $total_coursers_year;
        $mainData['total_citizen'] = $total_city_year;
        $mainData['total_army'] = $total_army_year;
        $mainData['total_police'] = $total_police_year;
        $mainData['total_apps'] = $total_apps_year;
        $mainData['total_female'] = $total_apps_fe_year;
        //    $mainData['total_courses_countries']=$courses_countries;
        $mainData['total_cost_courses_year'] = $total_cost_courses_year;

        $total_aids_year = 0;
        $total_cost_aids_year = 0;

        foreach ($aids as $key => $aid) {

            // foreach ($value as $aid) {

            $total_aids_year += 1;
            $total_cost_aids_year += $aid->cost;
            $countries[$aid->country_id] = $aid->country_id;

            // }
            // $total_aids_countries_year=count(array_unique($aids_countries));

        }
        $mainData['total_aids'] = $total_aids_year;
        // $mainData['total_aids_countries']=$aids_countries;
        $mainData['total_cost_aids_year'] = $total_cost_aids_year;
        $total_experts_year = 0;
        $total_cost_experts_year = 0;
        foreach ($experts as $key => $expert) {

            $total_experts_year += 1;
            $total_cost_experts_year += $expert->cost;
            $countries[$expert->delegate_country] = $expert->delegate_country;

            // $total_experts_countries_year=count(array_unique($experts_countries));
            // $mainData['total_experts_countries']=$experts_countries;

        }
        $mainData['total_experts'] = $total_experts_year;
        $mainData['total_cost_experts_year'] = $total_cost_experts_year;

        if (getRequest('print') == 'true') {
            $lang = getRequest('lang');
            if (empty($lang)) {
                $lang = 'ar';
            }
            App::setLocale($lang);
            $title = awtTrans($title);

            if (getRequest('rep_title') != null) {
                $title = getRequest('rep_title');
            }

            return view('reports.pdf.14th', compact('title', 'lang', 'active', 'aids', 'countryArrayData', 'experts', 'costs', 'coursesDetails', 'mainData', 'countries'));
        }

        return view('reports.14th', compact('title', 'active', 'aids', 'countryArrayData', 'experts', 'costs', 'coursesDetails', 'mainData', 'countries'));
    }

    public function Render19thReport(): View
    {
        $Mcountry = getRequest('country');
        $from = getRequest('date_from');
        $to = getRequest('date_to');
        $total_learners = 0;
        $total_cost = 0;
        $title = 'تقرير عن  المنح الدراسية';
        $active = 'reports';
        $scholarships = Scholarships::query();
        if (isset($from)) {
            if (isset($to)) {
                $scholarships->whereBetween('start_date', [$from, $to]);
            } else {
                $scholarships->where('start_date', '>', $from);
            }
        }
        if (isset($Mcountry)) {
            $scholarships->where('participants', 'like', '%' . $Mcountry . '%');
        }
        $scholarships = $scholarships->orderBy('start_date', 'asc')->get();

        foreach ($scholarships as $scholarship) {
            $total_learners += $scholarship->learners->count();
            $total_cost += $scholarship->annual_cost;
        }
        if (getRequest('print') == 'true') {
            $lang = getRequest('lang');
            if (empty($lang)) {
                $lang = 'ar';
            }
            App::setLocale($lang);
            $title = awtTrans($title);

            if (getRequest('rep_title') != null) {
                $title = getRequest('rep_title');
            }

            return view('reports.pdf.19th', compact('title', 'lang', 'active', 'scholarships', 'total_cost', 'total_learners'));
        }

        return view('reports.19th', compact('title', 'active', 'scholarships', 'total_cost', 'total_learners'));
    }

    public function Render20thReport(): View
    {
        $Mcountry = getRequest('country');
        $from = getRequest('date_from');
        $to = getRequest('date_to');

        $title = 'تقرير عن الفاعليات التي شاركت بها الوكاله ';
        $active = 'reports';
        $participants = [];
        $events = Events::all();
        if (isset($from)) {
            if (isset($to)) {
                $events = Events::whereBetween('start_date', [$from, $to])
                    ->get();
            } else {
                $events = Events::where('start_date', '>', $from)
                    ->get();
            }
        }
        $conArr = [];
        if (isset($Mcountry)) {
            foreach ($events as $event) {
                $participants = unserialize($event->participants);
                $countryArray = [];
                foreach ($participants as $participant) {
                    if (!in_array($participant, $Mcountry)) {
                        continue;
                    }
                    if (isset($conAr[$participant])) {
                        continue;
                    }
                    $events = Events::where('participants', 'like', '%' . $participant . '%')->get();
                }
            }
        }
        if (getRequest('print') == 'true') {
            $lang = getRequest('lang');
            if (empty($lang)) {
                $lang = 'ar';
            }
            App::setLocale($lang);
            $title = awtTrans($title);

            if (getRequest('rep_title') != null) {
                $title = getRequest('rep_title');
            }

            return view('reports.pdf.20th', compact('title', 'lang', 'active', 'events', 'participants'));
        }

        return view('reports.20th', compact('title', 'active', 'participants', 'events'));
    }

    public function Render21thReport($title = null): View
    {
        $country = getRequest('country');
        $type = getRequest('type');
        $from = getRequest('date_from');
        $type = 8;
        $to = getRequest('date_to');
        if ($title == null) {
            $title = 'تقرير مجمع عن القوافل المقدمة من الوكالة خلال فترة معينة';
        }
        $active = 'reports';
        $countryArrayData = [];
        $experts = [];
        $costs = [];
        $coursesDetails = [];
        $mainDetails = [];
        $courses = [];
        if (isset($country) || isset($from)) {

            $courses = Aid::where('country_id', 'LIKE', '%' . $country . '%')->where('type_id', '=', '8')->orderBy('ship_date', 'asc')->get();
            if (isset($from)) {
                if (isset($to)) {
                    $courses = Aid::where('country_id', 'LIKE', '%' . $country . '%')->where('type_id', '=', '8')
                        ->whereBetween('ship_date', [$from, $to])
                        ->orderBy('ship_date', 'asc')->get();
                } else {
                    $courses = Aid::where('country_id', 'LIKE', '%' . $country . '%')->where('type_id', '=', '8')
                        ->where('ship_date', '>', $from)
                        ->orderBy('ship_date', 'asc')->get();
                }
            }
        } else {
            $courses = Aid::orderBy('ship_date', 'asc')->get();
            if (isset($from)) {
                if (isset($to)) {
                    $courses = Aid::whereBetween('ship_date', [$from, $to])
                        ->where('type_id', '=', 8)
                        ->orderBy('ship_date', 'asc')->get();
                } else {
                    $courses = Aid::where('ship_date', '>', $from)
                        ->orderBy('ship_date', 'asc')->get();
                }
            }
        }

        $aids = $courses;

        $costs['aids'] = 0;
        foreach ($aids as $key => $aid) {
            if (isset($type)) {
                if ($aid->type_id != $type) {
                    unset($aids[$key]);

                    continue;
                }
            }
            $costs['aids'] += $aid->cost;
        }
        $aidsByCountry = [];

        foreach ($aids as $a) {
            if ($a->suppliers != null) {
                $Aidsuppliers = unserialize($a->suppliers);
            } else {
                $Aidsuppliers = [];
            }
            //            dd($Aidsuppliers);
            $a->suppArray = $Aidsuppliers;
            $aidsByCountry[$a->country_id]['aids'][] = $a;
            $aidsByCountry[$a->country_id]['total_suppliers'] = count($Aidsuppliers);
        }

        //        dd($aidsByCountry);
        if (getRequest('print') == 'true') {
            $lang = getRequest('lang');
            if (empty($lang)) {
                $lang = 'ar';
            }
            App::setLocale($lang);
            $title = awtTrans($title);

            if (getRequest('rep_title') != null) {
                $title = getRequest('rep_title');
            }

            return view('reports.pdf.21th', compact('aidsByCountry', 'title', 'lang', 'active', 'aids', 'countryArrayData', 'experts', 'costs', 'coursesDetails', 'mainDetails'));
        }

        return view('reports.21th', compact('aidsByCountry', 'title', 'active', 'aids', 'countryArrayData', 'experts', 'costs', 'coursesDetails', 'mainDetails'));
    }

    /**
     * Show the comprehensive reports page with global filtering.
     */
    public function comprehensive(Request $request)
    {
        $active = 'reports';
        $query = request('query') ?? $request->query;
        $country = request('country') ?? $request->country;
        $reportType = request('report_type') ?? $request->report_type;
        $dateFrom = request('date_from') ?? $request->date_from;
        $dateTo = request('date_to') ?? $request->date_to;
        $costFrom = request('cost_from') ?? $request->cost_from;
        $costTo = request('cost_to') ?? $request->cost_to;
        $subject = request('subject') ?? $request->subject;
        $entity_type = request('entity_type') ?? $request->entity_type;
        $cost_type = request('cost_type') ?? $request->cost_type;



        // Initialize results array
        $results = [];

        // If we have search parameters or it's an AJAX request
        if ($query || $country || $reportType || $dateFrom || $dateTo || $costFrom || $costTo || $subject || $entity_type || $cost_type || request()->ajax()) {
            // Define which report types to process
            $typesToProcess = [];
            
            if ($reportType == 'all' || !$reportType) {
                $typesToProcess = ['courses', 'experts', 'aids', 'events', 'scholarships'];
            } else {
                $typesToProcess = [$reportType];
            }
            
            // Process each requested data type
            foreach ($typesToProcess as $type) {
                switch ($type) {
                    case 'courses':
                        $coursesQuery = Course::with(['field', 'type']);
                        $this->applyCommonFilters($coursesQuery, $query, $country, $dateFrom, $dateTo, $costFrom, $costTo, $subject ,$entity_type,$cost_type,'course');
                        $results['courses'] = $coursesQuery;
                        break;
                        
                    case 'experts':
                        $expertsQuery = Expert::query();
                        $this->applyCommonFilters($expertsQuery, $query, $country, $dateFrom, $dateTo, $costFrom, $costTo, $subject,$entity_type,$cost_type,'expert');
                        $results['experts'] = $expertsQuery;
                        break;
                        
                    case 'aids':
                        $aidsQuery = Aid::query();
                        $this->applyCommonFilters($aidsQuery, $query, $country, $dateFrom, $dateTo, $costFrom, $costTo, $subject,$entity_type,$cost_type,'aids');
                        $results['aids'] = $this->processAidsResults($aidsQuery);
                        break;
                        
                    case 'events':
                        $eventsQuery = Events::query();
                        $this->applyCommonFilters($eventsQuery, $query, $country, $dateFrom, $dateTo, null, null, $subject,$entity_type,$cost_type,'events');
                        $results['events'] = $this->processEventsResults($eventsQuery);
                        break;
                        
                    case 'scholarships':
                        $scholarshipsQuery = Scholarships::query();
                        $this->applyCommonFilters($scholarshipsQuery, $query, $country, $dateFrom, $dateTo, $costFrom, $costTo, $subject,$entity_type,$cost_type,'scholarships');
                        $results['scholarships'] = $this->processScholarshipsResults($scholarshipsQuery);
                        break;
                }
            }

            return view('reports.comprehensive', compact('active', 'results'));
        }

        return view('reports.comprehensive', compact('active'));
    }

    /**
     * Apply common filters to a query builder instance
     * 
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string|null $searchQuery
     * @param array|null $country
     * @param string|null $dateFrom
     * @param string|null $dateTo
     * @param float|null $costFrom
     * @param float|null $costTo
     * @param string|null $subject
     * @return void
     */
    protected function applyCommonFilters($query, $searchQuery, $country, $dateFrom, $dateTo, $costFrom, $costTo, $subject,$entity_type,$cost_type,$search_type)
    {
        // Each model type has different field names, so we'll handle this in the specific methods
        if($search_type == 'course' &&  isset($entity_type))
        {
            if($entity_type == 1)
            {
                $query->where('type_id','citizan');
            }   

            if($entity_type == 2)
            {
                $query->where('type_id','police');
            }   

            if($entity_type == 2)
            {
                $query->where('type_id','army');
            }   
        }

        if($search_type == 'course' &&  isset($cost_type))
        {
            if($cost_type == 1)
            {
                $query->where('cost','!=',1);
            }   

            if($cost_type == 2)
            {
                $query->where('cost',1);
            }   
        }
    }

    /**
     * Process aids query results
     * 
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    protected function processAidsResults($query)
    {
        $results = $query->paginate(10, ['*'], 'aids_page')->withQueryString();
        
        return $results->each(function ($aid) {
            $aid->country_name = $this->getFormattedCountryName($aid->country_id);
            $aid->type_name = $aid->aid_type ? $aid->aid_type->name : '';
            $aid->ship_date = $this->formatDate($aid->ship_date);
            return $aid;
        });
    }

    /**
     * Process events query results
     * 
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    protected function processEventsResults($query)
    {
        $results = $query->paginate(10, ['*'], 'events_page')->withQueryString();
        
        return $results->each(function ($event) {
            $event->type_name = $event->eventType ? $event->eventType->name_ar : '';
            $event->start_date = $this->formatDate($event->start_date);
            return $event;
        });
    }

    /**
     * Process scholarships query results
     * 
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    protected function processScholarshipsResults($query)
    {
        $results = $query->paginate(10, ['*'], 'scholarships_page')->withQueryString();
        
        return $results->each(function ($scholarship) {
            // Format participants as readable country names
            if (is_string($scholarship->participants) && !empty($scholarship->participants)) {
                $participantCodes = $this->parseParticipantCodes($scholarship->participants);
                $participantNames = array_map([$this, 'getFormattedCountryName'], $participantCodes);
                
                $formattedParticipants = '';
                foreach ($participantNames as $country) {
                    $formattedParticipants .= '<span>' . $country . '</span>';
                }
                $scholarship->participants = '<div class="countries-list">' . $formattedParticipants . '</div>';
            }

            // Format dates
            $scholarship->start_date = $this->formatDate($scholarship->start_date);
            $scholarship->end_date = $this->formatDate($scholarship->end_date);

            return $scholarship;
        });
    }

    /**
     * Parse participant codes from string
     * 
     * @param string $participants
     * @return array
     */
    protected function parseParticipantCodes($participants)
    {
        // Check if it's a serialized array
        if (strpos($participants, 'a:') === 0) {
            try {
                $unserialized = @unserialize($participants);
                if (is_array($unserialized)) {
                    return $unserialized;
                }
            } catch (\Exception $e) {
                // Fall through to comma-separated handling
            }
        }
        
        // Treat as comma-separated
        return explode(',', $participants);
    }

    /**
     * Format a date to a more readable format (YYYY-MM-DD)
     * 
     * @param string|null $date
     * @return string
     */
    protected function formatDate($date)
    {
        if (empty($date)) {
            return '';
        }

        try {
            return date('Y-m-d', strtotime($date));
        } catch (\Exception $e) {
            return $date;
        }
    }

    /**
     * Get a formatted country name from a country code
     * 
     * @param string|null $code
     * @return string
     */
    protected function getFormattedCountryName($code)
    {
        if (empty($code)) {
            return '';
        }

        // Handle comma-separated codes
        if (strpos($code, ',') !== false) {
            $codes = array_map('trim', explode(',', $code));
            $names = [];

            foreach ($codes as $c) {
                $names[] = getCountry($c) ?: $c;
            }

            return implode(' | ', $names);
        }

        return getCountry($code) ?: $code;
    }

    /**
     * Process DataTables AJAX request for comprehensive reports
     * 
     * @param string $type The type of data to fetch (courses|experts|aids|events|scholarships)
     * @return \Illuminate\Http\JsonResponse
     */
    public function getComprehensiveData($type)
    {
        // Common search parameters
        $query = request('query');
        $country = request('country') ;
        $dateFrom = request('date_from') ;
        $dateTo = request('date_to') ;
        $costFrom = request('cost_from') ;
        $costTo = request('cost_to') ;
        $subject = request('subject');
        $entity_type = request('entity_type');

        // Process array parameters if needed
        if ($country && !is_array($country)) {
            $country = strpos($country, ',') !== false ? explode(',', $country) : [$country];
        }

        $methodMap = [
            'courses' => 'getCoursesData',
            'experts' => 'getExpertsData',
            'aids' => 'getAidsData',
            'events' => 'getEventsData',
            'scholarships' => 'getScholarshipsData'
        ];

        if (isset($methodMap[$type])) {
            $method = $methodMap[$type];
            return $this->$method($query, $country, $dateFrom, $dateTo, $costFrom, $costTo, $subject,$entity_type);
        }

        return response()->json(['error' => 'Invalid type specified'], 400);
    }

    /**
     * Get courses data for DataTables
     */
    private function getCoursesData($query, $country, $dateFrom, $dateTo, $costFrom, $costTo, $subject,$entity_type)
    {
        $coursesQuery = Course::with(['field', 'type']);

        if ($query) {
            $coursesQuery->where(function ($q) use ($query) {
                $q->where('name_ar', 'LIKE', "%{$query}%")
                    ->orWhere('name_en', 'LIKE', "%{$query}%")
                    ->orWhere('field_id', function ($subquery) use ($query) {
                        $subquery->select('id')
                            ->from('course_fields')
                            ->where('name_ar', 'LIKE', "%{$query}%")
                            ->orWhere('name_en', 'LIKE', "%{$query}%");
                    });
            });
        }

        if ($country) {
            $coursesQuery->where(function ($q) use ($country) {
                foreach ($country as $c) {
                    $q->orWhere('countries', 'LIKE', "%{$c}%");
                }
            });
        }

        if($entity_type)
        {
            if($entity_type == 1)
            {
                $coursesQuery->where('type_id','citizan');
            }

            if($entity_type == 2)
            {
                $coursesQuery->where('type_id','police');
            }

            if($entity_type == 3)
            {
                $coursesQuery->where('type_id','army');
            }
        }

        if ($subject) {
            $coursesQuery->where(function ($q) use ($subject) {
                $q->where('name_ar', 'LIKE', "%{$subject}%")
                    ->orWhere('name_en', 'LIKE', "%{$subject}%")
                    ->orWhere('field_id', function ($subquery) use ($subject) {
                        $subquery->select('id')
                            ->from('course_fields')
                            ->where('name_ar', 'LIKE', "%{$subject}%")
                            ->orWhere('name_en', 'LIKE', "%{$subject}%");
                    });
            });
        }

        if ($dateFrom) {
            $coursesQuery->where('start_date', '>=', $dateFrom);
        }

        if ($dateTo) {
            $coursesQuery->where('end_date', '<=', $dateTo);
        }

        if ($costFrom) {
            $coursesQuery->where('cost', '>=', $costFrom);
        }

        if ($costTo) {
            $coursesQuery->where('cost', '<=', $costTo);
        }

        $coursesQuery->withCount('applications');

        return datatables()
            ->of($coursesQuery)
            ->addIndexColumn()
            ->addColumn('field_ar', function ($course) {
                return $course->field ? $course->field->name_ar : '';
            })
            ->editColumn('participating_countries', function ($course) {
                $countries = [];
                if ($course->countries) {
                    try {
                        $countriesData = unserialize($course->countries);
                        if (is_array($countriesData)) {
                            $countries = $countriesData;
                        }
                    } catch (\Exception $e) {
                        // If unserialize fails, try as comma-separated
                        $countries = explode(',', $course->countries);
                    }
                }

                $countryNames = array_map([$this, 'getFormattedCountryName'], $countries);

                $formattedCountries = '';
                foreach ($countryNames as $country) {
                    $formattedCountries .= '<span>' . $country . '</span>';
                }

                return '<div class="countries-list">' . $formattedCountries . '</div>';
            })
            ->editColumn('start_date', function ($course) {
                return $this->formatDate($course->start_date);
            })
            ->editColumn('end_date', function ($course) {
                return $this->formatDate($course->end_date);
            })
            ->editColumn('cost', function ($course) {
                return number_format($course->cost, 2);
            })
            ->editColumn('type_name', function ($course) {
                return $course->type ? $course->type->name_ar : '';
            })
            ->rawColumns(['participating_countries'])
            ->make(true);
    }

    /**
     * Get experts data for DataTables
     */
    private function getExpertsData($query, $country, $dateFrom, $dateTo, $costFrom, $costTo, $subject,$entity_type)
    {
        $expertsQuery = Expert::query();

        if ($query) {
            $expertsQuery->where(function ($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%")
                    ->orWhere('specialist', 'LIKE', "%{$query}%")
                    ->orWhere('sub_specialist', 'LIKE', "%{$query}%");
            });
        }

        if ($country) {
            $expertsQuery->where(function ($q) use ($country) {
                foreach ($country as $c) {
                    $q->orWhere('country', $c)
                        ->orWhere('delegate_country', 'LIKE', "%{$c}%");
                }
            });
        }

        if ($subject) {
            $expertsQuery->where(function ($q) use ($subject) {
                $q->where('specialist', 'LIKE', "%{$subject}%")
                    ->orWhere('sub_specialist', 'LIKE', "%{$subject}%");
            });
        }

        if ($dateFrom) {
            $expertsQuery->where('contract_date', '>=', $dateFrom);
        }

        if ($dateTo) {
            $expertsQuery->where('end_date', '<=', $dateTo);
        }

        if ($costFrom) {
            $expertsQuery->where('cost', '>=', $costFrom);
        }

        if ($costTo) {
            $expertsQuery->where('cost', '<=', $costTo);
        }

        return datatables()
            ->of($expertsQuery)
            ->addIndexColumn()
            ->editColumn('country_name', function ($expert) {
                return $this->getFormattedCountryName($expert->country);
            })
            ->editColumn('delegate_country_name', function ($expert) {
                return $this->getFormattedCountryName($expert->delegate_country);
            })
            ->editColumn('contract_date', function ($expert) {
                return $this->formatDate($expert->contract_date);
            })
            ->editColumn('end_date', function ($expert) {
                return $this->formatDate($expert->end_date);
            })
            ->editColumn('cost', function ($expert) {
                return number_format($expert->cost, 2);
            })
            ->make(true);
    }

    /**
     * Get aids data for DataTables
     */
    private function getAidsData($query, $country, $dateFrom, $dateTo, $costFrom, $costTo, $subject,$entity_type)
    {
        $aidsQuery = Aid::with('type');

        if ($query) {
            $aidsQuery->where(function ($q) use ($query) {
                $q->where('notes', 'LIKE', "%{$query}%")
                    ->orWhere('country_id', 'LIKE', "%{$query}%")
                    ->orWhere('country_org', 'LIKE', "%{$query}%")
                    ->orWhere('minister_name', 'LIKE', "%{$query}%")
                    ->orWhereHas('type', function ($subquery) use ($query) {
                        $subquery->where('name_ar', 'LIKE', "%{$query}%")
                            ->orWhere('name_en', 'LIKE', "%{$query}%");
                    });
            });
        }

        if ($country) {
            $aidsQuery->where(function ($q) use ($country) {
                foreach ($country as $c) {
                    $q->orWhere('country_id', 'LIKE', "%{$c}%");
                }
            });
        }

        if ($subject) {
            $aidsQuery->where(function ($q) use ($subject) {
                $q->where('country_org', 'LIKE', "%{$subject}%")
                    ->orWhere('minister_name', 'LIKE', "%{$subject}%")
                    ->orWhere('notes', 'LIKE', "%{$subject}%")
                    ->orWhereHas('type', function ($subquery) use ($subject) {
                        $subquery->where('name_ar', 'LIKE', "%{$subject}%")
                            ->orWhere('name_en', 'LIKE', "%{$subject}%");
                    });
            });
        }

        if ($dateFrom) {
            $aidsQuery->where('ship_date', '>=', $dateFrom);
        }

        if ($dateTo) {
            $aidsQuery->where('ship_date', '<=', $dateTo);
        }

        if ($costFrom) {
            $aidsQuery->where('cost', '>=', $costFrom);
        }

        if ($costTo) {
            $aidsQuery->where('cost', '<=', $costTo);
        }

        return datatables()
            ->of($aidsQuery)
            ->addIndexColumn()
            ->addColumn('name_ar', function ($aid) {
                return $aid->country_org ?? '';
            })
            ->editColumn('country_name', function ($aid) {
                return $this->getFormattedCountryName($aid->country_id);
            })
            ->editColumn('type_name', function ($aid) {
                return $aid->type ? $aid->type->name_ar : '';
            })
            ->editColumn('ship_date', function ($aid) {
                return $this->formatDate($aid->ship_date);
            })
            ->editColumn('cost', function ($aid) {
                return number_format($aid->cost, 2);
            })
            ->make(true);
    }

    /**
     * Get events data for DataTables
     */
    private function getEventsData($query, $country, $dateFrom, $dateTo, $costFrom, $costTo, $subject,$entity_type)
    {
        $eventsQuery = Events::with('type');

        if ($query) {
            $eventsQuery->where(function ($q) use ($query) {
                $q->where('subject', 'LIKE', "%{$query}%")
                    ->orWhere('location', 'LIKE', "%{$query}%")
                    ->orWhere('notes', 'LIKE', "%{$query}%");
            });
        }

        if ($country) {
            $eventsQuery->where(function ($q) use ($country) {
                foreach ($country as $c) {
                    $q->orWhere('participants', 'LIKE', "%{$c}%");
                }
            });
        }

        if ($subject) {
            $eventsQuery->where('subject', 'LIKE', "%{$subject}%");
        }

        if ($dateFrom) {
            $eventsQuery->where('start_date', '>=', $dateFrom);
        }

        if ($dateTo) {
            $eventsQuery->where('start_date', '<=', $dateTo);
        }

        return datatables()
            ->of($eventsQuery)
            ->addIndexColumn()
            ->addColumn('place', function ($event) {
                return $event->location ?? '';
            })
            ->addColumn('comp_names', function ($event) {
                if (!empty($event->participants)) {
                    try {
                        $participants = unserialize($event->participants);
                        if (is_array($participants)) {
                            $participantNames = array_map([$this, 'getFormattedCountryName'], $participants);
                            return implode(' | ', $participantNames);
                        }
                    } catch (\Exception $e) {
                        // If unserialize fails
                        return $event->participants;
                    }
                }
                return '';
            })
            ->editColumn('type_name', function ($event) {
                return $event->type ? $event->type->name_ar : '';
            })
            ->editColumn('start_date', function ($event) {
                return $this->formatDate($event->start_date);
            })
            ->make(true);
    }

    /**
     * Get scholarships data for DataTables
     */
    private function getScholarshipsData($query, $country, $dateFrom, $dateTo, $costFrom, $costTo, $subject,$entity_type)
    {
        $scholarshipsQuery = Scholarships::with('field');

        if ($query) {
            $scholarshipsQuery->where(function ($q) use ($query) {
                $q->where('program', 'LIKE', "%{$query}%")
                    ->orWhere('owner', 'LIKE', "%{$query}%")
                    ->orWhere('participants', 'LIKE', "%{$query}%");
            });
        }

        if ($country) {
            $scholarshipsQuery->where(function ($q) use ($country) {
                foreach ($country as $c) {
                    $q->orWhere('participants', 'LIKE', "%{$c}%");
                }
            });
        }

        if ($subject) {
            $scholarshipsQuery->where(function ($q) use ($subject) {
                $q->where('program', 'LIKE', "%{$subject}%")
                    ->orWhere('department', 'LIKE', "%{$subject}%");
            });
        }

        if ($dateFrom) {
            $scholarshipsQuery->where('start_date', '>=', $dateFrom);
        }

        if ($dateTo) {
            $scholarshipsQuery->where('end_date', '<=', $dateTo);
        }

        if ($costFrom) {
            $scholarshipsQuery->where('annual_cost', '>=', $costFrom);
        }

        if ($costTo) {
            $scholarshipsQuery->where('annual_cost', '<=', $costTo);
        }

        return datatables()
            ->of($scholarshipsQuery)
            ->addIndexColumn()
            ->addColumn('name_ar', function ($scholarship) {
                return $scholarship->program ?? '';
            })
            ->addColumn('specialization', function ($scholarship) {
                return $scholarship->field ? $scholarship->field->name_ar : '';
            })
            ->editColumn('participants', function ($scholarship) {
                if (is_string($scholarship->participants) && !empty($scholarship->participants)) {
                    $participantCodes = $this->parseParticipantCodes($scholarship->participants);
                    $participantNames = array_map([$this, 'getFormattedCountryName'], $participantCodes);
                    
                    $formattedParticipants = '';
                    foreach ($participantNames as $country) {
                        $formattedParticipants .= '<span>' . $country . '</span>';
                    }

                    return '<div class="countries-list">' . $formattedParticipants . '</div>';
                }

                return '';
            })
            ->editColumn('start_date', function ($scholarship) {
                return $this->formatDate($scholarship->start_date);
            })
            ->editColumn('end_date', function ($scholarship) {
                return $this->formatDate($scholarship->end_date);
            })
            ->editColumn('annual_cost', function ($scholarship) {
                return number_format($scholarship->annual_cost, 2);
            })
            ->rawColumns(['participants'])
            ->make(true);
    }
}
