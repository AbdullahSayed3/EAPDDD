<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;

class ExportCourse implements FromView
{
    use Exportable;

    private $ids;
    private $view;

    public function __construct(array $ids, $view)
    {
        $this->ids = $ids;
        $this->view = $view;
    }

    public function view(): View
    {
        // Use Query Builder with JOINs to get related data
        $query = DB::table('courses')
            ->leftJoin('course_fields', 'courses.field_id', '=', 'course_fields.id')
            ->leftJoin('course_naturals', 'courses.natural_id', '=', 'course_naturals.id')
            ->leftJoin('course_organizations', 'courses.organization_id', '=', 'course_organizations.id')
            ->leftJoin('course_types', 'courses.type_id', '=', 'course_types.id')
            ->select([
                'courses.id',
                'courses.name_ar',
                'courses.name_en',
                'courses.name_fr',
                'courses.type_id',
                'course_types.name_ar as type_name', // Get type name
                'courses.natural_id',
                'course_naturals.name_ar as natural_name', // Get natural name
                'courses.field_id',
                'course_fields.name_ar as field_name', // Get field name
                'courses.content',
                'courses.content_en',
                'courses.content_fr',
                'courses.start_date',
                'courses.end_date',
                'courses.location',
                'courses.organization_id',
                'course_organizations.name_ar as organization_name', // Get organization name
                'courses.image',
                'courses.images',
                'courses.documents',
                'courses.countries',
                'courses.trainees',
                'courses.cost',
                'courses.notes',
                'courses.is_active',
                'courses.benefit_ar',
                'courses.requirement_ar',
                'courses.benefit_en',
                'courses.requirement_en',
                'courses.benefit_fr',
                'courses.requirement_fr',
                'courses.created_at',
                'courses.updated_at'
            ])
            ->orderBy('courses.start_date', 'asc');

        if (count($this->ids) > 0) {
            $query->whereIn('courses.id', $this->ids);
        }

        // Get the courses data
        $courses = $query->get();

        // Get additional data that requires separate queries
        $processedData = $courses->map(function ($course) {
            // Get trainee coordinator name
            $traineeCoordinator = 'N/A';
            if (!empty($course->trainees)) {
                $trainees = @unserialize($course->trainees) ?: [];
                if (!empty($trainees) && is_array($trainees)) {
                    $trainee = DB::table('course_trianees')
                        ->where('id', $trainees[0])
                        ->first();
                    if ($trainee) {
                        $traineeCoordinator = $trainee->name_ar;
                    }
                }
            }

            // Get countries list
            $countriesList = '';
            if (!empty($course->countries)) {
                $countries = @unserialize($course->countries) ?: [];
                if (!empty($countries) && is_array($countries)) {
                    $countryNames = [];
                    foreach ($countries as $countryId) {
                        $countryName = getCountry($countryId);
                        if ($countryName) {
                            $countryNames[] = $countryName;
                        }
                    }
                    $countriesList = implode(' - ', $countryNames);
                }
            }

            // Get applications count
            $totalApplications = DB::table('applications')
                ->where('course_id', $course->id)
                ->where('wait_list', 'false')
                ->count();

            $femaleApplications = DB::table('applications')
                ->where('course_id', $course->id)
                ->where('wait_list', 'false')
                ->where('gender', 'female')
                ->count();

            // Add processed data to course object
            $course->trainee_coordinator = $traineeCoordinator;
            $course->countries_list = $countriesList;
            $course->total_applications = $totalApplications;
            $course->female_applications = $femaleApplications;
            $course->total_cost = $totalApplications * ($course->cost ?? 0);

            return $course;
        });

        return view($this->view . '.excel', [
            'data' => $processedData,
        ]);
    }

    public function chunkSize(): int
    {
        return 500; // Process 500 records at a time
    }
}
