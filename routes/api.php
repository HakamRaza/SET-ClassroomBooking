<?php

use App\Models\ClassroomType;
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
