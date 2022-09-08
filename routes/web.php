<?php

use Illuminate\Http\Request;
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

    return view('page.original_welcome'); //HTML
    // return response()->json([
    //     "key" => "this is attribute"
    // ]); //JSON
});

Route::view('page-2','page.modified_welcome');
Route::view('page-3', 'page.email_welcome');

Route::get('page-4', function(Request $hoho) {
    // dd($hoho);
    // get input from request, convert to array
    $data = $hoho->all();

    // access array by key
    $var3 = $data['var3'] ?? 0;
    $var4 = $data['var4'] ?? 0;

    // dd($var3, $var4);

    $var1 = $var3;
    $var2 = $var4;

    return view('page.modified_welcome', [
        "totalSum" => $var1 * $var2
    ]);

})->name('test');

Route::get('/student-list', function() {
    
    $data =  DB::select('SELECT * FROM students');

    return response()->json($data);
});
