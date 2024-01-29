<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoggingTest extends TestCase
{
   public function testLog()
   {
    Log::info("hello");
    Log::warning("hello");
    Log::error("hello error");
    Log::critical("hello critical");

    self::assertTrue(true);
   }

   public function testContext()
   {
      Log::info("hello context",["user"=>"asep"]);
      self::assertTrue(true);
   }

   public function testwithContext()
   {
      Log::withContext(["user"=>"asep"]);
      Log::info("hello");
      Log::warning("hello");
      Log::error("hello error");
      Log::critical("hello critical");

      //ini untuk selected chanel

      $selectedChannel = Log::channel('stderr');
      $selectedChannel->error("hello error sc");

      self::assertTrue(true);
      
   }

   public function testHandler()
   {
      $sc =Log::channel('file');
      $sc->withContext(["user"=>"asepm"]);
      $sc->info("hello");
      $sc->warning("hello");
      $sc->error("hello error");
      $sc->critical("hello critical");

      self::assertTrue(true);
   }
}
