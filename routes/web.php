<?php

use App\Http\Controllers\Auth\LoginController as AuthLoginController;
use Illuminate\Support\Facades\Config;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SilderController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DBconnect;
use App\Http\Controllers\FileuploadController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\SigninController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\UserController;
use App\Models\CategoryModel;
use App\Models\ProductModel;
use App\Models\PublisherModel;
use App\Models\Show_info_user;
use App\Models\SlideModel;
use App\Models\User;
use App\Models\UserModel;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Events\NotificationEvent;
use App\Events\UserRegisted;
use App\Http\Controllers\CheckoutController;
use App\Models\Notifications;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Notification;
use App\Notifications\UserRegistedNotification;
use App\Http\Controllers\CommentController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



//$prefixAdmin = Config::get('01.url.prefix_admin', 'error');
//Route::get('/', [HomeController::class, 'view'])->name('home_view');
//===================================SLIDER========================================================================//
//===================================SLIDER-HOMEPAGE 



//=========================================================//KHU VUC TESTING =========================================================//


Route::get('/cache', function() {
    dd(auth()->user()->notifications()->get());
});
Route::get('/users-list',[UserController::class,'index']);
Route::get('/change-status-user/{userid}/{status}',[UserController::class,'update_status']);
Route::get('/test', function () {
    $data= UserModel::where('user_id',58)->first();
    //$event= event(new UserRegisted($data));
    //broadcast( new UserRegisted($data))->toOthers();
    //UserRegisted::dispatch($data);
    event(new UserRegisted($data));
    return "test";
});
//=========================================================//KHU VUC TESTING =========================================================//

//===================================LOG-IN ========================================================================//
$controllerName = 'login';
Route::group(['prefix' => $controllerName,'middleware'=>['login']], function () {
    $controller = LoginController::class;
    Route::get('/', [$controller, 'show_login'])->name("show_login");
    Route::post('/sign-in', [$controller, 'Login'])->name("login_signin");
    Route::post('/sign-up', [$controller, 'Register'])->name("login_signup");
    Route::get('/log-out', [$controller, 'log_out'])->name("log_out");
});
//===================================HOME - PAGE ====================================================================//
Route::get('/', [HomeController::class,'home'])->name('home');

//======================================HOME - ABOUT ===================================================//


$controllerName = 'about';
Route::group(['prefix' => $controllerName], function () {
    $controller = HomeController::class;
    Route::get('/', [$controller, 'about_view'])->name("about");
});
//======================================HOME - FAQ ===============================================//

$controllerName = 'faq';
Route::group(['prefix' => $controllerName], function () {
    $controller = HomeController::class;
    Route::get('/', [$controller, 'faq_view'])->name("faq");
});
//======================================HOME - WISHLIST ====================================//

$controllerName = 'wishlist';
Route::group(['prefix' => $controllerName], function () {
    $controller = ProductController::class;
    Route::get('wishlist_add={id}', [$controller, 'add_wishlist'])->name("add_wishlist");
});
//======================================HOME - PRIVACY-POLICY ====================================//

$controllerName = 'privacy-policy';
Route::group(['prefix' => $controllerName], function () {
    $controller = HomeController::class;
    Route::get('/', [$controller, 'policy_view'])->name("privacy-policy_view");
});
//======================================HOME - TERMS CONDIIONS====================================//

$controllerName = 'terms-conditions';
Route::group(['prefix' => $controllerName], function () {
    $controller = HomeController::class;
    Route::get('/', [$controller, 'terms_view'])->name("terms_view");
});
//======================================HOME - ERROR 404====================================//

$controllerName = 'error-404';
Route::group(['prefix' => $controllerName], function () {
    $controller = HomeController::class;
    Route::get('/', [$controller, 'error_view'])->name("error");
});
//======================================HOME - CONTACT====================================//

$controllerName = 'contact';
Route::group(['prefix' => $controllerName], function () {
    $controller = HomeController::class;
    Route::get('/', [$controller, 'contact_view'])->name("contact");
});
//======================================HOME - TEAM ====================================//

$controllerName = 'team';
Route::group(['prefix' => $controllerName], function () {
    $controller = HomeController::class;
    Route::get('/', [$controller, 'team_view'])->name("team");
});
//======================================HOME - TEAM ====================================//

$controllerName = 'wishlist';
Route::group(['prefix' => $controllerName], function () {
    $controller = HomeController::class;
    Route::get('/', [$controller, 'wishlist_view'])->name("wishlist");
});
//======================================HOME - CHECKOUT ====================================//

$controllerName = 'checkout';
Route::group(['prefix' => $controllerName], function () {
    $controller = CheckoutController::class;
    Route::get('/check-out-product', [$controller, 'checkout_view'])->name("checkout");
    Route::get('/check-out-order', [$controller, 'add_order_cart'])->name("add_order_cart");
    Route::get('/check-out-order-detail', [$controller, 'add_order_detail'])->name("add_order_detail");
    Route::get('/check-out-register-address', [$controller, 'register_address'])->name("register_address");
});
//======================================HOME - CART ====================================//

$controllerName = 'cart';
Route::group(['prefix' => $controllerName], function () {
    $controller = ProductController::class;
    Route::get('/add-to-cart/{id}', [$controller, 'add_to_cart'])->name("add_to_cart");
    Route::post('/add-to-cart-special', [$controller, 'add_cart_ajax'])->name("add_to_cart_ajax");
    Route::get('/update-cart', [$controller, 'update_cart'])->name("update_cart");
    Route::get('/show-cart', [$controller, 'cart_view'])->name("cart");
});
//======================================HOME - BLOG ====================================//

$controllerName = 'blog';
Route::group(['prefix' => $controllerName], function () {
    $controller = HomeController::class;
    Route::get('/', [$controller, 'blog'])->name("blog");
});
//======================================HOME - BLOG DETAIL ====================================//

$controllerName = 'blogdetail';
Route::group(['prefix' => $controllerName], function () {
    $controller = HomeController::class;
    Route::get('/', [$controller, 'blogdetail_view'])->name("Blog Detail");
});
//====================================== - PRODUCT ========================================================//

$controllerName = 'product';
Route::group(['prefix' => $controllerName], function () {
    //LAY ID VA CAT_ID SAN PHAM KHI DUOC TRUYEN GIA TRI VAO TRA VE TRANG PRODUCT DETAIL
    Route::get('/book_id={id}', [ProductController::class, 'index'])->name("product");
});
$controllerName = 'my-account';
//====================================== - ACCOUNT PROFILE ========================================================//
Route::group(['prefix' => $controllerName,'middleware'=>['user']], function () {
    $controller = UserController::class;
    Route::POST('/img_change', [$controller, 'update_img'])->name("user.image.update");
    Route::get('/account_view', [$controller, 'account_view'])->name("user.account.view");
    Route::post('/account-update', [$controller, 'account_update'])->name("user.account.update");
});
//====================================== - SHOP ========================================================//

$controllerName = 'shop';
Route::group(['prefix' => $controllerName], function () {
    $controller = CategoryController::class;
    Route::get('/', [HomeController::class, 'shop_view'])->name("shop_view", ["get_cat_items" => $get_cat_items = null]);
    //LAY ID CATEGORY KHI DUOC TRUYEN GIA TRI VAO TRA VE LIST THEO ID CATEGORY
    Route::get('/cat_id={cat_id}', [HomeController::class, 'get_category'])->name("category");
    Route::get('/search_product}', [ProductController::class, 'find_product'])->name("find_product");
});
//====================================== - ACCOUNT ========================================================//
Route::get('/notify', [UserController::class,'get_list_notify']);
Route::get('/notify/{id}',  [UserController::class,'get_id_notify']);

Route::get('/mark-all-read/{user}', function (UserModel $user) {
    $user->unreadNotifications->markAsRead();
    return response(['message'=>'done', 'notifications'=>$user->notifications]);
});
Route::get('/mark-as-read/{userId}/{notifyId}', [UserController::class,'markAsRead']);
//===================================ADMIN ===========================================================================//
Route::group(['prefix' => 'admin'], function () {
    
    //================================ ADMIN AUTH ================================================================//

    Route::get('/', [LoginController::class, 'admin_auth'])->name('admin_author');
    //================================ LOGIN ADMIN================================================================//
    Route::get('/login', [HomeController::class, 'login_view'])->name('admin.login.view');
    Route::get('/logout', [LoginController::class, 'admin_logout'])->name('admin.logout');
    Route::post('/login-admin', [LoginController::class, 'admin_login'])->name('admin.login');
    Route::group(['middleware' => ['admin']], function () {

        //Dash board
  
        Route::get('/dashboard', [HomeController::class, 'dash_view'])->name('admin.dashboard');
        //==========================================Category==============================================================
        Route::get('/category', [HomeController::class, 'category_view'])->name('admin.category');
        //Category add view 
        Route::get('/category-view-add', [HomeController::class, 'category_add_view'])->name('admin.category.add.view');
        //Category add 
        Route::get('/category-add', [CategoryController::class, 'add_category'])->name('admin.category.add');
        //Category edit view
        Route::get('/category-edit-view/{cat_id}', [HomeController::class, 'category_edit_view'])->name('admin.category.edit.view');
        //Category edit 
        Route::get('/category-edit/{cat_id}', [CategoryController::class, 'category_edit'])->name('admin.category.edit');
        //Category delete 
        Route::get('/category-delete/{cat_id}', [CategoryController::class, 'category_delete'])->name('admin.category.delete');

        //==========================================Book list==============================================================
        Route::get('/book-list', [HomeController::class, 'book_list_view'])->name('admin.books');
        //Book add view
        Route::get('/book-add-view', [HomeController::class, 'book_list_add_view'])->name('admin.books.add.view');
        //Book add
        Route::post('/book-add', [ProductController::class, 'book_add'])->name('admin.books.add');
        //Book edit view
        Route::get('/book-edit-view/{book_id}', [HomeController::class, 'book_edit_view'])->name('admin.books.edit.view');
        //Book edit
        Route::post('/book-edit', [ProductController::class, 'book_edit'])->name('admin.books.edit');
        //Book delete 
        Route::get('/book-delete/book_id={book_id}', [ProductController::class, 'book_delete'])->name('admin.books.delete');

        //==========================================Publisher=============================================================
        Route::get('/publisher', [HomeController::class, 'publisher_view'])->name('admin.publisher');
        //Publisher-add view
        Route::get('publisher-add-view', [HomeController::class, 'add_publisher_view'])->name('admin.publisher.add.view');
        //Publisher-add
        Route::post('publisher-add', [PublisherController::class, 'add_publisher'])->name('admin.publisher.add');
        //Publisher-edit view
        Route::get('publisher-edit-view/{pub_id}', [HomeController::class, 'edit_publisher_view'])->name('admin.publisher.edit.view');
        //Publisher edit
        Route::get('publisher-edit/{pub_id}', [PublisherController::class, 'edit_publisher'])->name('admin.publisher.edit');
        //Publisher delete
        Route::get('publisher-delete/{pub_id}', [PublisherController::class, 'delete_publisher'])->name('admin.publisher.delete');


        //================================ MANAGER USER================================================================//
        // User list view
        Route::get('/user-list', [HomeController::class, 'user_list_view'])->name('admin.users');
        // User add view
        Route::get('/add-user', [HomeController::class, 'add_user'])->name('admin.users.view');
        //Register user
        Route::get('/register', [HomeController::class, 'register_view'])->name('admin.register.view');
        Route::get('/register-admin', [LoginController::class, 'admin_register'])->name('admin.register');
        //Delete user 
        Route::get('/delete-user-{user_name}',[UserController::class,'delete_user'])->name('admin.users.delete');
        //User search 
        Route::get('/user_search',[UserController::class,'search_user'])->name('admin_search_user');
    });
    //================================ SLIDER ====================================================================//
});


//================================ UPLOAD_ FILE ========================================================//
Route::post('fileupload', [FileuploadController::class, 'store'])->name('fileupload.store');
//================================ AJAX - POST REQUEST =================================================//
Route::post('item', function ($request) {
});
