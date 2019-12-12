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

Route::get('/', 'Frontend\MainController@index')->name('frontend.main');
Route::get('/Kategori/{nama}', 'Frontend\MainController@kategori')->name('frontend.kategori');

Route::get('/color-generator', 'Frontend\MainController@colorGenerator')->name('color-generator');

Route::get('/artikel/{artikel}', 'Frontend\PostController@show')->name('baca');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'Admin'], function () {
    Route::group(['middleware' => ['role:Admin']], function () {
        Route::group(['middleware' => ['auth']], function () {
						Route::get('/', 'Backend\MainController@index')->name('admin.main');
						Route::resource('role', 'Backend\RoleController');
						Route::resource('permission', 'Backend\PermissionController');
						Route::resource('user', 'Backend\UserController');
						Route::resource('kategori', 'Backend\CategoryController');
						Route::resource('artikel', 'Backend\PostController');
						Route::put('artikel/{id}/publish', 'Backend\PostController@publish')->name('publish');
				});
    });
});
