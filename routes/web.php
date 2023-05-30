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
    return view('welcome');
});

Route::post('/encrypt', function(Request $request) {
    $key = $request->key;
    $value = $request->encrypt;

    $result = Gdrian::encryptStr($value);

    // Read the existing .env file
    $envPath = base_path('.env');
    $envFile = file_get_contents($envPath);

    // Replace the existing value or add a new key-value pair
    $envFile = preg_replace("/^$key=.*$/m", "$key=$result", $envFile, -1, $count);

    // If the key-value pair doesn't exist, add it to the end of the file
    if ($count === 0) {
        $envFile .= "\n$key=$result";
    }

    // Save the updated .env file
    file_put_contents(base_path('.env'), $envFile);

    return response()->json($result);
})->name('encrypt.store');

Route::post('/decrypt', function(Request $request) {
    $input = $request->input;
    $result = Gdrian::decryptStr($input);

    return response()->json($result);
})->name('decrypt.store');
