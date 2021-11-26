<?php

use App\Http\Controllers\Admin\BidangController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GedungController;
use App\Http\Controllers\Admin\HistoryController;
use App\Http\Controllers\Admin\KendaraanController;
use App\Http\Controllers\Admin\LuasTanahController;
use App\Http\Controllers\Admin\MutasiKendaraanController;
use App\Http\Controllers\Admin\MutasiTanahController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\PinjamKendaraanController;
use App\Http\Controllers\Admin\PinjamTanahController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SubUnitController;
use App\Http\Controllers\Admin\UnitController;
use App\Http\Controllers\Admin\UpbController;
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

Auth::routes(['register' => false]);
Route::prefix('admin')->group(function () {

    Route::group(['middleware' => 'auth'], function(){

        //dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard.index');
        //  tanah
        Route::resource('/tanah', LuasTanahController::class,['except' => ['show'] ,'as' => 'admin']);
        // Tanah PDF
        Route::get('/tanah/pdf',[LuasTanahController::class,'TanahPdf'])->name('admin.tanah.pdf');
          // Tanah Excel
        Route::get('/tanah/excel',[LuasTanahController::class,'TanahExcel'])->name('admin.tanah.excel');
        
        // Pinjam  tanah
        Route::resource('/pinjam-tanah', PinjamTanahController::class,['except' => ['show'] ,'as' => 'admin']);
        route::POST('/pinjam-tanah/kembali-tanah/{id}',[PinjamTanahController::class,'kembaliTanah'])->name('kembali-tanah');
        
        Route::resource('/gedung', GedungController::class,['except' => ['show'] ,'as' => 'admin']);
        //    Kendaraan
        Route::resource('/kendaraan', KendaraanController::class,['except' => ['show'] ,'as' => 'admin']);
        // Pinjam Kendaraan
        Route::resource('/pinjam-kendaraan', PinjamKendaraanController::class,['except' => ['show'] ,'as' => 'admin']);
        route::POST('/pinjam-kendaraan/kembali-kendaraan/{id}',[PinjamKendaraanController::class,'kembaliKendaraan'])->name('kembali-tanah');

        // Mutasi Tanah
        Route::resource('/mutasi-tanah', MutasiTanahController::class,['except' => ['show'] ,'as' => 'admin']);

        // Mutasi kendaraan
        Route::resource('/mutasi-kendaraan', MutasiKendaraanController::class,['except' => ['show'] ,'as' => 'admin']);

        //permissions
        Route::resource('/permission', PermissionController::class, ['except' => ['show',  'delete'] ,'as' => 'admin']);
        //roles
        Route::resource('/role', RoleController::class, ['except' => ['show'] ,'as' => 'admin']);

        //users
        Route::resource('/user', UserController::class, ['except' => ['show'] ,'as' => 'admin']);
        //users
        Route::resource('/history', HistoryController::class, ['except' => ['show'] ,'as' => 'admin']);
        // Setting akun
        Route::get('/setting-akun', [UserController::class,'Setting'])->name('setting-akun');
        Route::PUT('/update-akun/{id}', [UserController::class,'UpdateAkun'])->name('update-akun');

        Route::resource('/bidang', BidangController::class, ['except' => ['show'] ,'as' => 'admin']);
        Route::resource('/units', UnitController::class, ['except' => ['show'] ,'as' => 'admin']);
        Route::resource('/subunit', SubUnitController::class, ['except' => ['show'] ,'as' => 'admin']);
        Route::resource('/upb', UpbController::class, ['except' => ['show'] ,'as' => 'admin']);

    });

});
