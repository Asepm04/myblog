<?php

namespace Tests\Feature;
use App\Testt\TestService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TestProvidertest extends TestCase
{
    private TestService $TestService;

    public function setUp():void
    {
        parent::setUp();
        $this->TestService = $this->app->make(TestService::class);
    }

    public function test()
    {
        //ini test login 
        self::assertTrue($this->TestService->login("asep","mulyadi"));

        //test wrong user
        self::assertFalse($this->TestService->login("alamat","mulyadi"));

        //test wrong password
        self::assertFalse($this->TestService->login("asep","salah"));
    }
}


