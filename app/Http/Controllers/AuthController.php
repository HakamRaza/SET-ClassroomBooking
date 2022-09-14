<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Authorise the user Teacher
     */
    public function login(Request $request)
    {
        // we want the password & username
        // validate the input from user
        $data = $request->validate([
            'name' => 'required|string|min:5',
            'password' => 'required|string',
        ]);

        // cross check with table exists
        $teacher = Teacher::where('name', $data['name'])->first();

        // check teacher exist and password matched
        if($teacher && Hash::check($data['password'], $teacher->secret)) {
            // generate token
            $token = $teacher->createToken('API Token')->plainTextToken;

            // return token to user
            return response()->json([
                'message' => 'Success login',
                'data' => [
                    'token' => $token
                ]
            ]);
        }

        // abort(404, 'Credentials do not match');

        return response()->json([
            'message' => 'Credentials do not match'
        ], 404);
        
    }


    public function logout()
    {
        // delete tokens from DB => cannot cross check => invalid token
        Auth::user()->tokens->delete();

        return "Success logout";
    }
}
