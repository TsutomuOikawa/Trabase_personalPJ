<?php

namespace App\Providers;

// use App\Modules\ImageUpload\CloudinaryImageManager;
// use App\Modules\ImageUpload\ImageManagerInterface;
// use App\Modules\ImageUpload\LocalImageManager;
use Cloudinary\Cloudinary;
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
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
      Paginator::defaultView('vendor.pagination.custom');
    }
}
