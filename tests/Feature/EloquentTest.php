<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Categorii;
use Illuminate\Support\Facades\DB;
use Database\Seeders\FirstSeeder;

class EloquentTest extends TestCase
{
    public function setUp():void
    {
        parent::setUp();
        //DB::delete("delete from categoriess");
    }

    // public function testInsert()
    // {
    //     $category = new Categorii();

    //     $category->Nik = "gadget";
    //     $category->nama= "Gadget";
    //     $result = $category->save(); 

    //     self::assertTrue($result);

    // }
    // public function testManyInsert()
    // {
    //     $categories=[];

    //     for($i=0; $i<10;$i++)
    //     {
    //         $categories[]=
    //         [
    //             'idd'=>'ID'.$i,
    //             'name'=>'Name' .$i
    //         ];
    //     }

    //     $result = Category::query()->insert($categories); //tanpa harus membuat function dimodel

    //     self::assertTrue($result);
    //     // self::assertCount($result,10);
    // }

    public  function testUpdate()
    {
        $this->seed(FirstSeeder::class);

        $category = Categorii::find('gadget');
        $category->Nama('named updated');
        $category->update(); //bisa juga $category->save()

        self::assertTrue($category);
    }
}
