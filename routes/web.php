<?php

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
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Product\AuthorController;
use App\Http\Controllers\Product\BooksFormatController;
use App\Http\Controllers\Product\BooksTypeController;
use App\Http\Controllers\Product\SeriesController;
use App\Http\Controllers\Product\SupplierController;
use App\Http\Controllers\Product\TranslatorController;
use App\Http\Controllers\Store\GoogleDriverController;
use App\Http\Controllers\Store\S3Controller;
use App\Models\ProductModel;
use Illuminate\Support\Facades\Request;
use  Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
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
Route::get('/view', function () {
    return view('file');
});
Route::post('/file', [FileuploadController::class, 'store'])->name('file');
Route::get('/users-list', [UserController::class, 'index']);
Route::get('/change-status-user/{userid}/{status}', [UserController::class, 'update_status']);
Route::get('/test', function () {
    $data = UserModel::where('user_id', 82)->first();
    event(new UserRegisted($data));
    return "test";
});
// Route::get('/voucher', function () {
//     Promocodes::create($amount = 1, $reward = null, array $data = [], $expires_in = null, $quantity = null, $is_disposable = false);
//     return "OK";
// });
//=========================================================//KHU VUC TESTING =========================================================//

//===================================LOG-IN ========================================================================//
$controllerName = 'login';
Route::group(['prefix' => $controllerName, 'middleware' => ['login']], function () {
    $controller = LoginController::class;
    Route::get('/', [$controller, 'show_login'])->name("login");
    Route::post('/sign-in', [$controller, 'Login'])->name("login_signin");
    Route::post('/sign-up', [$controller, 'Register'])->name("login_signup");
});
Route::get('/log-out', [LoginController::class, 'log_out'])->name('log_out');

//===================================HOME - PAGE ====================================================================//
Route::get('/', [HomeController::class, 'home'])->name('home');

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
    Route::post('/add-to-cart-ajax', [$controller, 'add_cart_ajax'])->name("add_to_cart_ajax");
    Route::get('/update-cart', [$controller, 'update_cart'])->name("update_cart");
    Route::get('/show-cart', [$controller, 'cart_view'])->name("cart");
});
//======================================HOME - BLOG ====================================//

$controllerName = 'blog';
Route::group(['prefix' => $controllerName], function () {
    $controller = HomeController::class;
    Route::get('/', [$controller, 'blog_view'])->name("blog");
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
Route::group(['prefix' => $controllerName, 'middleware' => ['user']], function () {
    $controller = UserController::class;
    Route::POST('/img_change', [$controller, 'update_img'])->name("user.image.update");
    Route::get('/account_view', [$controller, 'account_view'])->name("user.account.view");
    Route::post('/account-update', [$controller, 'account_update'])->name("user.account.update");
});
//====================================== - SHOP ========================================================//

$controllerName = 'shop';
Route::group(['prefix' => $controllerName], function () {
    Route::get('/', [HomeController::class, 'shop_view'])->name("shop", ["get_cat_items" => $get_cat_items = null]);
    //LAY ID CATEGORY KHI DUOC TRUYEN GIA TRI VAO TRA VE LIST THEO ID CATEGORY
    Route::get('/cat_id={cat_id}', [HomeController::class, 'get_category'])->name("category");
    Route::post('/search_product', [ProductController::class, 'find_product'])->name("search");
});
//====================================== - ACCOUNT ========================================================//
Route::get('/notify', [UserController::class, 'get_list_notify']);
Route::get('/notify/{id}',  [UserController::class, 'get_id_notify']);
Route::get('/mark-all-read/{user}', function (UserModel $user) {
    $user->unreadNotifications->markAsRead();
    return response(['message' => 'done', 'notifications' => $user->notifications]);
});
Route::get('/mark-as-read/{userId}/{notifyId}', [UserController::class, 'markAsRead']);

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
    //
    Route::group(['middleware' => ['admin']], function () {
        Route::get('/', [LoginController::class, 'admin_auth'])->name('admin_author');
        Route::get('/dashboard', [HomeController::class, 'dash_view'])->name('admin.dashboard');
        //==========================================Category==============================================================
        Route::prefix('category')->group(function () {
            Route::get('/', [HomeController::class, 'category_view'])->name('admin.category');
            //Category add view 
            Route::get('/category-view-add', [HomeController::class, 'category_add_view'])->name('admin.category.add.view');
            //Category add 
            Route::post('/category-add', [CategoryController::class, 'add_category'])->name('admin.category.add');
            //Category edit view
            Route::get('/category-edit-view/{cat_id}', [HomeController::class, 'category_edit_view'])->name('admin.category.edit.view');
            //Category edit 
            Route::post('/category-edit', [CategoryController::class, 'category_edit'])->name('admin.category.edit');
            //Category delete 
            Route::get('/category-delete/{cat_id}', [CategoryController::class, 'category_delete'])->name('admin.category.delete');
            //Category restore
            Route::get('/category-restore/{cat_id}', [CategoryController::class, 'restore'])->name('admin.category.restore');
            //Category list for type
            Route::get('/{id}', [CategoryController::class, 'show']);
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
        //========================================== Book type =============================================================
        Route::prefix('type')->group(function () {
            Route::get('/', [HomeController::class, 'type_view'])->name('admin.type');
            //Series-add view
            Route::get('type-add-view', [HomeController::class, 'type_add_view'])->name('admin.type.add.view');
            //Series-add
            Route::post('type-add', [BooksTypeController::class, 'add'])->name('admin.type.add');
            //Series-edit view
            Route::get('type-edit-view/{id}', [HomeController::class, 'type_edit_view'])->name('admin.type.edit.view');
            //Series edit
            Route::post('type-edit/{id}', [BooksTypeController::class, 'edit'])->name('admin.type.edit');
            //Series delete
            Route::get('type-delete/{id}', [BooksTypeController::class, 'delete'])->name('admin.type.delete');
            //Series restore
            Route::get('type-restore/{id}', [BooksTypeController::class, 'restore'])->name('admin.type.restore');
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
        }); //========================================== Translator =============================================================
        Route::prefix('translator')->group(function () {
            Route::get('/', [HomeController::class, 'translator_view'])->name('admin.translator');
            //Series-add view
            Route::get('translator-add-view', [HomeController::class, 'translator_add_view'])->name('admin.translator.add.view');
            //Series-add
            Route::post('translator-add', [TranslatorController::class, 'add'])->name('admin.translator.add');
            //Series-edit view
            Route::get('translator-edit-view/{id}', [HomeController::class, 'translator_edit_view'])->name('admin.translator.edit.view');
            //Series edit
            Route::post('translator-edit/{id}', [TranslatorController::class, 'edit'])->name('admin.translator.edit');
            //Series delete
            Route::get('translator-delete/{id}', [TranslatorController::class, 'delete'])->name('admin.translator.delete');
            //Series restore
            Route::get('translator-restore/{id}', [TranslatorController::class, 'restore'])->name('admin.translator.restore');
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
                //Category-restore-list
                Route::get('/authors', [HomeController::class, 'author_old_view'])->name('admin.author.old');
                //Series-restore-list
                Route::get('/series', [HomeController::class, 'series_old_view'])->name('admin.series.old');
                //Translator-restore-list
                Route::get('/translator', [HomeController::class, 'translator_old_view'])->name('admin.translator.old');
                //Format-restore-list
                Route::get('/format', [HomeController::class, 'format_old_view'])->name('admin.format.old');
                Route::get('/type', [HomeController::class, 'type_old_view'])->name('admin.type.old');
            });
            Route::get('/account', [HomeController::class, 'account_old_view'])->name('admin.account.old');
        });
    });
    //================================ SLIDER ====================================================================//
});

Route::prefix('home')->group(function () {
    Route::get('/', [HomeController::class, 'index']);
});

//================================ UPLOAD_ FILE ========================================================//