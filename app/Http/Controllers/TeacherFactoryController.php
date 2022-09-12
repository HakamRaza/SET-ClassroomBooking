<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherFactoryController extends Controller
{
    private $var;

    /**
     * Initialise something at class
     * can be middlware, variable, service class
     */
    public function __construct()
    {
        $this->var = "Initialise variable";
    }

    /**
     * Get random generated Teacher
     */
    public function __invoke()
    {
        // generate only
        $generated = Teacher::factory()->upTheNameLol()->make();

        // generate and save to DB
        // $generated = Teacher::factory()->create();
        // return $generated;
        
        // will return 'Initialise variable' to user
        return $this->var;

    }
}
