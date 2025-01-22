<?php
use Inertia\Inertia;
use App\Http\Controllers\PromoController;
use Illuminate\Support\Facades\Route;

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

//Route::get('{any?}', fn () =>view('app'))->where('any', '.*');

Route::get('/', PromoController::class);
Route::get('/create',[PromoController::class, 'create']);
Route::post('/promos', [PromoController::class, 'store']);
