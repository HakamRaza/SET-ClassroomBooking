<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddTeacherRequest;
use App\Http\Resources\TeacherResource;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

/**
 * Naming supposely 'TeacherController'
 */
class TeacherResourceController extends Controller
{
    /**
     * Display a listing of teacher
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Teacher::all();

        return response()->json(TeacherResource::collection($data));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddTeacherRequest $request)
    {
        // $request['secret'] = Hash::make($request->secret);
        $teacher = Teacher::create($request->all());

        // assign 'Admin' role to teacher
        $teacher->assignRole(["Admin", "Teacher", "Super Admin"]);

        // $data = Teacher::all();
        
        return response()->json($teacher);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // view own data
        $teacher = Teacher::findOrFail($id);
        
        $this->authorize('view', $teacher);

        return $teacher;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'string|required'
        ],[
            'name.required' => "Nama diperlukan"
        ]);
        
        // select the specific teacher based on id
        $teacher = Teacher::findOrFail($id);

        $this->authorize('update', $teacher);

        // update the info given in payload to that teacher
        // $teacher->update($lala->all());

        return tap($teacher)->update($data);

        // return updated teacher's information
        // return $teacher;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $teacher = Teacher::findOrFail($id);
        $teacher->delete();
    
        return response()->json('Deleted Teacher: '. $id, 204);
    }
}
