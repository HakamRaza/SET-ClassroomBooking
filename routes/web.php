<?php

use App\Models\ClassroomType;
use App\Models\User;
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

/**
 * Get list of classroom types available
 */
Route::get('classroom-type', function () {
    // Eloquent ORM
    // get all rows, array of objects
    // $data = ClassroomType::all();
    
    // get all rows, array of objects
    // $data = ClassroomType::get();
    
    // get first rows, object
    // $data = ClassroomType::first();
    
    // get based on id, object, fail return none
    // $data = ClassroomType::find(4);

    // fail return model find exception
    // $data = ClassroomType::findOrFail(5);
    
    // to get SQL query excuted
    // $data = ClassroomType::first()->toSql();

    // search using 'value', (column name, 'value')
    // $data = ClassroomType::where('type', 'recorded')->get();
    
    // search by 'half value'
    // $data = ClassroomType::where('type', 'like', '%rec%')->get();

    // get all row between range of column ids, eg: get all rows with id more/equal than 3
    $data = ClassroomType::where('id', '>=', 3)->get();

    
    /*
     * DB Query a.k.a. Query Builder
     */
    // get first row
    // $data = DB::table('classroom_types')->first();

    // sample chain query, multiple conditions
    // $data = DB::table('countries')
    //     ->where([
    //         ['id', '>', 40],
    //         ['name', 'like', '%us%']
    //     ])
    //     // ->where('id', '>', 40)
    //     // ->where('name', 'like', '%us%')
    //     ->orWhere('name', 'like', '%malaysia')
    //     ->get();


    // User::created([
    //     'name'=> "dmkamdlska",
    //     'email' => "mdkamskdlas@ffdnkf.com",
    //     'password' => "mkdmsaklmdk8u93r93h"
    // ]);

    return response()->json($data);
});