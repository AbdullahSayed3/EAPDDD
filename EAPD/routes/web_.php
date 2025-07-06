<?php

use App\Http\Controllers\AidsController;
use App\Http\Controllers\ApplicantsController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\AssessmentsController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\coursesPartnersController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\ExpertsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\ScholarshipsController;
use App\Http\Controllers\Settings;
use App\Http\Controllers\TerialTeralController;
use Illuminate\Support\Facades\Route;

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

Route::redirect('/', '/home');
Route::get('/updatephones', [ApplicantsController::class, 'updatePhone']);

Auth::routes();
// Route::redirect('/register', '/home');
Route::middleware('lang')->group(function () {
    Route::get('/lang/{code}', [ApplicationController::class, 'changeLang'])->name('change_lang');

    Route::middleware('auth')->group(function () {
        //        Route::get('/home', 'HomeController@index')->name('home');
        Route::redirect('/home', '/courses')->name('home');
        Route::get('/settings', [HomeController::class, 'settings'])->name('settings');
        Route::get('/profile/settings', [HomeController::class, 'settings'])->name('settings.index');
        Route::post('/settings', [HomeController::class, 'SaveSettings'])->name('Savesettings');

        // /Reports

        Route::get('reports', [ReportsController::class, 'index'])->name('reports.index');
        Route::get('reports/{id}', [ReportsController::class, 'RenderReport'])->name('reports.render');

        Route::middleware('permission:manage_events')->group(function () {
            //
            // For System Channels
            Route::post('events/action', [EventsController::class, 'delete'])->name('events.delete');
            Route::resource('events', EventsController::class)->except(['destroy']);
            Route::get('events/ajax/datatable', [EventsController::class, 'datatable'])->name('events.datatable');
        });

        Route::middleware('permission:manage_scholarships')->group(function () {
            //
            // For System Channels
            Route::post('scholarships/action', [ScholarshipsController::class, 'delete'])->name('scholarships.delete');
            Route::resource('scholarships', ScholarshipsController::class)->except(['destroy']);
            Route::get('scholarships/ajax/datatable', [ScholarshipsController::class, 'datatable'])->name('scholarships.datatable');
        });

        Route::middleware('permission:manage_experts')->group(function () {

            // For System Channels
            Route::post('experts/action', [ExpertsController::class, 'delete'])->name('experts.delete');
            Route::resource('experts', ExpertsController::class)->except(['destroy']);
            Route::get('experts/ajax/datatable', [ExpertsController::class, 'datatable'])->name('experts.datatable');

        });

        Route::middleware('permission:manage_aids')->group(function () {

            // For System Channels
            Route::post('aids/action', [AidsController::class, 'delete'])->name('aids.delete');
            Route::resource('aids', AidsController::class)->except(['destroy']);
            Route::get('aids/ajax/datatable', [AidsController::class, 'datatable'])->name('aids.datatable');

        });
        Route::middleware('permission:manage_teral_terials')->group(function () {

            Route::post('TrialTeral/action', [TerialTeralController::class, 'delete'])->name('TrialTeral.delete');
            Route::resource('TrialTeral', TerialTeralController::class)->except(['destroy']);
            Route::get('TrialTeral/ajax/datatable', [TerialTeralController::class, 'datatable'])->name('TrialTeral.datatable');

        });

        Route::middleware('permission:manage_courses')->group(function () {

            // For System Channels
            Route::get('courses/countries', [CoursesController::class, 'Countries'])->name('courses.countries');
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
            Route::get('courses/ajax/datatable', [CoursesController::class, 'datatable'])->name('courses.datatable');

            // For System Channels
            Route::post('coursesPartners/action', [coursesPartnersController::class, 'delete'])->name('coursesPartners.delete');
            Route::resource('coursesPartners', coursesPartnersController::class)->except(['destroy']);
            Route::get('coursesPartners/ajax/datatable', [coursesPartnersController::class, 'datatable'])->name('coursesPartners.datatable');

            Route::post('assessments/delete', [AssessmentsController::class, 'delete'])->name('assessments.delete');
            Route::post('assessments/import', [AssessmentsController::class, 'import'])->name('assessments.import');
            Route::resource('assessments', AssessmentsController::class)->except(['edit', 'destroy']);
            Route::get('assessments/ajax/datatable', [AssessmentsController::class, 'datatable'])->name('assessments.datatable');

        });
        Route::middleware('permission:manage_applicants')->group(function () {

            Route::post('applicants/action', [ApplicantsController::class, 'delete'])->name('applicants.delete');
            Route::post('applicants/importData', [ApplicantsController::class, 'import'])->name('applicant.import');
            Route::resource('applicants', ApplicantsController::class)->except(['destroy']);
            Route::get('applicants/ajax/datatable', [ApplicantsController::class, 'datatable'])->name('applicants.datatable');

        });

        Route::middleware('permission:manage_settings')->group(function () {

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

            //        // For System Settings
            //        Route::get('permissions/delete/{id}', 'permissionsController@delete')->name('permissions.delete');
            //        Route::resource('permissions', 'permissionsController')->except(['edit', 'destroy']);
            //        Route::get('permissions/ajax/datatable', 'permissionsController@datatable')->name('permissions.datatable');
            //

        });

    });

});
