<?php

namespace App\Providers;

use App\Repositories\Faculty\FacultiesRepository;
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
            \App\Repositories\Faculty\FacultiesRepositoryInterface::class,
            \App\Repositories\Faculty\FacultiesRepository::class,
            \App\Repositories\Subjects\SubjectsRepositoryInterface::class,
            \App\Repositories\Subjects\SubjectsRepository::class,
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
