<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Exercise\Exservice;

class ExerciseTest extends TestCase
{
    private Exservice $Exservice;

    public function setUp():void
    {
        parent::setUp();
        $this->Exservice = $this->app->make(Exservice::class);
    }

    public function testT()
    {
        self::assertTrue(true);
    }
}
