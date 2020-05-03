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

// Route::get('/', function () {
//     return view('welcome');
// });

//USER
Route::get('/login', 'UserController@login');
Route::post('/login/action', 'UserController@loginAction');

Route::get('/admin', 'GudangController@index');
Route::get('/admin/add/post', 'GudangController@gudangAddPost');
Route::post('/admin/add/post/save', 'GudangController@gudangAddSave');
Route::get('/admin/edit/{id}', 'GudangController@gudangEditPost');
Route::post('/admin/{id}/update', 'GudangController@gudangEditPostSave');

Route::get('/admin/detail/{id}', 'GudangController@gudangDetailPost');

Route::get('/admin/delete/{id}', 'GudangController@gudangDeletePost');
Route::get('/admin/search', 'GudangController@gudangSearch');

Route::get('/sign-out', 'GudangController@signOut');


//kategori
Route::get('/admin/kategori', 'KategoriController@index');
Route::get('/admin/kategori/add', 'KategoriController@kategoriAddPost');
Route::post('/admin/kategori/add/save', 'KategoriController@kategoriAddSave');
Route::get('/admin/kategori/edit/{id}', 'KategoriController@kategoriEditPost');
Route::post('/admin/kategori/{id}/update', 'KategoriController@kategoriEditPostSave');

Route::get('/admin/delete/{id}', 'KategoriController@kategoriDeletePost');
//Route::get('/admin/search', 'GudangController@gudangSearch');
// Route::get('/admin', function () {
//     return view('gudang_index');

Route::get('/produk', 'ProdukController@index');
//beli
Route::get('/produk/beli/{id}', 'ProdukController@barangKeranjang');
//keranjang
Route::get('/produk/keranjang', 'ProdukController@keranjang');
//checkout
Route::post('/keranjang/nota', 'ProdukController@checkOut');
//Nota
Route::get('/nota', 'ProdukController@nota')->name('/keranjang/nota');
//download Nota
Route::get('/download/nota/{id}', 'ProdukController@downloadNota');
