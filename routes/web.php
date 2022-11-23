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

Route::get('/', 'AuthController@index')->name('login');
Route::post('authenticated', 'AuthController@authenticated')->name('authenticated');
Route::get('logout', 'AuthController@logout')->name('logout');

Route::group(['middleware' => 'auth:administrator'], function() {
    Route::get('dashboard', 'AdminController@index');
    Route::post('dashboard/updatevoting', 'AdminController@updateVoting')->name('updatevoting');
    Route::post('dashboard/chart', 'AdminController@getChart')->name('Chart');

    Route::get('mastertps', 'AdminController@viewTps');
    Route::post('mastertps/create', 'AdminController@addTps')->name('addtps');
    Route::post('mastertps/get', 'AdminController@getTps')->name('gettps');
    Route::post('mastertps/update', 'AdminController@updateTps')->name('updatetps');
    Route::post('mastertps/delete', 'AdminController@deleteTps')->name('deletetps');

    Route::get('masterusers', 'AdminController@viewUser');
    Route::post('masterusers/create', 'AdminController@addUser')->name('adduser');
    Route::post('masterusers/get', 'AdminController@getUser')->name('getuser');
    Route::post('masterusers/update', 'AdminController@updateUser')->name('updateuser');
    Route::post('masterusers/delete', 'AdminController@deleteUser')->name('deleteuser');

    Route::get('masterbuku', 'AdminController@viewBuku');
    Route::post('masterbuku/create', 'AdminController@addBuku')->name('addbuku');
    Route::post('masterbuku/get', 'AdminController@getBuku')->name('getbuku');
    Route::post('masterbuku/update', 'AdminController@updateBuku')->name('updatebuku');
    Route::post('masterbuku/delete', 'AdminController@deleteBuku')->name('deletebuku');

    Route::get('mastergenre', 'AdminController@viewGenre');
    Route::post('mastergenre/create', 'AdminController@addGenre')->name('addgenre');
    Route::post('mastergenre/get', 'AdminController@getGenre')->name('getgenre');
    Route::post('mastergenre/update', 'AdminController@updateGenre')->name('updategenre');
    Route::post('mastergenre/delete', 'AdminController@deleteGenre')->name('deletegenre');

    Route::get('masterpegawai', 'AdminController@viewPegawai');
    Route::post('masterpegawai/create', 'AdminController@addPegawai')->name('addpegawai');
    Route::post('masterpegawai/get', 'AdminController@getPegawai')->name('getpegawai');
    Route::post('masterpegawai/update', 'AdminController@updatePegawai')->name('updatepegawai');
    Route::post('masterpegawai/delete', 'AdminController@deletePegawai')->name('deletepegawai');

    Route::get('mastermember', 'AdminController@viewMember');
    Route::post('mastermember/create', 'AdminController@addMember')->name('addmember');
    Route::post('mastermember/get', 'AdminController@getMember')->name('getmember');
    Route::post('mastermember/update', 'AdminController@updateMember')->name('updatemember');
    Route::post('mastermember/delete', 'AdminController@deleteMember')->name('deletemember');

    Route::get('masterdevisi', 'AdminController@viewDevisi');
    Route::post('masterdevisi/create', 'AdminController@addDevisi')->name('adddevisi');
    Route::post('masterdevisi/get', 'AdminController@getDevisi')->name('getdevisi');
    Route::post('masterdevisi/update', 'AdminController@updateDevisi')->name('updatedevisi');
    Route::post('masterdevisi/delete', 'AdminController@deleteDevisi')->name('deletedevisi');

    Route::get('tpinjam', 'AdminController@viewPinjam');
    Route::post('tpinjam/create', 'AdminController@addPinjam')->name('addpinjam');
    Route::post('tpinjam/get', 'AdminController@getPinjam')->name('getpinjam');
    Route::post('tpinjam/update', 'AdminController@updatePinjam')->name('updatepinjam');
    Route::post('tpinjam/delete', 'AdminController@deletePinjam')->name('deletepinjam');

    Route::get('cek', 'AdminController@cek')->name('cek');

});

Route::middleware(['auth:pengawas'])->group(function() {
    Route::get('pengawas', 'PengawasController@index');
    Route::get('profile', 'PengawasController@viewProfile');
    Route::post('profile/update', 'PengawasController@update')->name('updateprofile');
    Route::post('pengawas/upload', 'PengawasController@upload')->name('uploaddata');
});