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
Route::apiResource('tags', 'Product\TranslatorController');

//Optional route
Route::get('author/book/{book_id}', 'Product\AuthorController@get_related');
Route::get('translator/book/{book_id}', 'Product\TranslatorController@get_related');
Route::get('tags/book/{book_id}', 'Product\TagsController@get_related');
