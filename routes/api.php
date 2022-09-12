<?php

use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TeacherFactoryController;
use App\Http\Controllers\TeacherResourceController;
use App\Models\ClassroomType;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
 * Teacher Route
 */
// new syntax
// Route::get('teacher', [TeacherController::class, 'index']);
// old syntax
// Route::get('teacher', 'App\Http\Controllers\TeacherController@index');
// old syntax with configured 'RouteServiceProvider.php'
// Route::get('teacher', 'TeacherController@index');
// Route::get('teacher/{id}', [TeacherController::class, 'show']);
// Route::post('teacher', [TeacherController::class, 'whatever']);
// Route::put('teacher/{id}', [TeacherController::class, 'update']);
// Route::delete('teacher/{id}', [TeacherController::class, 'destroy']);

Route::apiResource('teacher', TeacherResourceController::class)
->names('absyar');
// ->except(['destroy']); // blacklist, cant access
// ->only(['destroy']); // whitelist, can access only

// means all together :
// Route::get('teacher'
// Route::get('teacher/{id}'
// Route::post('teacher'
// Route::put('teacher/{id}'
// Route::delete('teacher/{id}'

/**
 * Teacher Factory route
 */
Route::get('factory-teacher', TeacherFactoryController::class)
->name('john-doe');

