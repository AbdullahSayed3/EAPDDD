<?php

use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\AidsController;
use App\Http\Controllers\ApplicantsController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\AssessmentsController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\coursesPartnersController;
use App\Http\Controllers\CravanController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\ExpertsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LearnersController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\ScholarshipsController;
use App\Http\Controllers\Settings;
use App\Http\Controllers\TerialTeralController;
use App\Http\Controllers\Web\AchievementController;
use App\Http\Controllers\Web\AchievementTypeController;
use App\Http\Controllers\Web\BlogController;
use App\Http\Controllers\Web\ContactController;
use App\Http\Controllers\Web\FaqController;
use App\Http\Controllers\Web\JobController;
use App\Http\Controllers\Web\JobTypeController;
use App\Http\Controllers\Web\PartnerController;
use App\Http\Controllers\Web\TeamController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Route::get('/updateCountry', 'ApplicantsController@updateCountry');
// Route::get('/updateEmail', 'ApplicantsController@updateEmail');
//
Route::redirect('/', '/home');
// Route::get('/updatephones', 'ApplicantsController@updatePhone');

Auth::routes();
// Route::redirect('/register', '/home');
Route::middleware(['lang'])->group(function () {

    // Route::get('/lang/{id}', [ApplicationController::class, 'changeLang'])->name('change_lang');
    Route::get('/lang/{locale}', function ($locale) {
        // Set the session with the selected language
        session(['lang' => $locale]);
        return redirect()->back();
    })->name('change_lang');

    Route::middleware(['auth'])->group(function () {
        //        Route::get('/home', 'HomeController@index')->name('home');
        Route::redirect('/home', '/courses')->name('home');
        Route::get('/settings', [HomeController::class, 'settings'])->name('settings');
        Route::get('/profile/settings', [HomeController::class, 'settings'])->name('settings.index');
        Route::post('/settings', [HomeController::class, 'SaveSettings'])->name('Savesettings');

        // /Reports

        Route::get('reports', [ReportsController::class, 'index'])->name('reports.index');
        Route::get('reports/comprehensive', [ReportsController::class, 'comprehensive'])->name('reports.comprehensive');
        Route::get('reports/comprehensive/data/{type}', [ReportsController::class, 'getComprehensiveData'])->name('reports.comprehensive.data');
        Route::get('reports/{id}', [ReportsController::class, 'RenderReport'])->name('reports.render');

        Route::middleware('permission:show_events')->group(function () {
            //
            // For System Channels
            Route::post('events/action', [EventsController::class, 'delete'])->name('events.delete');
            Route::resource('events', EventsController::class)->except(['destroy']);
            Route::get('events/ajax/datatable', [EventsController::class, 'datatable'])->name('events.datatable');
        });

        Route::middleware('permission:show_scholarships')->group(function () {
            //
            // For System Channels
            Route::post('scholarships/action', [ScholarshipsController::class, 'delete'])->name('scholarships.delete');
            Route::resource('scholarships', ScholarshipsController::class)->except(['destroy']);
            Route::get('scholarships/ajax/datatable', [ScholarshipsController::class, 'datatable'])->name('scholarships.datatable');
        });

        Route::middleware('permission:show_learners')->group(function () {
            //
            // For System Channels
            Route::post('learners/action', [LearnersController::class, 'delete'])->name('learners.delete');
            Route::resource('learners', LearnersController::class)->except(['destroy']);
            Route::get('learners/ajax/datatable', [LearnersController::class, 'datatable'])->name('learners.datatable');
        });

        Route::middleware('permission:show_experts')->group(function () {

            // For System Channels
            Route::post('experts/action', [ExpertsController::class, 'delete'])->name('experts.delete');
            Route::resource('experts', ExpertsController::class)->except(['destroy']);
            Route::get('experts/ajax/datatable', [ExpertsController::class, 'datatable'])->name('experts.datatable');
            Route::post('experts/import', [ExpertsController::class, 'import'])->name('experts.import');
        });

        Route::middleware('permission:show_aids')->group(function () {

            // For System Channels
            Route::post('aids/action', [AidsController::class, 'delete'])->name('aids.delete');
            Route::resource('aids', AidsController::class)->except(['destroy']);
            Route::get('aids/ajax/datatable', [AidsController::class, 'datatable'])->name('aids.datatable');

            Route::post('cravans/action', [CravanController::class, 'delete'])->name('cravans.delete');
            Route::resource('cravans', CravanController::class)->except(['destroy']);
            Route::get('cravans/ajax/datatable', [CravanController::class, 'datatable'])->name('cravans.datatable');
        });
        Route::middleware('permission:show_teral_terials')->group(function () {

            Route::post('TrialTeral/action', [TerialTeralController::class, 'delete'])->name('TrialTeral.delete');
            Route::resource('TrialTeral', TerialTeralController::class)->except(['destroy']);
            Route::get('TrialTeral/ajax/datatable', [TerialTeralController::class, 'datatable'])->name('TrialTeral.datatable');
        });

        Route::middleware([])->group(function () {
            // 'permission:show_courses'
            // For System Channels
            Route::get('courses/countries', [CoursesController::class, 'Countries'])->name('courses.countries')->middleware('permission:show_countries');
            Route::get('courses/coursesDatatable', [CoursesController::class, 'CountriesAjax'])->name('courses.coursesDatatable');
            Route::post('courses/countriesAction', [CoursesController::class, 'CountriesAction'])->name('courses.countriesAction');

            //            Route::get('courses/inv-countries', 'CoursesController@Countries')->name('courses.countries');
            //            Route::get('courses/inv-coursesDatatable', 'CoursesController@CountriesAjax')->name('courses.coursesDatatable');
            //            Route::post('courses/inv-countriesAction', 'CoursesController@CountriesAction')->name('courses.countriesAction');

            Route::get('courses/countries', [CoursesController::class, 'Countries'])->name('courses.countries');
            Route::get('courses/coursesDatatable', [CoursesController::class, 'CountriesAjax'])->name('courses.coursesDatatable');
            Route::post('courses/countriesAction', [CoursesController::class, 'CountriesAction'])->name('courses.countriesAction');

            //
            //            course_countries
            // course_inv_countries

            Route::post('courses/action', [CoursesController::class, 'delete'])->name('courses.delete');
            Route::resource('courses', CoursesController::class)->except(['destroy']);
            Route::get('courses/ajax/datatable/', [CoursesController::class, 'datatable'])->name('courses.datatable');

            // For System Channels
            Route::post('coursesPartners/action', [coursesPartnersController::class, 'delete'])->name('coursesPartners.delete');
            Route::resource('coursesPartners', coursesPartnersController::class)->except(['destroy']);
            Route::get('coursesPartners/ajax/datatable', [coursesPartnersController::class, 'datatable'])->name('coursesPartners.datatable');

            Route::post('assessments/delete', [AssessmentsController::class, 'delete'])->name('assessments.delete');
            Route::post('assessments/import', [AssessmentsController::class, 'import'])->name('assessments.import');
            Route::resource('assessments', AssessmentsController::class)
                ->except(['edit', 'destroy']);
            Route::get('assessments/ajax/datatable', [AssessmentsController::class, 'datatable'])->name('assessments.datatable');
        });
        Route::middleware('permission:show_applicants')->group(function () {

            Route::post('applicants/action', [ApplicantsController::class, 'delete'])->name('applicants.delete');
            Route::post('applicants/importData', [ApplicantsController::class, 'import'])->name('applicant.import');
            Route::resource('applicants', ApplicantsController::class)->except(['destroy']);
            Route::get('applicants/ajax/datatable', [ApplicantsController::class, 'datatable'])->name('applicants.datatable');
            // Route::post('applicants/import', [ApplicantsController::class, 'importExcel'])->name('applicants.import');
        });

        Route::middleware('permission:show_settings')->group(function () {

            // For System Settings
            Route::get('event_types/delete/{id}', [Settings\EventsController::class, 'delete'])->name('event_types.delete');
            Route::resource('event_types', Settings\EventsController::class)->except(['edit', 'destroy']);
            Route::get('event_types/ajax/datatable', [Settings\EventsController::class, 'datatable'])->name('event_types.datatable');

            // For System Settings
            Route::get('aids_types/delete/{id}', [Settings\AidsTypeController::class, 'delete'])->name('aids_types.delete');
            Route::resource('aids_types', Settings\AidsTypeController::class)->except(['edit', 'destroy']);
            Route::get('aids_types/ajax/datatable', [Settings\AidsTypeController::class, 'datatable'])->name('aids_types.datatable');

            // For System Settings
            Route::get('aids_suppliers/delete/{id}', [Settings\AidsSuppController::class, 'delete'])->name('aids_suppliers.delete');
            Route::resource('aids_suppliers', Settings\AidsSuppController::class)->except(['edit', 'destroy']);
            Route::get('aids_suppliers/ajax/datatable', [Settings\AidsSuppController::class, 'datatable'])->name('aids_suppliers.datatable');

            // For System Settings
            Route::get('trial_terals_fields/delete/{id}', [Settings\TrialTeralFieldController::class, 'delete'])->name('trial_terals_fields.delete');
            Route::resource('trial_terals_fields', Settings\TrialTeralFieldController::class)->except(['edit', 'destroy']);
            Route::get('trial_terals_fields/ajax/datatable', [Settings\TrialTeralFieldController::class, 'datatable'])->name('trial_terals_fields.datatable');

            // For System Settings
            Route::get('course_types/delete/{id}', [Settings\CourseTypeController::class, 'delete'])->name('course_types.delete');
            Route::resource('course_types', Settings\CourseTypeController::class)->except(['edit', 'destroy']);
            Route::get('course_types/ajax/datatable', [Settings\CourseTypeController::class, 'datatable'])->name('course_types.datatable');

            // For System Settings
            Route::get('course_naturals/delete/{id}', [Settings\CourseNaturalController::class, 'delete'])->name('course_naturals.delete');
            Route::resource('course_naturals', Settings\CourseNaturalController::class)->except(['edit', 'destroy']);
            Route::get('course_naturals/ajax/datatable', [Settings\CourseNaturalController::class, 'datatable'])->name('course_naturals.datatable');

            // For System Settings
            Route::get('course_fields/delete/{id}', [Settings\CourseFieldController::class, 'delete'])->name('course_fields.delete');
            Route::resource('course_fields', Settings\CourseFieldController::class)->except(['edit', 'destroy']);
            Route::get('course_fields/ajax/datatable', [Settings\CourseFieldController::class, 'datatable'])->name('course_fields.datatable');

            // For System Settings
            Route::get('course_trainees/delete/{id}', [Settings\CourseTraineeController::class, 'delete'])->name('course_trainees.delete');
            Route::resource('course_trainees', Settings\CourseTraineeController::class)->except(['edit', 'destroy']);
            Route::get('course_trainees/ajax/datatable', [Settings\CourseTraineeController::class, 'datatable'])->name('course_trainees.datatable');

            // For System Settings
            Route::get('roles/delete/{id}', [Settings\RolesController::class, 'delete'])->name('roles.delete');
            Route::resource('roles', Settings\RolesController::class)->except(['edit', 'destroy']);
            Route::get('roles/ajax/datatable', [Settings\RolesController::class, 'datatable'])->name('roles.datatable');

            // For System Settings
            Route::get('users/delete/{id}', [Settings\UsersController::class, 'delete'])->name('users.delete');
            Route::resource('users', Settings\UsersController::class)->except(['destroy']);
            Route::get('users/ajax/datatable', [Settings\UsersController::class, 'datatable'])->name('users.datatable');



            // Activty Logs
            Route::resource('activity_logs', ActivityLogController::class)->except(['destroy']);
            Route::get('activity_logs/ajax/datatable', [ActivityLogController::class, 'datatable'])->name('activity_logs.datatable');
            Route::get('activity_logs/changes/{id}', [ActivityLogController::class, 'show'])->name('activity_logs.show');

            Route::resource('partners', PartnerController::class);
            Route::get('partners/ajax/datatable', [PartnerController::class, 'datatable'])->name('partners.datatable');
            Route::get('partners/delete/{id}', [PartnerController::class, 'delete'])->name('partners.delete');

            Route::resource('faqs', FaqController::class);
            Route::get('faqs/ajax/datatable', [FaqController::class, 'datatable'])->name('faqs.datatable');
            Route::get('faqs/delete/{id}', [FaqController::class, 'delete'])->name('faqs.delete');


            Route::resource('blogs', BlogController::class);
            Route::get('blogs/ajax/datatable', [BlogController::class, 'datatable'])->name('blogs.datatable');
            Route::get('blogs/delete/{id}', [BlogController::class, 'delete'])->name('blogs.delete');


            Route::resource('teams', TeamController::class);
            Route::get('teams/ajax/datatable', [TeamController::class, 'datatable'])->name('teams.datatable');
            Route::get('teams/delete/{id}', [TeamController::class, 'delete'])->name('teams.delete');


            Route::resource('jobs', JobController::class);
            Route::get('jobs/ajax/datatable', [JobController::class, 'datatable'])->name('jobs.datatable');
            Route::get('jobs/delete/{id}', [JobController::class, 'delete'])->name('jobs.delete');


            Route::resource('job_types', JobTypeController::class);
            Route::get('job_types/ajax/datatable', [JobTypeController::class, 'datatable'])->name('job_types.datatable');
            Route::get('job_types/delete/{id}', [JobTypeController::class, 'delete'])->name('job_types.delete');


            Route::resource('achievement_type', AchievementTypeController::class);
            Route::get('achievement_type/ajax/datatable', [AchievementTypeController::class, 'datatable'])->name('achievement_type.datatable');
            Route::get('achievement_type/delete/{id}', [AchievementTypeController::class, 'delete'])->name('achievement_type.delete');


            Route::resource('achievements', AchievementController::class);
            Route::get('achievements/ajax/datatable', [AchievementController::class, 'datatable'])->name('achievements.datatable');
            Route::get('achievements/delete/{id}', [AchievementController::class, 'delete'])->name('achievements.delete');

            Route::resource('contact_us', ContactController::class);
            Route::get('contact_us/ajax/datatable', [ContactController::class, 'datatable'])->name('contact_us.datatable');
            Route::get('contact_us/delete/{id}', [ContactController::class, 'delete'])->name('contact_us.delete');

            Route::get('print_qrcode/{id}', [CoursesController::class, 'printQrCode'])->name('print_qrcode');

            Route::get('/generate-qrcode', function () {
                $qrCode = QrCode::size(300)
                    ->color(255, 0, 0)
                    ->generate('https://dev-fe-eapd.atwdemo.com/');
                return response($qrCode)->header('Content-Type', 'image/svg+xml');
            });
            // Route::get('teams/ajax/datatable', [ContactController::class, 'datatable'])->name('contact_us.datatable');
            //        // For System Settings
            //    Route::get('permissions/delete/{id}', 'permissionsController@delete')->name('permissions.delete');
            //    Route::resource('permissions', 'permissionsController')->except(['edit', 'destroy']);
            //    Route::get('permissions/ajax/datatable', 'permissionsController@datatable')->name('permissions.datatable');
            //

            Route::resource('places', PlaceController::class);
            Route::get('places/ajax/datatable', [PlaceController::class, 'datatable'])->name('places.datatable');
            Route::get('places/delete/{id}', [PlaceController::class, 'delete'])->name('places.delete');

            Route::resource('countries', CountryController::class);
            Route::get('countries/ajax/datatable', [CountryController::class, 'datatable'])->name('countries.datatable');
            Route::get('countries/delete/{id}', [CountryController::class, 'delete'])->name('countries.delete');
            Route::post('countries/action', [CountryController::class, 'countryAction'])->name('countries.action');
        });
    });
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
