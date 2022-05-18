<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/factory', function(Request $request){
    $validated = $request->validate([
        'per_page' => 'integer',
        'page' => 'integer',
        'category' => 'integer',
        'tags' => 'integer',
        'with' => 'string | max:255',
        'lang' => 'string',
    ]);
});
