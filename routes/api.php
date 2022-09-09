<?php

use App\Models\ClassroomType;
use App\Models\Teacher;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::post('classroom-type', function(Request $hehe) {

    // dd($hehe->all());
    // ClassroomType::create($hehe->all());
    ClassroomType::create();
    // $class = new ClassroomType();
    // $class->type = $hehe->type;
    // $class->save();

    return ClassroomType::all();

    // return "bdhasbdshj";
});


/**
 * Return list of teachers
 */
Route::get('teacher', function(){
    $data = Teacher::all();

    return response()->json($data);
});

/**
 * Add new teacher
 */
Route::post('teacher', function(Request $request){

    Teacher::create($request->all());

    $data = Teacher::all();

    return response()->json($data);
});

/**
 * Update existing teacher by his/her id
 */
Route::put('teacher/{id}', function($id, Request $lala){

    // select the specific teacher based on id
    $teacher = Teacher::findOrFail($id);

    // update the info given in payload to that teacher
    // $teacher->update($lala->all());

    return tap($teacher)->update($lala->all());

    // return updated teacher's information
    // return $teacher;
});

/**
 * Delete an existing teacher
 */
Route::delete('teacher/{id}', function($id){
    $teacher = Teacher::findOrFail($id);
    $teacher->delete();

    return response()->json('Deleted Teacher: '. $id, 204);
});

