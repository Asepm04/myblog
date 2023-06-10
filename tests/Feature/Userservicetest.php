<?php

namespace Tests\Feature;

use App\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
class Userservicetest extends TestCase
{
    private UserService $UserService;

    protected function setUp():void 
    {
        parent::setUp();
        $this->UserService = $this->app->make(UserService::class);
    }
    

    public function test()
    {
        self::assertTrue(true);
    }
    
}
