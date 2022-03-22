<?php

use App\Http\Controllers\MeowController;
use App\Models\Meow;
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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('/users/{id}/meows/create', [MeowController::class, 'getCreateView']);
Route::get('/users/{id}/meows/create', [MeowController::class, 'getCreateView']);
