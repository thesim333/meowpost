<?php

use App\Http\Controllers\MeowController;
use App\Http\Controllers\TermsController;
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
})->middleware(['auth', 'agreed.terms'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('/user/meows/create', [MeowController::class, 'create'])->name('newMeow');
Route::get('/meows', [MeowController::class, 'index'])->name('meows');
Route::get('/user/my-meows', [MeowController::class, 'showCurrentUser'])->name('myMeows');
Route::post('/api/meows', [MeowController::class, 'store'])->name('makeMeow');
Route::get('/user/meow/{id}', [MeowController::class, 'edit'])->name('editMeow');
Route::put('/user/meow/{id}', [MeowController::class, 'update'])->name('updateMeow');

Route::get('/user/terms', [TermsController::class, 'index'])->name('terms');
Route::post('/user/terms', [TermsController::class, 'store'])->name('agreeTerms');
