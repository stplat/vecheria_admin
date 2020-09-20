<?php

use Illuminate\Support\Facades\Route;

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

Route::middleware('auth')->group(function () {

  Route::get('/admin', 'Admin\IndexController@index')->name('admin');

  Route::resource('/admin/products', 'Admin\ProductController', ['as' => 'admin'])->only('index', 'show', 'create', 'store', 'edit', 'destroy');
  Route::post('/admin/products/update', 'Admin\ProductController@update')->name('admin.products.update');

  /* Таблицы vue-table-2 (экспорт) */
  Route::post('/table/export', 'TableController@export')->name('table-export');
});

Route::get('/admin/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/admin/login', 'Auth\LoginController@login')->name('login');
Route::post('/admin/logout', 'Auth\LoginController@logout')->name('logout');


//Auth::routes([
//  'register' => false,
//  'confirm' => false,
//  'email' => false,
//  'request' => false,
//  'update' => false,
//  'reset' => false,
//]);
