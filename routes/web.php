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

    Route::get('/wali-kelas', 'App\Http\Controllers\AdminController@waliKelasIndex')->name('wali-kelas-home');
    Route::get('/wali-kelas-add', 'App\Http\Controllers\AdminController@waliKelasAdd')->name('wali-kelas-add');
    Route::post('/wali-kelas-insert', 'App\Http\Controllers\AdminController@waliKelasInsert')->name('wali-kelas-insert');
    Route::get('/wali-kelas-update-form/{id}', 'App\Http\Controllers\AdminController@waliKelasUpdateForm')->name('wali-kelas-update-form');
    Route::post('/wali-kelas-update/{id}', 'App\Http\Controllers\AdminController@waliKelasUpdate')->name('wali-kelas-update');
    Route::get('/wali-kelas-delete/{id}', 'App\Http\Controllers\AdminController@waliKelasDelete')->name('wali-kelas-delete');
    Route::get('/wali-kelas-view/{id}', 'App\Http\Controllers\AdminController@waliKelasView')->name('wali-kelas-view');

    Route::get('/mapel', 'App\Http\Controllers\MapelController@mapelIndex')->name('mapel-home');
    Route::get('/mapel-add', 'App\Http\Controllers\MapelController@mapeladd')->name('mapel-add');
    Route::post('/mapel-insert', 'App\Http\Controllers\MapelController@mapelInsert')->name('mapel-insert');
    Route::get('/mapel-update-form/{id}', 'App\Http\Controllers\MapelController@mapelUpdateForm')->name('mapel-update-form');
    Route::post('/mapel-update/{id}', 'App\Http\Controllers\MapelController@mapelUpdate')->name('mapel-update');
    Route::get('/mapel-delete/{id}', 'App\Http\Controllers\MapelController@mapelDelete')->name('mapel-delete');
    Route::get('/mapel-view/{id}', 'App\Http\Controllers\MapelController@mapelView')->name('mapel-view');
}
);

route::prefix('mapel') -> group(function () {
    Route::get('/home1', 'App\Http\Controllers\MapelController@mapelIndex1')->name('mapel-home-1');
    Route::get('/home2', 'App\Http\Controllers\MapelController@mapelIndex2')->name('mapel-home-2');
    Route::get('/home3', 'App\Http\Controllers\MapelController@mapelIndex3')->name('mapel-home-3');

    Route::get('/mapel-filtered1', 'App\Http\Controllers\MapelController@mapelFilterX')->name('mapel-filtered-1');
    Route::get('/mapel-filtered2', 'App\Http\Controllers\MapelController@mapelFilterXI')->name('mapel-filtered-2');
    Route::get('/mapel-filtered3', 'App\Http\Controllers\MapelController@mapelFilterXII')->name('mapel-filtered-3');

    //Route::get('/mapel', 'App\Http\Controllers\MapelController@mapelBreadCrumb')->name('mapel-home');
}
);





