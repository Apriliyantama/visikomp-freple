<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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
    return view('home');
});

Route::post('/upload', function (Request $request){
    $path = $request->file('image')->store('uploads', 'public');
    return view ('result', ['image' => $path]);
})->name('upload');

Route::get('/sample', function() {
    return response()->download(public_path('images/sample.png'));
})->name('sample.download');