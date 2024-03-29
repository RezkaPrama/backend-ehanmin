<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FileUsulanController;
use App\Http\Controllers\Admin\FileUsulanDetailController;
use App\Http\Controllers\Admin\InputUsulanController;
use App\Http\Controllers\Admin\JenisKenaikanController;
use App\Http\Controllers\Admin\SatuanController;
use App\Http\Controllers\Admin\UserController;
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

Route::get('/', function () {
    return view('auth.login');
});

//group route with prefix "admin"
Route::prefix('admin')->group(function () {

    //group route with middleware "auth"
    Route::group(['middleware' => 'auth'], function () {

        //route dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard.index');

        //route User
        Route::resource('/user', UserController::class, ['as' => 'admin']);
        Route::get('/user/{userId}', [UserController::class, 'showImage'])->name('admin.user.showImage');
        Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('admin.user.getEdit');

        //route Satuan
        Route::resource('/satuan', SatuanController::class, ['as' => 'admin']);

        // route jenis kenaikan pangkat
        Route::resource('/jenis_kp', JenisKenaikanController::class, ['as' => 'admin']);

        //route input usulan 
        Route::resource('/trans', InputUsulanController::class, ['as' => 'admin']);
        Route::post('/trans/fetchDetail', [InputUsulanController::class, 'fetchDetail'])->name('admin.trans.fetchDetail');
        Route::get('/trans/filter', [InputUsulanController::class, 'filter'])->name('admin.trans.filter');
        Route::get('/trans/updateStatus/{id}', [InputUsulanController::class, 'updateStatus'])->name('admin.trans.updateStatus');
        Route::get('/trans/approve/{id}', [InputUsulanController::class, 'approve'])->name('admin.trans.approve');
        Route::get('/trans/decline/{id}', [InputUsulanController::class, 'decline'])->name('admin.trans.decline');
        Route::get('/trans/exportExcel/{userid}', [InputUsulanController::class, 'exportExcel'])->name('admin.trans.exportExcel');
        Route::delete('/trans/{id}/{userid}/{name}', [InputUsulanController::class, 'destroy'])->name('admin.trans.delete');

        //route File usulan detail 
        Route::post('/fileUsulanDetail/upload', [FileUsulanDetailController::class, 'upload'])->name('admin.fileUsulanDetail.upload');
        Route::post('/fileUsulanDetail/uploadCreate', [FileUsulanDetailController::class, 'uploadCreate'])->name('admin.fileUsulanDetail.uploadCreate');
        Route::get('/fileUsulanDetail/{userid}/{filename}/{name}/download', [FileUsulanDetailController::class, 'downloadFile'])->name('admin.fileUsulanDetail.download');
        Route::get('/fileUsulanDetail/preview/{filename}/{userid}/{name}', [FileUsulanDetailController::class, 'previewPDF'])->name('admin.fileUsulanDetail.previewPDF');
        Route::get('/fileUsulanDetail/destroy/{nama_file}/{userid}/{name}', [FileUsulanDetailController::class, 'destroy'])->name('admin.fileUsulanDetail.destroy');

        // route manajemen file
        Route::resource('/manageFile', FileUsulanController::class, ['as' => 'admin']);
    });
});
