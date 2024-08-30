<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use App\Http\Controllers\UserController;
class RouteMacroServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Route::macro('softDeletes', function ($prefix, $controller) {
            Route::get('/trashed', [UserController::class, 'trasheds'])->name('users.trashed');
            Route::patch("{$prefix}/{user}/restore", [$controller, 'restore'])->name("{$prefix}.restore");
            Route::delete("{$prefix}/{user}/delete", [$controller, 'delete'])->name("{$prefix}.delete");
        });
    }
}
