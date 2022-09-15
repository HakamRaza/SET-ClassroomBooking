<?php

namespace Tests\Feature;

use App\Models\Profile;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    public function test_teacher_can_create_profile()
    {
        $teacher = Teacher::factory()->create();

        // controller supposely + route :P
        $teacher->profile()->create([
            'fullname' => 'Teacher A',
            'dob' => now()->subYears(20)->toDateString()
        ]);

        $this->assertDatabaseHas(Profile::class, [
            'profileable_id' => $teacher->id,
            'fullname' => 'Teacher A',
            'dob' => now()->subYears(20)->toDateString()
        ]);
    }

    public function test_student_can_create_profile()
    {
        $student = Student::factory()->create();

        // controller supposely + route :P
        $student->profile()->create([
            'fullname' => 'Student B',
            'dob' => now()->subYears(10)->toDateString()
        ]);

        $this->assertDatabaseHas(Profile::class, [
            'profileable_id' => $student->id,
            'fullname' => 'Student B',
            'dob' => now()->subYears(10)->toDateString()
        ]);
    }
}
