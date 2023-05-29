<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Helpers\Gdrian;

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
    $users = \App\Models\User::all();

    dd($users);
    // dd(decrypt($encrypt));
    return view('welcome');
});

Route::get('/encrypt', function() {
    return view('encrypt');
});

Route::post('/encrypt', function(Request $request) {
    $input = $request->encrypt;
    $result = Gdrian::encryptStr($input);

    return response()->json($result);
})->name('encrypt.store');

Route::post('/decrypt', function(Request $request) {
    $input = $request->input;
    $result = Gdrian::decryptStr($input);

    return response()->json($result);
})->name('decrypt.store');
