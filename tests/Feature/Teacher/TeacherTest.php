<?php

namespace Tests\Feature\Teacher;

use App\Http\Requests\AddTeacherRequest;
use App\Models\ClassroomType;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class TeacherTest extends TestCase
{
    public function checkInput($payload):bool
    {
        return Validator::make(
            // your payload array
            $payload, 
            //extract rules array from class
            (new AddTeacherRequest())->rules()
            // app()->call([AddTeacherRequest::class, 'rules']), 
        )
        // stop on first rule fail method
        ->stopOnFirstFailure()
        // true if validation pass method
        ->passes();
    }


    public function test_all_validation()
    {
        // check should pass validation
        $this->assertEquals($this->checkInput([
            'name' => 'Walalalal',
            'secret' => 'password123'
        ]), true);

        // check should not pass validation
        $this->assertEquals($this->checkInput([
            'name' => 'Walalala',
            'secret' => ''
        ]), false);

        // $this-> other validation
        // $this-> other validation
        // $this-> other validation
        // $this-> other validation
    }



    /**
     * Test we can get teacher list
     */
    public function test_get_teacher_list()
    {
        // make request
        $response = $this->getJson('api/teacher');

        // to check response
        $response
            // check HTTP Code
            ->assertStatus(200)
            // check response JSON
            ->assertJson([]) 
            // check response JSON 'data' count
            ->assertJsonCount(0); 
            // ->assertExactJson(); //strict check

        // check data inside DB
        $this->assertDatabaseHas(ClassroomType::class, [
            'id' => 1,
            'type' => 'live'
        ]);
    }

    public function test_can_register_teacher()
    {
        // $teacher = Teacher::factory()->make()->toArray();
        $teacher = $this->getTeacherData();

        $response = $this->postJson('api/teacher', $teacher);

        $response
            ->assertOk();

        $this->assertDatabaseHas(Teacher::class, [
            'name' => $teacher['name']
        ]);
    }

    // public function test_add_teacher_name_validation_fail()
    // {
    //     $response = $this->postJson('api/teacher', [
    //         'name' => 12738917289, // suppose string
    //         'secret' => 'password123'
    //     ]);

    //     // validation fail code 422
    //     $response
    //     ->assertStatus(422)
    //     ->assertJson([
    //         "message" => "The given data was invalid.",  
    //         "errors" => [
    //             "name" => [
    //                 "Hey, your name is UN acceptable !!"
    //             ]
    //         ]
    //     ]);
    // }

    // public function test_add_teacher_password_fail()
    // {
    //     $response = $this->postJson('api/teacher', [
    //         'name' => 'Walala bin Ra', // suppose string
    //         'secret' => ''
    //     ]);

    //     // validation fail code 422
    //     $response
    //     ->assertStatus(422)
    //     ->assertJson([
    //         "message" => "The given data was invalid.",  
    //         "errors" => [
    //             "secret" => [
    //                 "The secret field is required."
    //                 // "The secret must be a string.",
    //                 // "The secret must only contain letters and numbers.",
    //                 // "The secret must be at least 5 characters."
    //             ]
    //         ]
    //     ]);
    // }
}
