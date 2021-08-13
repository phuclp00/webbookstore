<?php

namespace App\Providers;

use App\Http\Controllers\Product\CategoryController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\SilderController;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\Sanctum;

class AppServiceProvider extends ServiceProvider
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
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        Schema::defaultStringLength(255);
        Paginator::useBootstrap();

        (new ShopController)->all_list_view();
        (new CategoryController)->list_category();
        (new CategoryController)->top_list_category();
        (new SilderController)->slide_homepage();
        Validator::extend('date_multi_format', function ($attribute, $value, $formats) {
            // iterate through all formats
            foreach ($formats as $format) {

                // parse date with current format
                $parsed = date_parse_from_format($format, $value);

                // if value matches given format return true=validation succeeded 
                if ($parsed['error_count'] === 0 && $parsed['warning_count'] === 0) {
                    return true;
                }
            }
            // value did not match any of the provided formats, so return false=validation failed
            return false;
        });
    }
}
