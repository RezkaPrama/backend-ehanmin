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


        //route Satuan
        Route::resource('/satuan', SatuanController::class, ['as' => 'admin']);

        // route jenis kenaikan pangkat
        Route::resource('/jenis_kp', JenisKenaikanController::class, ['as' => 'admin']);

        //route input usulan 
        Route::resource('/trans', InputUsulanController::class, ['as' => 'admin']);
        Route::get('/trans/updateStatus/{id}', [InputUsulanController::class, 'updateStatus'])->name('admin.trans.updateStatus');
        Route::get('/trans/approve/{id}', [InputUsulanController::class, 'approve'])->name('admin.trans.approve');
        Route::get('/trans/decline/{id}', [InputUsulanController::class, 'decline'])->name('admin.trans.decline');

        //route File usulan detail 
        Route::post('/fileUsulanDetail/upload', [FileUsulanDetailController::class, 'upload'])->name('admin.fileUsulanDetail.upload');
        Route::get('/fileUsulanDetail/{userid}/{filename}/download', [FileUsulanDetailController::class, 'downloadFile'])->name('admin.fileUsulanDetail.download');
        Route::get('/fileUsulanDetail/preview/{filename}/{userid}', [FileUsulanDetailController::class, 'previewPDF'])->name('admin.fileUsulanDetail.previewPDF');
        Route::get('/fileUsulanDetail/destroy/{id}/{userid}', [FileUsulanDetailController::class, 'destroy'])->name('admin.fileUsulanDetail.destroy');

        // route manajemen file
        Route::resource('/manageFile', FileUsulanController::class, ['as' => 'admin']);
    });
});
