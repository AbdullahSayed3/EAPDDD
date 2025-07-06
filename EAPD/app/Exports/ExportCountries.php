<?php

namespace App\Exports;

use App\Models\Application;
use App\Models\Course;
use DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;

class ExportCountries implements FromView
{
    use Exportable;

    public function __construct(array $ids, $view, $inv = false)
    {
        $this->ids = $ids;
        $this->view = $view;
        $this->inv = $inv;
        $this->model = Course::class;

    }

    public function view(): View
    {
        $array = [];
        $model = $this->model::query();
        $course = $model->get();
        $ajaxRequest = filterDatatableGet($_GET);

        if (isset($ajaxRequest['inv']) && $ajaxRequest['inv'] != null) {
            $course = Course::where('id', getRequest('c_id'))->get();

            foreach ($course as $course) {
                // name only
                $countryArray = [];
                foreach ($course->applications as $application) {
                    if (isset($conAr[$application->nationality])) {
                        continue;
                    }
                    $countryCourse = 0;
                    $totalApp = 0;
                    $totalAppFem = 0;
                    $totalCost = 0;
                    $countryArray[$application->nationality]['name'] = getCountry($application->nationality);
                    $countryArray[$application->nationality]['total_courses'] = $countryCourse;
                    $countryArray[$application->nationality]['total_apps'] = $totalApp;
                    $countryArray[$application->nationality]['total_apps_fem'] = $totalAppFem;
                    $countryArray[$application->nationality]['cost'] = $totalCost;
                    $conAr[$application->nationality] = true;
                }
                foreach ($countryArray as $key => $value) {
                    $array[] = $value;
                }
            }
        } elseif (getRequest('c_id') != null && getRequest('inv') == null) {
            $course = Course::where('id', getRequest('c_id'))->first();
            $countries = unserialize($course->countries);

            // all fileds invited
            $countryArray = [];
            foreach ($countries as $key => $country) {

                $countryCourse = 0;
                $totalApp = Application::where('nationality', $country)->distinct('nationality')->count();
                $totalAppFem = 0;
                $totalCost = 0;
                $countryArray[$key]['name'] = getCountry($country);
                $countryArray[$key]['total_courses'] = Application::where('nationality', $country)->distinct('course_id')->count('course_id');
                $countryArray[$key]['total_apps'] = Application::where('nationality', $country)->distinct('nationality')->count();
                $countryArray[$key]['total_apps_fem'] = Application::where('nationality', $country)->where('gender', 'female')->distinct('nationality')->count();
                $countryArray[$key]['cost'] = $totalApp * $course->cost;
                $conAr[$key] = true;
            }
            foreach ($countryArray as $key => $value) {
                $array[] = $value;
            }
        } else {
            // all fields
            $countries = DB::table('applications')->select('nationality')->distinct('nationality')->get();

            $courseAr = [];
            $countryCourse = 0;
            $totalApp = 0;
            $totalAppFem = 0;
            $totalCost = 0;
            $countryArray = [];
            foreach ($countries as $country) {
                if (isset($conAr[$country->nationality])) {
                    continue;
                }
                $applications = Application::where('nationality', 'Like', '%'.$country->nationality.'%')->get();
                $totalAppFem = Application::where('nationality', 'Like', '%'.$country->nationality.'%')->where('gender', 'female')->count();
                $totalApp = $applications->count();
                $ids = [];
                foreach ($applications as $application) {
                    if (isset($application->course_id)) {
                        $ids[] = $application->course_id;

                        continue;
                    }

                }
                $countryCourse = count(array_unique($ids));
                $totalCost = $application->course ? $application->course->cost * $totalApp : 0;
                $countryArray[$application->nationality]['name'] = getCountry($country->nationality);
                $countryArray[$application->nationality]['total_courses'] = $countryCourse;
                $countryArray[$application->nationality]['total_apps'] = $totalApp;
                $countryArray[$application->nationality]['total_apps_fem'] = $totalAppFem;
                $countryArray[$application->nationality]['cost'] = $totalCost;
                $conAr[$application->nationality] = true;
            }
            foreach ($countryArray as $key => $value) {
                $array[] = $value;
            }
        }

        if (isset($ajaxRequest['inv']) && $ajaxRequest['inv'] != null) {
            return view($this->view.'.countryExcel', [
                'data' => $array,
                'inv' => true,
                'cost' => getRequest('cost'),

            ]);

        }

        return view($this->view.'.countryExcel', [
            'data' => $array,
            'inv' => false,
            'cost' => getRequest('cost'),

        ]);

    }
}
