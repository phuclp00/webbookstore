<?php

use App\Events\Order\OrderComplete;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Product\CategoryController;
use App\Http\Controllers\Store\FileuploadController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Product\PublisherController;
use App\Http\Controllers\Auth\UserController;
use App\Models\UserModel;
use Illuminate\Support\Facades\Route;
use App\Events\User\UserRegisted;
use App\Http\Controllers\Order\OrderController;
use App\Http\Controllers\Order\PaypalController;
use App\Http\Controllers\Product\AuthorController;
use App\Http\Controllers\Product\BooksFormatController;
use App\Http\Controllers\Product\BooksTypeController;
use App\Http\Controllers\Product\PromotionsController;
use App\Http\Controllers\Product\SeriesController;
use App\Http\Controllers\Product\SupplierController;
use App\Http\Controllers\Product\TagsController;
use App\Http\Controllers\Product\TranslatorController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\Store\GoogleDriverController;
use App\Http\Controllers\Store\S3Controller;
use App\Http\Controllers\TestController;
use App\Http\Controllers\VoucherController;
use App\Http\Resources\User;
use App\Models\CategoryModel;
use App\Models\Guest;
use App\Models\Membership;
use App\Models\Order;
use App\Models\ProductModel;
use App\Models\Shipping;
use App\Models\UserAddress;
use BeyondCode\Vouchers\Facades\Vouchers;
use BeyondCode\Vouchers\Models\Voucher;
use BeyondCode\Vouchers\Rules\Voucher as RulesVoucher;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Request;
use  Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Vanthao03596\HCVN\Models\District;
use Vanthao03596\HCVN\Models\Ward;

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

//=========================================================//KHU VUC TESTING =========================================================//
Route::get('/view', function () {
    return view('file');
});
Route::get('/auth/{provider}', 'Auth\SocialAuthController@redirectToProvider');
Route::get('/auth/{provide}/callback', 'Auth\SocialAuthController@handleProviderCallback');

Route::post('/file', [FileuploadController::class, 'store'])->name('file');
Route::get('/users-list', [UserController::class, 'index']);
Route::get('/change-status-user/{userid}/{status}', [UserController::class, 'update_status']);
Route::get('/test', [TestController::class, 'text']);
Route::get('/create_voucher', function () {
    $data = CategoryModel::find(84);
    Vouchers::create($data, 1, [
        'from' => 'Booksto',
        'to' => 'All member prime',
        'percent' => '90',
        'type' => 'category'
    ], today()->addHours(24), 10);
});
//=========================================================//KHU VUC TESTING =========================================================//
Route::prefix('/')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('index');
});
Route::get('/redirect/{social}', 'Auth\SocialAuthController@redirect');
Route::get('/callback/{social}', 'Auth\SocialAuthController@callback');
//===================================HOME - PAGE ====================================================================//
Route::get('/home', [HomeController::class, 'index'])->name('home');
//======================================HOME - Check ===================================================//

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
Route::prefix('contact')->group(function () {
    Route::get('/', [HomeController::class, 'contact'])->name('contact');
    Route::post('email', [UserController::class, 'send_email']);
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
//======================================HOME - Request ====================================//

Route::prefix('request')->group(function () {
    Route::post('/orders', [OrderController::class, 'request_cancel']);
});
//======================================HOME - ORDER ====================================//

Route::get('/order-summary/order={order_id}', [OrderController::class, 'summary'])->name('check');
Route::post('paypal/store_order', [PaypalController::class, 'store_order']);
Route::post('order', [OrderController::class, 'store']);
Route::get('/checkout', function () {
    return view('client.sections.static.checkout');
})->name('checkout');
Route::get('/check-order', [HomeController::class, 'order_check_view'])->name('order.check.view');
Route::get('/order-finding/{id}', [OrderController::class, 'show']);
//======================================HOME - CART ====================================//

Route::get('/my-shopping-cart', function () {
    return view('client.sections.static.cart');
})->name('cart');
//======================================HOME - BLOG ====================================//
Route::get('/blog', function () {
    return view('errors.404');
})->name('blog');
//====================================== - SHOP ========================================================//

Route::group(['prefix' => 'shop'], function () {
    Route::get('/', [HomeController::class, 'shop_view'])->name("shop");
    Route::get('/{slug}', [ShopController::class, 'show_product']);
    Route::get('/cat_id', [HomeController::class, 'get_category'])->name("category");
    Route::post('/search_product', [ProductController::class, 'find_product'])->name("search");
    Route::post('/product/check-role-review', [ShopController::class, 'check_role_review']);
    Route::post('/product/check-rating-review', [ShopController::class, 'check_rating']);
    Route::post('/product/rating', [ProductController::class, 'rating'])->middleware('auth.basic');
    Route::delete('/product/rating{id}', [RatingController::class, 'user_delete_rating']);
});
//====================================== - ACCOUNT ========================================================//

//Login - Social

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'show_login'])->name("login.show");
    Route::post('/login', [LoginController::class, 'login'])->name("login");
    Route::post('/register', [LoginController::class, 'register'])->name("register");
});
Route::group(['prefix' => 'my-account', 'middleware' => ['auth.basic']], function () {
    Route::POST('/img_change', [UserController::class, 'update_img'])->name("user.image.update");

    //Information
    Route::get('/account_view', [UserController::class, 'account_view'])->name("user.account.view");
    Route::post('/account-update', [UserController::class, 'account_update'])->name("user.account.update");
    Route::post('/address-remove', [UserController::class, 'address_delete']);
    Route::post('/address-add', [UserController::class, 'address_add']);
    Route::post('/phone-set-default', [UserController::class, 'set_default_phone']);
    Route::delete('/phone-delete={number}', [UserController::class, 'phone_delete']);
    Route::post('password/update', [UserController::class, 'update_password']);

    //Favorite
    Route::post('/favorite', [UserController::class, 'add_favorite']);
    Route::get('/favorite/show', [UserController::class, 'show_favorite']);
    Route::post('/favorite/sync', [UserController::class, 'sync_favorite']);

    //Notify
    Route::get('/notify', [UserController::class, 'get_list_notify']);
    Route::get('/notify/{id}',  [UserController::class, 'get_id_notify']);
    Route::get('/mark-all-read/{user}', function (UserModel $user) {
        $user->unreadNotifications->markAsRead();
        return response(['message' => 'done', 'notifications' => $user->notifications]);
    });
    Route::get('/mark-as-read/{userId}/{notifyId}', [UserController::class, 'markAsRead']);

    //Orther
    Route::post('/orders', [OrderController::class, 'show_order']);
    Route::get('total-used', [UserController::class, 'total_money_used']);
    Route::post('/logout', [LoginController::class, 'log_out'])->name('login.logout');
});
//===================================ADMIN ===========================================================================//
Route::group(['prefix' => 'admin'], function () {

    //================================ ADMIN AUTH ================================================================//
    //Register user
    Route::get('/register', [HomeController::class, 'register_view'])->name('admin.register.view');
    Route::post('/register-admin', [LoginController::class, 'admin_register'])->name('admin.register');
    //================================ LOGIN ADMIN================================================================//
    Route::prefix('auth')->group(function () {
        Route::get('/login', [HomeController::class, 'login_view'])->name('admin.login.view');
        Route::get('/logout', [LoginController::class, 'admin_logout'])->name('admin.logout');
        Route::post('/login-admin', [LoginController::class, 'admin_login'])->name('admin.login');
    });
    // Admin
    Route::group(['middleware' => ['admin']], function () {
        Route::get('/', [LoginController::class, 'admin_auth'])->name('admin_author');
        //Dashboard
        Route::prefix('dashboard')->group(function () {
            Route::get('/', [HomeController::class, 'dash_view'])->name('admin.dashboard');
            Route::get('/{type}', [HomeController::class, 'get_top_product']);
        });
        Route::get('/chart/{date}', [HomeController::class, 'get_chart_data']);
        //==========================================Category==============================================================
        Route::prefix('category')->group(function () {
            Route::get('/', [HomeController::class, 'category_view'])->name('admin.category');
            //Category add view 
            Route::get('/category-view-add', [HomeController::class, 'category_add_view'])->name('admin.category.add.view');
            //Category add 
            Route::post('/category-add', [CategoryController::class, 'add_category'])->name('admin.category.add');
            //Category edit view
            Route::get('/category-edit-view/{id}', [HomeController::class, 'category_edit_view'])->name('admin.category.edit.view');
            //Category edit 
            Route::post('/category-edit', [CategoryController::class, 'category_edit'])->name('admin.category.edit');
            //Category delete 
            Route::get('/category-delete/{id}', [CategoryController::class, 'category_delete'])->name('admin.category.delete');
            //Category restore
            Route::get('/category-restore/{id}', [CategoryController::class, 'restore'])->name('admin.category.restore');
            //Category list for type
            Route::get('/{id}', [CategoryController::class, 'show']);
        });
        //==========================================Tags==============================================================
        Route::prefix('tags')->group(function () {
            Route::get('/', [HomeController::class, 'tags_view'])->name('admin.tags');
            //Tags add view 
            Route::get('/tags-view-add', [HomeController::class, 'tags_add_view'])->name('admin.tags.add.view');
            //Tags add 
            Route::post('/tags-add', [TagsController::class, 'add_tags'])->name('admin.tags.add');
            //Tags edit view
            Route::get('/tags-edit-view/{id}', [HomeController::class, 'tags_edit_view'])->name('admin.tags.edit.view');
            //Tags edit 
            Route::post('/tags-edit', [TagsController::class, 'tags_edit'])->name('admin.tags.edit');
            //Tags delete 
            Route::get('/tags-delete/{id}', [TagsController::class, 'tags_delete'])->name('admin.tags.delete');
            //Tags restore
            Route::get('/tags-restore/{id}', [TagsController::class, 'restore'])->name('admin.tags.restore');
            //Tags list for type
            Route::get('/{id}', [TagsController::class, 'show']);
            //Multiple Book Tags Add 
            Route::post('/option/books-multiple', [TagsController::class, 'add_multi_book']);
        });
        //==========================================Book list==============================================================
        Route::prefix('books')->group(function () {
            //Book list
            Route::get('/', [HomeController::class, 'book_list_view'])->name('admin.books');
            //Booklist ajax call 
            Route::get('/books', [ProductController::class, 'show']);
            //Book add view
            Route::get('/book-add-view', [HomeController::class, 'book_list_add_view'])->name('admin.books.add.view');
            //Book add
            Route::post('/book-add', [ProductController::class, 'add'])->name('admin.books.add');
            //Book edit view
            Route::get('/book-edit-view/{book_id}', [HomeController::class, 'book_edit_view'])->name('admin.books.edit.view');
            //Book edit
            Route::post('/book-edit', [ProductController::class, 'update'])->name('admin.books.edit');
            //Book delete 
            Route::get('/book-delete/book_id={book_id}', [ProductController::class, 'remove'])->name('admin.books.delete');
            //Book stop selling
            Route::get('/book-stop-selling/book_id={book_id}', [ProductController::class, 'stop_selling']);
            //Book continue to sell
            Route::get('/book-continue-to-sale/book_id={book_id}', [ProductController::class, 'sale']);
        });
        //==========================================Publisher=============================================================
        Route::prefix('publishers')->group(function () {
            Route::get('/', [HomeController::class, 'publisher_view'])->name('admin.publisher');
            //Publisher-add view
            Route::get('publisher-add-view', [HomeController::class, 'add_publisher_view'])->name('admin.publisher.add.view');
            //Publisher-add
            Route::post('publisher-add', [PublisherController::class, 'add_publisher'])->name('admin.publisher.add');
            //Publisher-edit view
            Route::get('publisher-edit-view/{id}', [HomeController::class, 'edit_publisher_view'])->name('admin.publisher.edit.view');
            //Publisher edit
            Route::post('publisher-edit/{id}', [PublisherController::class, 'edit_publisher'])->name('admin.publisher.edit');
            //Publisher delete
            Route::get('publisher-delete/{id}', [PublisherController::class, 'delete_publisher'])->name('admin.publisher.delete');
            //Publisher restore
            Route::get('publisher-restore/{id}', [PublisherController::class, 'restore'])->name('admin.publisher.restore');
        });
        //==========================================Supplier=============================================================
        Route::prefix('suppliers')->group(function () {
            Route::get('/', [HomeController::class, 'supplier_view'])->name('admin.supplier');
            //Supplier-add view
            Route::get('supplier-add-view', [HomeController::class, 'add_supplier_view'])->name('admin.supplier.add.view');
            //Supplier-add
            Route::post('supplier-add', [SupplierController::class, 'add_supplier'])->name('admin.supplier.add');
            //Supplier-edit view
            Route::get('supplier-edit-view/{id}', [HomeController::class, 'edit_supplier_view'])->name('admin.supplier.edit.view');
            //Supplier edit
            Route::post('supplier-edit/{id}', [SupplierController::class, 'edit_supplier'])->name('admin.supplier.edit');
            //Supplier delete
            Route::get('supplier-delete/{id}', [SupplierController::class, 'delete_supplier'])->name('admin.supplier.delete');
            //Supplier restore
            Route::get('supplier-restore/{id}', [SupplierController::class, 'restore'])->name('admin.supplier.restore');
        });
        //==========================================Author=============================================================
        Route::prefix('authors')->group(function () {
            Route::get('/', [HomeController::class, 'author_view'])->name('admin.author');
            //Author-add view
            Route::get('author-add-view', [HomeController::class, 'author_add_view'])->name('admin.author.add.view');
            //Author-add
            Route::post('author-add', [AuthorController::class, 'add'])->name('admin.author.add');
            //Author-edit view
            Route::get('author-edit-view/{id}', [HomeController::class, 'author_edit_view'])->name('admin.author.edit.view');
            //Author edit
            Route::post('author-edit/{id}', [AuthorController::class, 'edit'])->name('admin.author.edit');
            //Author delete
            Route::get('author-delete/{id}', [AuthorController::class, 'delete'])->name('admin.author.delete');
            //Author restore
            Route::get('author-restore/{id}', [AuthorController::class, 'restore'])->name('admin.author.restore');
        });
        //========================================== Series =============================================================
        Route::prefix('series')->group(function () {
            Route::get('/', [HomeController::class, 'series_view'])->name('admin.series');
            //Series-add view
            Route::get('series-add-view', [HomeController::class, 'series_add_view'])->name('admin.series.add.view');
            //Series-add
            Route::post('series-add', [SeriesController::class, 'add'])->name('admin.series.add');
            //Series-edit view
            Route::get('series-edit-view/{id}', [HomeController::class, 'series_edit_view'])->name('admin.series.edit.view');
            //Series edit
            Route::post('series-edit/{id}', [SeriesController::class, 'edit'])->name('admin.series.edit');
            //Series delete
            Route::get('series-delete/{id}', [SeriesController::class, 'delete'])->name('admin.series.delete');
            //Series restore
            Route::get('series-restore/{id}', [SeriesController::class, 'restore'])->name('admin.series.restore');
        });
        //========================================== Format =============================================================
        Route::prefix('format')->group(function () {
            Route::get('/', [HomeController::class, 'format_view'])->name('admin.format');
            //Series-add view
            Route::get('format-add-view', [HomeController::class, 'format_add_view'])->name('admin.format.add.view');
            //Series-add
            Route::post('format-add', [BooksFormatController::class, 'add'])->name('admin.format.add');
            //Series-edit view
            Route::get('format-edit-view/{id}', [HomeController::class, 'format_edit_view'])->name('admin.format.edit.view');
            //Series edit
            Route::post('format-edit/{id}', [BooksFormatController::class, 'edit'])->name('admin.format.edit');
            //Series delete
            Route::get('format-delete/{id}', [BooksFormatController::class, 'delete'])->name('admin.format.delete');
            //Series restore
            Route::get('format-restore/{id}', [BooksFormatController::class, 'restore'])->name('admin.format.restore');
        });
        //========================================== Promotions =============================================================
        Route::prefix('promotions')->group(function () {
            Route::get('/', [HomeController::class, 'promotions_view'])->name('admin.promotions');
            //Promotions-add view
            Route::get('promotions-add-view', [HomeController::class, 'promotions_add_view'])->name('admin.promotions.add.view');
            //Promotions-add
            Route::post('promotions-add', [PromotionsController::class, 'add'])->name('admin.promotions.add');
            //Promotions-edit view
            Route::get('promotions-edit-view/{id}', [HomeController::class, 'promotions_edit_view'])->name('admin.promotions.edit.view');
            //Promotions edit
            Route::post('promotions-edit/{id}', [PromotionsController::class, 'edit'])->name('admin.promotions.edit');
            //Promotions delete
            Route::get('promotions-delete/{id}', [PromotionsController::class, 'delete'])->name('admin.promotions.delete');
            //Promotions restore
            Route::get('promotions-restore/{id}', [PromotionsController::class, 'restore'])->name('admin.promotions.restore');
            //Multiple Promotions Product Add 
            Route::post('/option/books-multiple', [PromotionsController::class, 'promotions']);
        });
        //========================================== Translator =============================================================
        Route::prefix('translator')->group(function () {
            Route::get('/', [HomeController::class, 'translator_view'])->name('admin.translator');
            //Translator-add view
            Route::get('translator-add-view', [HomeController::class, 'translator_add_view'])->name('admin.translator.add.view');
            //Translator-add
            Route::post('translator-add', [TranslatorController::class, 'add'])->name('admin.translator.add');
            //Translator-edit view
            Route::get('translator-edit-view/{id}', [HomeController::class, 'translator_edit_view'])->name('admin.translator.edit.view');
            //Translator edit
            Route::post('translator-edit/{id}', [TranslatorController::class, 'edit'])->name('admin.translator.edit');
            //Translator delete
            Route::get('translator-delete/{id}', [TranslatorController::class, 'delete'])->name('admin.translator.delete');
            //Translator restore
            Route::get('translator-restore/{id}', [TranslatorController::class, 'restore'])->name('admin.translator.restore');
        });
        //========================================== Orders =============================================================
        Route::prefix('orders')->group(function () {
            Route::post('/show', [OrderController::class, 'show_order']);
            Route::post('/guest/show', [OrderController::class, 'show_guest_order']);
            Route::get('/on-going', [HomeController::class, 'orders_ongoing_show'])->name('admin.orders.ongoing.show');
            Route::get('/complete', [HomeController::class, 'orders_complete_show'])->name('admin.orders.complete.show');
            Route::get('/guest-list', [OrderController::class, 'order_guest_list']);
            Route::get('/user-list', [OrderController::class, 'order_user_list']);
            Route::post('change-status', [OrderController::class, 'update_status']);
            Route::delete('/order={id}/user={email}', [OrderController::class, 'destroy']);
            Route::post('/restore', [OrderController::class, 'restore']);
        });
        //========================================== Voucher =============================================================
        Route::prefix('vouchers')->group(function () {
            Route::post('/', [VoucherController::class, 'create_voucher_user']);
        });
        //================================ MANAGER USER================================================================//
        Route::prefix('users')->group(function () {
            // User list view
            Route::get('/', [HomeController::class, 'user_list_view'])->name('admin.users');
            // User add view
            Route::get('/add-user', [HomeController::class, 'add_user'])->name('admin.users.view');
            //Delete user 
            Route::get('/delete-user-{user_name}', [UserController::class, 'delete_user'])->name('admin.users.delete');
            //User search 
            Route::get('/user_search', [UserController::class, 'search_user'])->name('admin_search_user');
            Route::post('/show', [UserController::class, 'show']);
            Route::post('/reset-password', [Usercontroller::class, 'reset_password']);
            Route::delete('/user/{id}', [UserController::class, 'delete_user']);
            Route::delete('/guest/{id}', [UserController::class, 'delete_guest']);
            Route::get('/admin', [HomeController::class, 'show_admin'])->name('admin.users.admin');
            Route::post('/user/restore', [UserController::class, 'restore_user']);
            Route::post('/guest/restore', [UserController::class, 'restore_guest']);
            //Rating
            Route::get('/rating', [HomeController::class, 'show_list_rating'])->name('admin.users.rating');
            Route::delete('/rating/delete{id}&&{mess}', [RatingController::class, 'delete']);
        });
        //================================ MANAGER FOLDER================================================================//
        Route::get('/laravel-folder-manager', function () {
            return view('vendor.ckfinder.browser')->render();
        })->name('folder');
        //================================ RESTORE LIST================================================================//
        Route::prefix('restore-list')->group(function () {
            //Book out of business
            Route::prefix('books')->group(function () {
                //Books-restore-list
                Route::get('/', [HomeController::class, 'book_list_out_of_business'])->name('admin.books.out_of_business');
                //Publisher-restore-list
                Route::get('/publishers', [HomeController::class, 'publisher_old_view'])->name('admin.publisher.old');
                //Supplier-restore-list
                Route::get('/suppliers', [HomeController::class, 'supplier_old_view'])->name('admin.supplier.old');
                //Category-restore-list
                Route::get('/category', [HomeController::class, 'category_old_view'])->name('admin.category.old');
                //Tags-restore-list
                Route::get('/tags', [HomeController::class, 'tags_old_view'])->name('admin.tags.old');
                //Category-restore-list
                Route::get('/authors', [HomeController::class, 'author_old_view'])->name('admin.author.old');
                //Series-restore-list
                Route::get('/series', [HomeController::class, 'series_old_view'])->name('admin.series.old');
                //Promotions-restore-list
                Route::get('/promotions', [HomeController::class, 'promotions_old_view'])->name('admin.promotions.old');
                //Translator-restore-list
                Route::get('/translator', [HomeController::class, 'translator_old_view'])->name('admin.translator.old');
                //Format-restore-list
                Route::get('/format', [HomeController::class, 'format_old_view'])->name('admin.format.old');
                Route::get('/type', [HomeController::class, 'type_old_view'])->name('admin.type.old');
            });
            Route::get('/account', [HomeController::class, 'account_old_view'])->name('admin.users.account.old');
            Route::get('/orders', [HomeController::class, 'orders_old_view'])->name('admin.orders.old');
            Route::get('/admin', [HomeController::class, 'show_old_admin'])->name('admin.users.admin.old');
        });
    });
    //================================ SLIDER ====================================================================//
});

//================================ UPLOAD_ FILE ========================================================//