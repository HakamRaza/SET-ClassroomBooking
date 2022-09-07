<?php

use Illuminate\Support\Facades\DB;
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

    // dump('web.php');

    // abort(404); // HTML

    return view('welcome'); //HTML
    return response()->json([
        "key" => "this is attribute"
    ]); //JSON
});

Route::get('/student-list', function() {
    
    $data =  DB::select('SELECT * FROM students');

    return response()->json($data);
});
