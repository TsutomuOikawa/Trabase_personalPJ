<?php

namespace App\Providers;

use App\Models\Prefecture;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class PrefecturesSettingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            $view->with('prefectures', Prefecture::get(['id', 'name'])->toArray());
        });
    }
}
