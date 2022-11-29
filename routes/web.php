<?php

use App\Http\Controllers\CommuneController;
use App\Http\Controllers\EtabController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\PreinscriptionController;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\TuteurController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();


Route::group(
    ['middleware' => 'auth'], function ()
    {
        Route::resource('/users', User::class);
        Route::get('/', [HomeController::class, 'index'])->name('home');
        Route::get('/home', [HomeController::class, 'index'])->name('home2');

        // Route::get('/etabs/notpayed/', [EtabController::class, 'notpayed'])->name('etabs.notpayed');
        // Route::get('/etabs/findnotpayed/', [EtabController::class, 'findnotpayed'])->name('etabs.findnotpayed');
        Route::resource('/etabs', EtabController::class);
        // Route::post('/etabs/import', [EtabController::class, 'import'])->name('etabs.import');
        // Route::post('/etabs/search', [EtabController::class, 'search'])->name('etabs.search');
        // Route::post('/etabs/uploadavatar', [EtabController::class, 'uploadavatar'])->name('etabs.uploadavatar');
        Route::get('etabs/{id}/print/{doc}', [EtabController::class, 'print'])->name('etabs.print');
        // Route::post('/etabs', [EtabController::class, 'index'])->name('etabs.index');
        // Route::get('/etabs/create', [EtabController::class, 'create'])->name('etabs.create');
        // Route::get('/etabs/{id}/edit', [EtabController::class, 'edit'])->name('etabs.edit');
        // Route::get('/etabs/{id}/destroy', [EtabController::class, 'destroy'])->name('etabs.destroy');

        Route::post('communes/getcommunes',[CommuneController::class, 'getcommunes'])->name('communes.getcommunes');

        Route::resource('provinces',ProvinceController::class);
        Route::post('provinces/import', [ProvinceController::class, 'import'])->name('provinces.import');

        Route::resource('users', UserController::class);
        Route::get('users/{id}/print/{doc}', [UserController::class, 'print'])->name('users.print');
        Route::post('/users/uploadavatar', [UserController::class, 'uploadavatar'])->name('users.uploadavatar');

        Route::get('/home', [HomeController::class, 'index'])->name('settings');

    }
);
