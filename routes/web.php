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
// use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;

Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    return 'DONE'; //Return anything
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index');
Route::get('home/admin/log', 'HomeController@logadmin');

Route::post('/sacon/admin/getdata', 'SaconController@admingetdata');
Route::post('/sacon/export/excel', 'SaconController@export_data');
Route::resource('sacon', 'SaconController');

Route::post('/barcode/sacon', 'BarcodeController@barcode_sacon');
Route::get('/laporanadmin', 'LaporanController@laporan_admin');
Route::get('/laporanadmin/sortir', 'LaporanController@laporan_admin_sortir');
Route::post('/laporan/excel', 'LaporanController@export');

Route::post('/admin/role/getdata', 'UserController@role_getdata');
Route::get('/user/admin/getdata', 'UserController@admingetdata');
Route::resource('user', 'UserController');

//operator1
Route::post('/cekbarcode', 'BarcodeController@cekbarcodeop1data');
Route::post('/cekbarcode/warping', 'BarcodeController@cekbarcode_warping');
Route::post('/cekbarcode/indigo', 'BarcodeController@cekbarcode_indigo');
Route::post('/cekbarcode/weaving', 'BarcodeController@cekbarcode_weaving');
Route::post('/cekbarcode/greige', 'BarcodeController@cekbarcode_greige');
Route::post('/operator1/cekbarcode/data', 'BarcodeController@cekbarcodeop1data');

Route::post('/warping/status/check', 'WarpingController@cek_status');
Route::get('/warping/operator1/getdata/{kp}', 'WarpingController@operator1getdata');

Route::post('/indigo/status/check', 'IndigoController@cek_status');
Route::get('/indigo/operator1/getdata/{kp}', 'IndigoController@operator1getdata');

Route::post('/weaving/status/check', 'WeavingController@cek_status');
Route::get('/weaving/operator1/getdata/{kp}', 'WeavingController@operator1getdata');
Route::resource('weaving', 'WeavingController');

Route::post('/greige/status/check', 'GreigeController@cek_status');
Route::get('/greige/operator1/getdata/{kp}', 'GreigeController@operator1getdata');
Route::post('/operator1/potong/data', 'GreigeController@operator1potong');
Route::post('/operator1/sn/data', 'GreigeController@operator1sn');

Route::get('/finish/operator1/getdata/{kp}', 'FinishController@operator1getdata');
Route::post('/operator1/finish/sn', 'FinishController@sndata');


//operator2
Route::post('operator2/barcode/sacon', 'BarcodeController@barcode_sacon_operator2');
Route::post('operator2/barcode/warping', 'BarcodeController@barcode_warping_operator2');
Route::post('operator2/barcode/indigo', 'BarcodeController@barcode_indigo_operator2');
Route::post('operator2/barcode/weaving', 'BarcodeController@barcode_weaving_operator2');
Route::post('operator2/barcode/greige', 'BarcodeController@barcode_greige_operator2');
Route::post('operator2/barcode/finish', 'BarcodeController@barcode_finish_operator2');

Route::post('/warping/export/excel', 'WarpingController@export_data');
Route::post('/warping/operator2/getdata', 'WarpingController@operator2getdata');

Route::post('/indigo/export/excel', 'IndigoController@export_data');
Route::post('/indigo/operator2/getdata', 'IndigoController@operator2getdata');
Route::post('/indigo/operator2/getnb', 'IndigoController@operator2getnb');

Route::post('/weaving/export/excel', 'WeavingController@export_data');
Route::post('/weaving/operator2/getdata', 'WeavingController@operator2getdata');
Route::post('/weaving/operator2/getnb', 'WeavingController@operator2getnb');

Route::post('/greige/export/excel', 'GreigeController@export_data');
Route::post('/greige/operator2/getdata', 'GreigeController@operator2getdata');
Route::post('/operator2/pitem/data', 'GreigeController@operator2pitem');

Route::post('/finish/export/excel', 'FinishController@export_data');
Route::post('/finish/operator2/getdata', 'FinishController@operator2getdata');
Route::post('finish/operator2/grade', 'FinishController@grade');

//resource
Route::resource('warping', 'WarpingController');
Route::resource('indigo', 'IndigoController');
Route::resource('greige', 'GreigeController');
Route::resource('finish', 'FinishController');

Route::post('/finishtemp/hapus', 'FinishtempController@hapus');
Route::post('/finishtemp/truncate', 'FinishtempController@truncate');
Route::get('/finishtemp/getdata', 'FinishtempController@getdata');
Route::get('/finishtemp/export', 'FinishtempController@export');
Route::resource('finishtemp', 'FinishtempController');