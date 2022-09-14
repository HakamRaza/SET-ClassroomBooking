<?php

namespace Tests\Feature;

use App\Models\Classroom;
use App\Models\Teacher;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;
use Illuminate\Support\Arr;

class ClassroomTest extends TestCase
{
    public function setUp():void
    {
        parent::setUp();

        // create a teacher
        $this->teacher = Teacher::factory()->create();
        $this->teacherB = Teacher::factory()->create();

        Sanctum::actingAs($this->teacher);
    }

    public function test_can_get_all_classroom_list()
    {
        //seed classroom using relation 'teacher belongsTo'
        Classroom::factory(10)->for($this->teacher)->create();
        Classroom::factory(10)->for($this->teacherB)->create();
        
        // call api endpoint
        $this   ->getJson('api/classroom')
                // it is a collection
                ->assertJson([
                    "data" => [
                        [
                            "teacher_name" => $this->teacher->name,
                            "category_name" => "live"
                        ]
                    ]
                ])
                ->assertJsonCount(10, "data");
    }


    public function test_teacher_can_create_new_classroom()
    {
        // generate random fake classroom data
        $class = Classroom::factory()->make();
        
        // call store endpoint and pass data
        $this   ->postJson('api/classroom', $class->toArray())
                // it is a object
                ->assertJson([
                    "data" => [
                        "topic" => $class->name,
                        "teacher_name" => $this->teacher->name,
                    ]
                ]);
    }


    public function test_teacher_can_update_existing_classroom()
    {
        $class = Classroom::factory()->for($this->teacher)->create(['name' => "Whatever"]);

        $this   ->putJson('api/classroom/' . $class->id, [
                    'name' => 'Uga Bung ga'
                ])
                ->assertJson([
                    "data" => [
                        "topic" => 'Uga Bung ga'
                    ]
                ]);

        $this->assertDatabaseHas(Classroom::class, [
            'teacher_id' => $this->teacher->id,
            'name' => "Uga Bung ga"
        ]);
    }

    public function test_teacher_can_view_existing_classroom()
    {
        $class = Classroom::factory()->for($this->teacher)->create();

        $this   ->getJson('api/classroom/' . $class->id)
                ->assertJson([
                    "data" => [
                        "topic" => $class->name
                    ]
                ]);
    }

    public function test_teacher_can_delete_classroom()
    {
        $class = Classroom::factory()->for($this->teacher)->create();

        $this   ->deleteJson('api/classroom/' . $class->id)
                ->assertStatus(204);

        $this->assertDatabaseMissing(Classroom::class, [
            'teacher_id' => $this->teacher->id,
            'name' => $class->name
        ]);
    }
}
