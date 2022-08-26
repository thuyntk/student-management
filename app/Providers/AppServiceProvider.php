<?php

namespace App\Providers;

use App\Repositories\Faculties\FacultyRepository;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            \App\Repositories\Faculties\FacultyRepositoryInterface::class,
            \App\Repositories\Faculties\FacultyRepository::class,
            \App\Repositories\Subjects\SubjectRepositoryInterface::class,
            \App\Repositories\Subjects\SubjectRepository::class,
            \App\Repositories\Students\StudentRepositoryTnterface::class,
            \App\Repositories\Students\StudentRepository::class,
            \App\Repositories\Users\UserRepository::class,
            \App\Repositories\Users\UserRepositoryInterface::class,
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
    }
}
