<?php

namespace App\Providers;

use App\Http\Middleware\Lang;
use App\Models\Aid;
use App\Models\Application;
use App\Models\Assessment;
use App\Models\Course;
use App\Models\Events;
use App\Models\Expert;
use App\Models\Learners;
use App\Models\Scholarships;
use App\Models\Supplier;
use App\Models\TrialTeral;
use App\Models\User;
use App\Observers\AidObserver;
use App\Observers\ApplicationObserver;
use App\Observers\AssessmentObserver;
use App\Observers\CourseObserver;
use App\Observers\EventObserver;
use App\Observers\ExpertObserver;
use App\Observers\LearnersObserver;
use App\Observers\ScholarshipsObserver;
use App\Observers\SupplierObserver;
use App\Observers\TrialTeralObserver;
use App\Observers\UserObserver;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Bootstrap any application services.
     */

    public function boot(Kernel $kernel): void
    {
        // Schema::defaultStringLength(191);
        $kernel->appendMiddlewareToGroup('web', Lang::class);

        $this->bootRoute();
        Course::observe(CourseObserver::class);
        Aid::observe(AidObserver::class);
        Application::observe(ApplicationObserver::class);
        Assessment::observe(AssessmentObserver::class);
        Events::observe(EventObserver::class);
        Expert::observe(ExpertObserver::class);
        Learners::observe(LearnersObserver::class);
        Scholarships::observe(ScholarshipsObserver::class);
        Supplier::observe(SupplierObserver::class);
        TrialTeral::observe(TrialTeralObserver::class);
        User::observe(UserObserver::class);
    }

    /**
     * Register any application services.
     */
    public function register(): void
    {

        require app_path('Http/HelperTwo.php');
        // $this->app->singleton(HelperTwo::class, function () {
        //     return new HelperTwo();
        // });
    }

    public function bootRoute(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user() ? request()->user()->id : $request->ip());
        });
    }
}
