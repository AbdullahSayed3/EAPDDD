<?php

use App\Http\Controllers\API\AchievementController;
use App\Http\Controllers\API\AidController;
use App\Http\Controllers\API\Auth\AuthController;
use App\Http\Controllers\API\BlogController;
use App\Http\Controllers\API\ContactController;
use App\Http\Controllers\API\CourseController;
use App\Http\Controllers\API\CoursesController;
use App\Http\Controllers\API\FaqController;
use App\Http\Controllers\API\MainController;
use App\Http\Controllers\API\PartnerController;
use App\Http\Controllers\API\ScholarShipController;
use App\Http\Controllers\API\TeamController;
use App\Http\Controllers\Web\JobController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::get('courses/count',[CoursesController::class,'countAll']);
Route::get('applicants/eg/count',[CoursesController::class,'coursesTraniEgypt']);
Route::get('partners', [PartnerController::class, 'index']);
Route::get('statistics/count', [MainController::class, 'getCount']);
Route::get('faqs', [FaqController::class, 'index']);
Route::get('blogs', [BlogController::class, 'index']);
Route::get('blogs/latest', [BlogController::class, 'latestNew']);
Route::get('blogs/latest_five', [BlogController::class, 'latestfiveNews']);

Route::get('blogs/{id}', [BlogController::class, 'show']);
Route::get('team', [TeamController::class, 'index']);
Route::get('jobs', [JobController::class, 'getData']);
Route::get('jobs/{id}', [JobController::class, 'getJobById']);
Route::get('job_types', [JobController::class, 'getJobTypes']);

Route::get('achievements', [AchievementController::class, 'index']);
Route::get('achievement_type', [AchievementController::class, 'getAcievementTypes']);
Route::get('achievements/{id}', [AchievementController::class, 'show']);
Route::post('contact_us',[ContactController::class,'store']);
Route::get('courses', [CourseController::class, 'index']);
Route::get('courses/{id}', [CourseController::class, 'show']);
Route::get('countries', [AidController::class, 'getCountry']);
Route::get('aid_types', [AidController::class, 'getTypes']);
Route::get('aids', [AidController::class, 'index']);
Route::get('aids/{id}', [AidController::class, 'show']);


Route::get('assistance', [ScholarShipController::class, 'index']);
Route::get('assistance/{id}', [ScholarShipController::class, 'show']);

Route::get('achivement_count_by_type', [AchievementController::class, 'getAchievementCountrByType']);
Route::get('achivement_count_by_country', [AchievementController::class, 'getCountOfAchievementsByCountry']);

Route::post('login',[AuthController::class,'login']);
Route::middleware('auth:sanctum')->group(function () {
        Route::delete('/logout', [AuthController::class, 'logout']);
 });