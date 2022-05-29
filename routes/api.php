<?php

use App\Http\Controllers\RequestController;
use App\Models\Lang;
use App\Models\Tag;
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

Route::get('/meals', [RequestController::class, 'fetchRequest']);
Route::get('/', function(){
    $langs = Lang::all()->pluck('lang');
    return 'Please select one of avaliable languages from the array: '.$langs.' then proceed to the route "/meals?lang=[lang_from_the_array]"';
});

