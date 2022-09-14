<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    /**
     * Return list of teachers
     */
    public function index()
    {
        $data = Teacher::all();

        return response()->json($data);
    }

    /**
     * Get a specific teacher from id
     */
    public function show($id)
    {
        return Teacher::findOrFail($id);
    }

    /**
     * Add new teacher
     */
    public function whatever(Request $request)
    {
        // $request['secret'] = Hash::make($request->secret);

        Teacher::create($request->all());

        $data = Teacher::all();

        return response()->json($data);
    }

    /**
     * Update existing teacher by his/her id
     */
    public function update($id, Request $lala)
    {
        // select the specific teacher based on id
        $teacher = Teacher::findOrFail($id);

        // update the info given in payload to that teacher
        // $teacher->update($lala->all());

        return tap($teacher)->update($lala->all());

        // return updated teacher's information
        // return $teacher;
    }

    /**
     * Delete an existing teacher
     */
    public function destroy($id)
    {
        $teacher = Teacher::findOrFail($id);
        $teacher->delete();
    
        return response()->json('Deleted Teacher: '. $id, 204);
    }
}
