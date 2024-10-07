<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//ADMIN/ADMIN
route::prefix('admin') -> group(function () {
    Route::get('/', 'App\Http\Controllers\AdminController@index')->name('home');
    Route::get('/admin-add', 'App\Http\Controllers\AdminController@adminAdd')->name('admin-add');
    Route::post('/admin-insert', 'App\Http\Controllers\AdminController@adminInsert')->name('admin-insert');
    Route::get('/admin-update-form/{id}', 'App\Http\Controllers\AdminController@adminUpdateForm')->name('admin-update-form');
    Route::post('/admin-update/{id}', 'App\Http\Controllers\AdminController@adminUpdate')->name('admin-update');
    Route::get('/admin-delete/{id}', 'App\Http\Controllers\AdminController@adminDelete')->name('admin-delete');
    Route::get('/admin-view/{id}', 'App\Http\Controllers\AdminController@adminView')->name('admin-view');

    Route::get('/guru', 'App\Http\Controllers\AdminController@guruIndex')->name('guru-home');
    Route::get('/guru-add', 'App\Http\Controllers\AdminController@guruAdd')->name('guru-add');
    Route::post('/guru-insert', 'App\Http\Controllers\AdminController@guruInsert')->name('guru-insert');
    Route::get('/guru-update-form/{id}', 'App\Http\Controllers\AdminController@guruUpdateForm')->name('guru-update-form');
    Route::post('/guru-update/{id}', 'App\Http\Controllers\AdminController@guruUpdate')->name('guru-update');
    Route::get('/guru-delete/{id}', 'App\Http\Controllers\AdminController@guruDelete')->name('guru-delete');
    Route::get('/guru-view/{id}', 'App\Http\Controllers\AdminController@guruView')->name('guru-view');

    Route::get('/kelas', 'App\Http\Controllers\AdminController@kelasIndex')->name('kelas-home');
    Route::get('/kelas-add', 'App\Http\Controllers\AdminController@kelasAdd')->name('kelas-add');
    Route::post('/kelas-insert', 'App\Http\Controllers\AdminController@kelasInsert')->name('kelas-insert');
    Route::get('/kelas-update-form/{id}', 'App\Http\Controllers\AdminController@kelasUpdateForm')->name('kelas-update-form');
    Route::post('/kelas-update/{id}', 'App\Http\Controllers\AdminController@kelasUpdate')->name('kelas-update');
    Route::get('/kelas-delete/{id}', 'App\Http\Controllers\AdminController@kelasDelete')->name('kelas-delete');
    Route::get('/kelas-view/{id}', 'App\Http\Controllers\AdminController@kelasView')->name('kelas-view');
}
);




