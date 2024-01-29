<?php

namespace Tests\Feature;

use App\Services\UserServices;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
class Userservicetest extends TestCase
{
    private UserServices $UserService;

    protected function setUp():void 
    {
        parent::setUp();
        $this->UserService = $this->app->make(UserServices::class);
    }
    

    public function test()
    {
        self::assertTrue(true);
    }

    // public function testlog()
    // {
    //     self::assertTrue($this->UserService)
    // }
    
}
