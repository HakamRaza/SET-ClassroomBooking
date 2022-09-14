<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TeacherFactoryController;
use App\Http\Controllers\TeacherResourceController;
use App\Http\Middleware\IsAdminExistMiddleware;
use App\Http\Resources\TeacherResource;
use App\Models\ClassroomType;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;

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
->names('absyar')->middleware('auth:sanctum');
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

/**
 * Auth Route
 */
Route::post('teacher-login', [AuthController::class, 'login']);
Route::post('teacher-logout', [AuthController::class, 'logout']);


Route::get('auth', function(){
    
    // get teacher id
    // dd(Auth::id()); 
    
    // get teacher model instance
    dd(Auth::user());

    // user is login, and has role Admin or Teacher
})->middleware(['auth:sanctum', 'role:Admin|Teacher']);


Route::get('permission-to-role', function() {
    // seed permission 'teacher:edit', 'teacher:delete'
    // php artisan permission:create-permission "teacher:delete"
    // php artisan permission:create-permission "teacher:edit"

    // extract the target role
    $role = Role::findByName('Admin');

    // give permission to role
    $role->givePermissionTo(['teacher:edit', 'teacher:delete']);

    return $role;
});

Route::get('permission-test', function(){
    
    return 'success';
})->middleware(['permission:teacher:edit|teacher:delete']);


/**
 * Test middleware to check inside request has 'isAdmin' key
 */
Route::post('middleware-test', function(Request $request){

    return "User is : " . $request->has('isAdmin');

})->middleware('is_admin');
// })->middleware(IsAdminExistMiddleware::class);

// Route::group(function(){
//     // specific route to exclude middleware
//     Route::get('/')->withoutMiddleware(['is_admin']);

//     // all other route will use 'is_admin' middleware
//     Route::post('/');

// })->middleware('is_admin');


Route::get('all-teachers', function()
{
    $teachers = Teacher::all();

    return response()->json(TeacherResource::collection($teachers));
});

Route::get('one-teacher', function()
{
    $teacher = Teacher::first();
    
    $teacher['pass_data'] = "This pass data";

    return response()->json(new TeacherResource($teacher));
});
