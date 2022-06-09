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
    return "Hey, welcome! <br/> I did my best to do this so I hope you somewhat enjoy exploring this code, in case you have any questions feel free to email me or call me :)
    <br/>
    Now please procceed to the route 'localhost:port/api' and go on from there. Thank you for your time!
    Note: I just came from work and it's almost 3 am when I'm doing this, but I did my best to make things work,
    Also a note:
    You'll probably be reading this, and we haven't met or talked directly, but I want to just let you know that, I honestly really appreciate the amnout of effort
    that you've put into testing, and especially your reviews because due to them I've learned so much. Al dosta s engleskim, ako išta, bar dugujem rundu, dvije :)
    ";
});