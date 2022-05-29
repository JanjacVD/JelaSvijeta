<?php

use App\Http\Controllers\RequestController;
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

Route::get('/', function(){
    return 'Hey, welcome! <br/> I did my best to do this so I hope you somewhat enjoy exploring this code, in case you have any questions feel free to email me or call me :)
    <br/>
    Now please procceed to the route "localhost:port/api" and go on from there. Thank you for your time!
    ';
});