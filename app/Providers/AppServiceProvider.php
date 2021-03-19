<?php

namespace App\Providers;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\SilderController;
use App\Models\Show_info_user;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session as FacadesSession;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\URL;

use Request;
use Session;
use Cart;
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
        /*
        
        $db_book = DB::table('book')->select('*')->get();
        $users = DB::table('book')->paginate(10);
        $list_book=json_decode($db_book,true);
        view()->share('list_book', $list_book);
        */
        $list_items_product = (new ShopController)->all_list_view();
        $list_items_categoy = (new CategoryController)->list_category();
        $top_item_category = (new CategoryController)->top_list_category();
        $slide_items = (new SilderController)->slide_homepage();
       
        date_default_timezone_set('Asia/Ho_Chi_Minh');   
 
        Schema::defaultStringLength(255);
        Paginator::useBootstrap();

    }
}
