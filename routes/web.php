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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/users/{id}/meows/create', function ($id) {
    if (is_numeric($id) != 1) {
        return response('Unknown user id', 403);
    }

    return view('create_meow', ['id' => $id]);
});