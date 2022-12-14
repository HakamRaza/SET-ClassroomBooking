<?php

namespace Tests;

use App\Models\Teacher;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, 
        DatabaseTransactions;

   public function getTeacherData()
   {
     return Teacher::factory()->make()->toArray();
   }

}
