<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Product\AuthorController;
use App\Http\Controllers\Product\CategoryController;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::apiResource('category', 'Product\CategoryController');
Route::apiResource('author', 'Product\AuthorController');
Route::apiResource('translator', 'Product\TranslatorController');
Route::apiResource('tags', 'Product\TagsController');
Route::apiResource('books', 'Product\ProductController');
Route::apiResource('promotions', 'Product\PromotionsController');
Route::apiResource('shipping', 'ShippingController')->only('index');
Route::apiResource('orders', 'Order\OrderController');
//Optional route
Route::get('author/book/{book_id}', 'Product\AuthorController@get_related');
Route::get('translator/book/{book_id}', 'Product\TranslatorController@get_related');
Route::get('tags/book/{book_id}', 'Product\TagsController@get_related');
Route::get('books/book/{book_id}', 'Product\ProductController@get_related');
Route::post('books/option/related_with_cart', 'Product\ProductController@product_related_cart');
Route::post('checkout/vouchher', 'Order\CheckoutController@apply_voucher');
Route::get('city-list', 'Order\CheckoutController@city_list');
Route::get('wards-list', 'Order\CheckoutController@wards_list');
Route::get('district-list', 'Order\CheckoutController@district_list');
Route::get('users/{id}', 'Order\StatusController@index');
Route::get('districts-{city_code}', 'Order\CheckoutController@district');
Route::get('wards-{district_code}', 'Order\CheckoutController@wards');
Route::get('address/user/{user_token}', 'Auth\Usercontroller@get_address_list');
Route::get('phone/user/{user_token}', 'Auth\Usercontroller@get_phone_list');
Route::post('/order_create_account', 'Auth\UserController@order_create_account');
Route::get('show_my_address/{wards}-{district}-{city}', 'Auth\UserController@show_my_address');
Route::get('books/thumb/{book_id}', 'Product\SeriesController@get_thumb');
Route::get('/status', 'Order\StatusController@index');
Route::post('book/check-quantity', 'Product\ProductController@check_quantity');
Route::post('/checkout/check-quantity', 'Order\CheckoutController@check_quantity');
Route::get('product/related/{id}', 'Product\ProductController@related');
Route::post('checkout/get-item-shoppingcart','Order\CheckoutController@get_cart_item');