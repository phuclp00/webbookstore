<?php

namespace App\Providers;

use App\Http\Controllers\Product\CategoryController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\SilderController;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use App\Models\Sanctum\PersonalAccessToken;
use Validator;
use Laravel\Sanctum\Sanctum;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

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
        $list_items_product = (new ShopController)->all_list_view();
        $list_items_categoy = (new CategoryController)->list_category();
        $top_item_category = (new CategoryController)->top_list_category();
        $slide_items = (new SilderController)->slide_homepage();

        date_default_timezone_set('Asia/Ho_Chi_Minh');

        Schema::defaultStringLength(255);
        Paginator::useBootstrap();

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

        //Debug sql 
        DB::listen(function ($sql) {
            Log::info($sql->sql);
            Log::info($sql->bindings);
            Log::info($sql->time);
        });
    }
}
