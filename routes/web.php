<?php

use App\Http\Controllers\MeowController;
use App\Models\Meow;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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

Route::get('/user/meows/create', [MeowController::class, 'getCreateView'])->name('newMeow');
Route::get('/meows', [MeowController::class, 'getMeowsView'])->name('meows');
Route::get('/user/my-meows', [MeowController::class, 'getUserMeowsView'])->name('myMeows');
Route::post('/api/meows', [MeowController::class, 'create'])->name('makeMeow');
Route::get('/user/terms', function () {
    return view('terms-agree');
})->middleware('auth');
Route::post('/user/terms', function (Request $request) {
    if ($request->agree == true) {
        Auth::user()->agreed_terms = now();
        Auth::user()->save();

        return redirect('/meows');
    }
    return back();
})->middleware('auth')->name('agreeTerms');
