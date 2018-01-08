<?php

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

Route::get('/', function () {
    return view('welcome');
});

//Auth::routes();
// Route::group(['middleware' => ['web']], function() {

// // Login Routes...
//     Route::get('/', ['as' => 'login', 'uses' => 'Auth\LoginController@showLoginForm']);
// });


//Route::get('/', 'Auth\LoginController@showLoginForm');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/* User Controller */
// Route::get('/login', 'UsersController@login') -> name('login');
// Route::get('/users', 'UsersController@index') -> name('login');
// Route::get('/users/create', 'UsersController@create');


Route::get('/product', 'ProductController@index') -> name('product-index');
Route::any('/product/create', 'ProductController@create') -> name('product-create');
Route::any('/product/edit/{id}', 'ProductController@edit') -> name('product-update');



Route::get('/category', 'CategoryController@index') -> name('category-index');
Route::any( '/category/create', 'CategoryController@create') -> name('category-add');
Route::any('/category/edit/{id}', 'CategoryController@edit') -> name('category-update');
Route::any('/category/destroy/{id}', 'CategoryController@destroy') -> name('category-delete');



Route::get('/product-brand', 'BrandController@index') -> name('brand-index');
Route::any('/product-brand/create', 'BrandController@create') -> name('brand-add');
Route::any('/product-brand/edit/{id}', 'BrandController@edit') -> name('brand-update');
Route::any('/product-brand/destroy/{id}', 'BrandController@destroy') -> name('brand-delete');

Route::get('/product-size', 'ProductSizeController@index') -> name('product-size-index');
Route::any('/product-size/create', 'ProductSizeController@create') -> name('product-size-add');
Route::any('/product-size/edit/{id}', 'ProductSizeController@edit') -> name('product-size-update');
Route::any('/product-size/destroy/{id}', 'ProductSizeController@destroy') -> name('product-size-delete');


Route::get('/product-detail', 'ProductDetailController@index') -> name('product-detail-index');
Route::any('/product-detail/create', 'ProductDetailController@create') -> name('product-detail-add');
Route::any('/product-detail/edit/{id}', 'ProductDetailController@edit') -> name('product-product-detail-update');
Route::any('/product-detail/destroy/{id}', 'ProductDetailController@destroy') -> name('product-product-detail-delete');

Route::get('/product-detail/view/{id}', 'ProductDetailController@view') -> name('product-detail-view');
Route::any('/product/product-detail/add/{id}', 'ProductDetailController@add') -> name('product-product-detail-add');

Route::get('/sales',  'SalesController@index') -> name('sales');
Route::any('/sales/create', 'SalesController@create') -> name('sales-add');
Route::any('/sales/edit/{id}', 'SalesController@edit') -> name('sales-update');
Route::any('/sales/destroy/{id}', 'SalesController@destroy') -> name('sales-delete');
Route::any('/sales/product-detail/id/{id}/size/{size}', 'SalesController@productDetail') -> name('sales-product-detail');



Route::get('/dashboard', 'DashboardController@index') -> name('dashboard');
Route::resources([
	//'product'	=> 'ProductController',
	'users' 	=> 'UsersController',
	'brand' 	=> 'BrandController',
]);