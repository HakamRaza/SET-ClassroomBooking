<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Http\Requests\StoreClassroomRequest;
use App\Http\Requests\UpdateClassroomRequest;
use App\Http\Resources\ClassroomResource;
use Illuminate\Support\Facades\Auth;

/**
 * Exclusive login user Teacher
 */
class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return only class belong to me (as a Teacher)
        $myClass = Auth::user()->classrooms;

        return ClassroomResource::collection($myClass);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreClassroomRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClassroomRequest $request)
    {
        // $class = Classroom::create($request->all());
        
        $class = Auth::user()->classrooms()->create($request->except('uri'));
        
        // check exist
        if($request->has('uri')){
            // then create attachment using class instance
            $class->attachment()->create($request->only('uri'));
        }

        return new ClassroomResource($class);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function show(Classroom $classroom)
    {
        if($classroom->teacher_id == Auth::id()){

            return new ClassroomResource($classroom);
        }
        abort(403);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateClassroomRequest  $request
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClassroomRequest $request, Classroom $classroom)
    {
        if($classroom->teacher_id == Auth::id()){

            $classroom->update($request->except('uri'));
            
            // check payload has uri
            if($request->has('uri')){
                // update or create if not exist
                // $classroom->attachment()->updateOrCreate(
                //     ['classroom_id' => $classroom->id],
                //     $request->only('uri')
                // );
                
                // or like this
                $classroom->attachment()->update(
                    $request->only('uri')
                );
            }
            
            return new ClassroomResource($classroom);
        }
        
        abort(403);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function destroy(Classroom $classroom)
    {
        if($classroom->teacher_id == Auth::id()){
            $classroom->delete();

            return response()->json(null, 204);
        }
        abort(403);
    }
}
