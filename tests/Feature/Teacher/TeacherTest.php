<?php

namespace Tests\Feature\Teacher;

use App\Models\ClassroomType;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TeacherTest extends TestCase
{
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
}
