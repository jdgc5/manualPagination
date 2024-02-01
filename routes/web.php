<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\DiskController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\PaisController;
use App\Http\Controllers\PaginateArtistController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::resource('movie', MovieController::class);
Route::get('movie/view/{id}', [MovieController::class, 'view'])-> name ('movie.view');
Route::get('disk/view/file/fotosubida.jpg', [DiskController::class,'view'])->name('disk.view');

Route::get('setting', [SettingController::class, 'index'])-> name ('setting.index');
Route::put('setting', [SettingController::class, 'update'])-> name ('setting.update');
Route::get('setting/showSelect', [SettingController::class,'showSelect']) -> name ('setting.showSelect');

Route::resource('artist', ArtistController::class);
Route::resource('disk', DiskController::class);
Route::get('disk/create/{idartist}',[DiskController::class,'createArtist'])->name('disk.create.Artist');
Route::get('pais',[PaisController::class,'index'])->name('pais.index');

Route::resource('paginateartist', PaginateArtistController::class);
Route::get('paginateartist2', [PaginateArtistController::class,'index2'])->name('paginateartist.index2');

