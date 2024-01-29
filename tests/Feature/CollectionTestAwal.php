<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Services\Person;
use Illuminate\Support\LazyCollection;

class CollectionTestAwal extends TestCase
{
    public function testColl()
    {
        $collection = collect([1,2,3]);
        $this->assertEqualsCanonicalizing([1,2,3],$collection->all());
    }

    public function testCollectionawal()
    {
        $collection = collect(1,2,3,4,5,6,7);

        foreach($collection as $key => $value)
        {
            $this->assertEquals($key+1,$value);
        }
    }

    public function testManipulasiCollection()
    {
        $collection = collect([]);
        $collection->push(1,2,3);

        $this->assertEqualsCanonicalizing([1,2,3],$collection->all());

        $result = $collection->pop();

        $this->assertEquals(3,$result);

        $this->assertEqualsCanonicalizing([1,2],$collection->all());

        $prependd = $collection->prepend(4);
        $this->assertEqualsCanonicalizing([4,1,2],$collection->all());
        
        $pull = $collection->pull(0);
        $this->assertEquals(4,$pull);
        $this->assertEqualsCanonicalizing([1,2],$collection->all());

        $put = $collection->put(2,9);
        $this->assertEqualsCanonicalizing([1,9],$collection->all());
    }

    public function tesMap()
    {
        $collection = collect([1,2,3]);
        $result = $collection->map(function($item)
    {
        return $item*2;
    });

    $this->assertEqualsCanonicallizing([2,4,6],$result->all());


    }

    public function testMapInto()
    {
        $collection = collect(["asep"]);
        $result = $collection->mapInto(Person::class);

        $this->assertEquals([new Person("asep")],$result->all());
    }

    public function testMapSpread()
    {
        $collection = collect([["asep","mul","yadi"],["e","e","n"]]);

        $result = $collection->mapSpread(function($firstname,$midname,$lastname)
    {
        $fullname = $firstname . " " . $midname.$lastname;

        return new person($fullname);
    });

    $this->assertEquals([new person("asep mulyadi"),new person("e en")],$result->all());


    }

    public function testMapToGroup()
    {
        $collection = collect(
            [
                [
                    "departemen"=>"IT",
                    "name"=>"asep"
                ],
                [
                    "departemen"=>"IT",
                    "name"=>"Yadi"
                ],
                [
                    "departemen"=>"HR",
                    "name"=>"Mul"
                ]
            ]
        );

        $result = $collection->mapToGroups(function($person)
    {
        return [$person["departemen"]=>$person["name"]];
    });

    $this->assertEquals(
        [
            "IT"=>collect(["asep","Yadi"]),
            "HR"=>collect(["Mul"])
        ],
        $result->all()
    );


    }

    public function testZip()
    {
        $collection1 = collect([1,2]);
        $collection2 = collect([3,4]);
        $collection3 = $collection1->zip($collection2);

        $this->assertEquals(
            [
                collect([1,3]),
                collect([2,4])
            ],
            $collection3->all()
        );
    }

    public function testConcat()
    {
        $collection1 = collect([1,2,3]);
        $collection2 = collect([4,5,6]);
        $collection3 = $collection1->concat($collection2);

        $this->assertEquals(
            [
                1,2,3,4,5,6
            ],
            $collection3->all()
        );
    }

    public function testCombine()
    {
        $collection1 = collect(["name","country"]);
        $collection2 = collect(["asep","indonesia"]);
        $result = $collection1->combine($collection2);

        $this->assertEquals(
            [
                "name"=>"asep",
                "country"=>"indonesia"
            ],
            $result->all()
        );
    }

    public function testCollapse()
    {
        $collection = collect([[1,2,3],[4,5,6]]);

        $result = $collection->collapse();

        $this->assertEqualsCanonicalizing([1,2,3,4,5,6],$result->all());
    }

    public function testFlatMap()
    {
        $collection = collect(
            [
                ["name"=>"yadi",
                "hobbies"=>["coding","swim","basket"]
                ],
                ["name"=>"een",
                "hobbies"=>["reading","game"]
                ]
            ]
        );

        $result = $collection->flatMap(function($item)
        {
        return  $item["hobbies"];
        });

        $this->assertEqualsCanonicalizing(["coding","swim","basket","reading","game"],$result->all());
    }

    public function testStringRepresentation()
    {
        $collection = collect(["asep","mul","yadi"]);

        $this->assertEquals("asep-mul-yadi",$collection->join("-"));

        $collection = collect(["asep","mul","yadi"]);
        $this->assertEquals("asep-mul.yadi",$collection->join("-","."));
    }

    public function testFiltering()
    {
        $collection = collect(
            [
                "asep"=>90,
                "mul"=>100,
                "yadi"=>89
            ]
        );

        $result = $collection->filter(function($value,$key)
    {
        return $value >= 90;
    });

    $this->assertEquals(["asep"=>90,"mul"=>100],$result->all());
    }

    public function testPartition()
    {
        $collection = collect(
            [
                "asep"=>90,
                "mul"=>100,
                "yadi"=>89
            ]
            );

        [$trueFilter,$falseFilter] = $collection->partition(function($value)
        {
            return $value >= 90;
        });

        $this->assertEquals(["asep"=>90,"mul"=>100],$trueFilter->all());
        $this->assertEquals(["yadi"=>89],$falseFilter->all());
    }

   public function testTesting()
   {
    $collection = collect(["asep","mul","yadi"]);

    self::assertTrue($collection->contains("mul"));
    self::assertTrue($collection->contains(function($value,$key)
    {
       return $value == "yadi";
    }));
   }

   public function testGrouping()
   {
        $collection = collect(
            [
                [
                    "name"=>"asep",
                    "department"=>"IT"
                ],
                [
                    "name"=>"mul",
                    "department"=>"IT"
                ],
                [
                    "name"=>"yadi",
                    "department"=>"HR"
                ]
            ]
        );

        $result = $collection->groupBy("department");

    //     $result = $collection->groupBy(function($item)
    // {
    //     return $item["department"];
    // });

        $this->assertEquals(
            [
                "IT" =>collect([
                        [
                            "name"=>"asep",
                            "department"=>"IT"
                        ],
                        [
                            "name"=>"mul",
                            "department"=>"IT"
                        ]
                        ]),
                "HR" =>collect([
                    [
                        "name"=>"yadi",
                        "department"=>"HR"
                    ]
                    ])

                
            ],$result->all());
   }

   public function testSlice()
   {
     $collection = collect([1,2,3,4,5,6,7,8,9]);
     $result = $collection->slice(3);

     $this->assertEqualsCanonicalizing([4,5,6,7,8,9],$result->all());

     $result = $collection->slice(2,3);
     $this->assertEqualsCanonicalizing([3,4,5],$result->all());
   }

   public function testTake()
   {
        $collection = collect([1,2,3,4,5,6]);
        $result = $collection->take(3);
        $this->assertEqualsCanonicalizing([1,2,3],$result->all());
        $result = $collection->takeUntil(function($item)
            {
                return $item == 3;
            });
        $this->assertEqualsCanonicalizing([1,2],$result->all());

        $result = $collection->takeWhile(function($item)
            {
                return $item < 3;
            });
        $this->assertEqualsCanonicalizing([1,2],$result->all());
   }

   public function testSkip()
   {
        $collection = collect([1,2,3,4,5,6]);
        $result = $collection->skip(3);
        $this->assertEqualsCanonicalizing([4,5,6],$result->all());

        $result = $collection->skipUntil(function($item)
        {
            return $item == 4;
        });
        $this->assertEqualsCanonicalizing([4,5,6],$result->all());

        $result = $collection->skipWhile(function($item)
        {
            return $item < 4;
        });
        $this->assertEqualsCanonicalizing([4,5,6],$result->all());
   }

   public function testChunked()
   {
     $collection = collect([1,2,3,4,5,6,7,8,9,10]);
     $result = $collection->chunk(3);

     $this->assertEqualsCanonicalizing([1,2,3],$result->all()[0]->all());
     $this->assertEqualsCanonicalizing([4,5,6],$result->all()[1]->all());
     $this->assertEqualsCanonicalizing([7,8,9],$result->all()[2]->all());
     $this->assertEqualsCanonicalizing([10],$result->all()[3]->all());
   }

   public function testRetrive()
   {
        $collection = collect([1,2,3,4,5,6]);
        $result = $collection->first();
        $this->assertEquals(1,$result);

        $result = $collection->first(function($value)
        {
           return  $value > 5;
        });
        $this->assertEquals(6,$result);

        $result = $collection->last();
        $this->assertEquals(6,$result);

        $result = $collection->last(function($value)
        {
            return $value < 5;
        });
        $this->assertEquals(4,$result);
   }

   public function testRandom()
   {
        $collection = collect([1,2,3,4]);
        $result = $collection->random();
        self::assertTrue(in_array($result,[1,2,3,4]));
   }

   public function testChecking()
   {
     $collection = collect([1,2,3,4,5,6]);

     $this->assertTrue($collection->isNotEmpty());
     $this->assertFalse($collection->isEmpty());
     $this->assertTrue($collection->contains(3));
   }

   public function testSort()
   {
        $collection  = collect([4,2,5,6,1,3]);
        $result = $collection->sort();
        $this->assertEqualsCanonicalizing([1,2,3,4,5,6],$result->all());
        $result = $collection->sortDesc();
        $this->assertEqualsCanonicalizing([6,5,4,3,2,1],$result->all());
   }

   public function testAgregat()
   {
    $collection = collect([1,2,3,4,5,6,7]);

    $this->assertEquals(4,$collection->avg());
    $this->assertEquals(1,$collection->min());
    $this->assertEquals(7,$collection->max());
    $this->assertEquals(28,$collection->sum());
    $this->assertEquals(7,$collection->count());

   }

   public function testReduce()
   {
    $collection = collect([1,2,3,4,5]);
    $result = $collection->reduce(function($carry,$item)
    {
        return $carry+$item;
    });

    //[1,2] = 3
    //[3,3] = 6
    //[6,4] = 10
    //[10,5] = 15

    $this->assertEquals(15,$result);
    }

    public function testLazyCollection()
    {
        $collection = LazyCollection::make(function()
    {
        $value =1;
        while(true){
        yield $value;
        $value++;}
    });

    $result = $collection->take(5);
    $this->assertEqualsCanonicalizing([1,2,3,4,5],$result->all());


    }
}
