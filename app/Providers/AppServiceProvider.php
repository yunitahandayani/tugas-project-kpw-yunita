<?php

namespace App\Providers;

use App\Models\Genre;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // template memakai Bootstrap 3
        Paginator::useBootstrapThree();

        // daftar genre untuk menu navigasi
        View::composer('templates.component.navbar', function ($view) {
            $view->with('genres', Schema::hasTable('genres') ? Genre::orderBy('id')->get() : collect());
        });
    }
}
