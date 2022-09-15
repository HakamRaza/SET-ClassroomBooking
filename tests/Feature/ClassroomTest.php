<?php

namespace Tests\Feature;

use App\Models\Attachment;
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

    public function test_teacher_can_create_classroom_with_attachment()
    {
        // generate classroom data
        $class = Classroom::factory()->make();
        $attachment = Attachment::factory()->make();
        
        // combine array data
        $payload = array_merge($class->toArray(), $attachment->toArray());

        // check detail classroom return with attachment if exist
        $this   ->postJson('api/classroom', $payload)
                ->assertJson([
                    "data" => [
                        'teacher_name' => $this->teacher->name,
                        'topic' => $class->name,
                        'attachment' => $attachment->uri
                    ]
                ]);
        
        // check uri is save inside Attachment table
        $this->assertDatabaseCount(Attachment::class, 1);
    }

    public function test_teacher_can_create_classroom_without_attachment()
    {
        // generate classroom data
        $class = Classroom::factory()->make();
        
        // check detail classroom return with attachment not exist
        $this   ->postJson('api/classroom', $class->toArray())
                ->assertJson([
                    "data" => [
                        'teacher_name' => $this->teacher->name,
                        'topic' => $class->name,
                        'attachment' => null
                    ]
                ]);
        
        // check nothing save inside Attachment table
        $this->assertDatabaseCount(Attachment::class, 0);
    }

    public function test_teacher_can_update_existing_classroom_attachment()
    {
        $class = Classroom::factory()->for($this->teacher)->create();
        $attachment = Attachment::factory()->for($class)->create();
        $newAttachment = Attachment::factory()->make();

        $this   ->putJson('api/classroom/' . $class->id, $newAttachment->toArray())
                ->assertJson([
                    "data" => [
                        'teacher_name' => $this->teacher->name,
                        'topic' => $class->name,
                        'attachment' => $newAttachment->uri
                    ]
                ]);
        $this->assertDatabaseMissing(Attachment::class, [
            'classroom_id' => $class->id,
            'uri' => $attachment->uri
        ]);

        $this->assertDatabaseHas(Attachment::class, [
            'classroom_id' => $class->id,
            'uri' => $newAttachment->uri
        ]);
    }
}
