<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Queryrawtest extends TestCase
{
    public function setUp():void
    {
        parent::setUp();
        DB::delete('delete from category');
        DB::delete('delete from counters');
    }

    public function testQueryraw()
    {
        DB::insert('insert into category(id,name,alamat) values (?,?,?)',[1,'asep','franch']);

        $result = DB::select('select * from category');

        self::assertCount(1,$result);
        self::assertEquals('asep',$result[0]->name);
        self::assertEquals('franch',$result[0]->alamat);
    }

    public function testNamedBinding()
    {
        DB::insert('insert into category(id,name,alamat) values(:id,:name,:alamat)',
    [
        "id" =>1,
        "name" => "asep",
        "alamat"=> "franch"
    ]);

    $result = DB::select('select * from category');

    self::assertCount(1,$result);
    self::assertEquals('asep',$result[0]->name);
    self::assertEquals('franch',$result[0]->alamat);
    }

    public function testDBtransaction()
    {
        DB::transaction(function()
    {
        DB::insert('insert into category(id,name,alamat) values (?,?,?)',[1,'asep','franch']);
        DB::insert('insert into category(id,name,alamat) values (?,?,?)',[2,'asepm','franche']);
        $result = DB::select('select * from category');

        self::assertCount(2,$result);
    });
    }

    // public function testDBTransactionFail()
    // {
    //     try
    //     {
    //         DB::transaction(function()
    //         {
    //             DB::insert('insert into category (id,name,alamat) values (?,?,?)',[1,'asep','franch']);
    //             DB::insert('insert into category (id,name,alamat) values (?,?,?)',[1,'asep','franch']);
                

    //         });
    //     }catch(QueryException $error)
    //     {
    //         //untuk membaypas erorr 
    //     }
    //     $result = DB::select('select * from categories');
    //     self::assertCount(0,$result);
    // }

    public function testQueryBuilderInsert()
    {
        DB::table('categories')
        ->insert(
            [
                    'id' =>1,
                    'name'=>'asep',
                    'alamat'=>'franch',
                    
            ]
        );
        DB::table('categories')
        ->insert(
            [
                    'id' =>2,
                    'name'=>'asepm',
                    'alamat'=>'franche',
                    
            ]
        );

        $result = DB::select('select count(id) as total from categories');
        self::assertEquals(2,$result[0]->total);
    }

    public function testSelecQB()
    {
        $this->testQueryBuilderInsert();

        $collection = DB::table('categories')->select(['id','name'])->get();

        self::assertNotNull($collection);

        $collection->each(function($item)
            {
                log::info(json_encode($item));
            });
    }

    public function testwhere()
    {
        $this->testQueryBuilderInsert();

        $collection = DB::table('categories')->where(function($sql)
    {
        $sql->where('id','=',1);
        $sql->orWhere('id','=',2);
    })->get();

    //ini sama seperti raw query = select * from categories where id =1 or id=2;

    self::assertCount(2,$collection);
    $collection->each(function($item)
    {
        log::info(json_encode($item));
    });

    }

    public function testWhereBetween()
    {
        $this->testQueryBuilderInsert();

        $collection = DB::table('categories')->whereBetween('id',[1,3])->get();

        self::assertCount(2,$collection);
        $collection->each(function($item)
            {
                log::info(json_encode($item));
            });
    }

    public function testWhereIn()
    {
        $this->testQueryBuilderInsert();

        $collection = DB::table('categories')->whereIn('id',[1,2])->get();

        //cari data dimana id nya 1 dan 2

        self::assertCount(2,$collection);
        $collection->each(function($item)
            {
                log::info(json_encode($item));
            });
    
    }

    public function testWhereDate()
    {
        $this->testQueryBuilderInsert();

        $collection = DB::table('categories')->whereDate('id','10-10-2020')->get();
        self::assertCount(2,$collection);
        $collection->each(function($item)
        {
            log::info(json_encode($item));
        });
    
    }

    public function testUpdate()
    {
        $this->testQueryBuilderInsert();

        DB::table('categories')->where('id',1)
        ->update(['name'=>'asepu']);

        $collection = DB::table('categories')->select('name')->where('name','asepu')->get();

        self::assertCount(1,$collection);

        $collection->each(function($item)
        {
            log::info(json_encode($item));
        });

    }

    public function testUpsert()
    {
        $this->testQueryBuilderInsert();

        DB::table('categories')->updateOrinsert(
            [
                'id' => '1'
            ],
            [
                'name' => 'asep'
            ]
        );

        $collection = DB::table('categories')->select('*')->get();

        self::assertCount(2,$collection);

        $collection->each(function($item)
        {
            log::info(json_encode($item));
        });

    }

    // public function testIncrement()
    // {
    //     DB::table('counters')->where('id',0)->increment('id',1);

    //     $collection = DB::table('counters')->where('counter','test')->get();
    //     $collection->each(function($item)
    //     {
    //         log::info(json_encode($item));
    //     });
    // }

    // public function testDelete()
    // {
    //     DB::table('counters')->where('counter','test')->delete();

    //     $collection = DB::table('counters')->get();

    //     self::assertCount(2,$collection);

    //     $collection->each(function($item)
    //     {
    //         log::info(json_encode($item));
    //     });
    // }

    public function testJoin()
    {
      $collection =   DB::table('counters')
                        ->join('categories','categories.id','=','counters.id')
                        ->select('categories.name','counters.counter')->get();
        
        self::assertCount(0,$collection);
        $collection->each(function($item)
            {
                log::info(json_encode($item));
            });
    }

    // public function testOrderby()
    // {
    //     DB::table('counters')->increment('id',2);

    //     DB::table('counters')
    //     ->insert(['id'=>'1','counter'=>'hulk']);
    //     DB::table('counters')
    //     ->insert(['id'=>'2','counter'=>'hulk']);

    //     $collection = DB::table('counters')
    //     ->orderBy('counter','asc')
    //     ->orderBy('id','desc')
    //     ->get();


    //     self::assertCount(2,$collection);
    //     $collection->each(function($item)
    //     {
    //         log::info(json_encode($item));
    //     });
    //}

    // public function testPaging()
    // {
    //     $collection = DB::table('counters')->skip(0)->take(1)->get();

    //     self::assertCount(1,$collection);
    //     $collection->each(function($item)
    //         {
    //             log::info(json_encode($item));
    //         });
    // }

    public function testManyInsert()
    {
        for($a=0; $a <20;$a++)
        {
            DB::table('counters')
            ->insert(
                [
                    'id'=>$a,
                    'counter'=>"counter $a"
                ]
            );
        }
    }
    // public function testChunk()
    // {
    //     $this->testManyInsert();

    //     DB::table('counters')->orderBy('id')
    //     ->chunk(10,function($counters)
    //     {
    //         self::assertNotNull($counters);
    //         log::info('start chunk');
    //         $counters->each(function($item)
    //         {
    //             log::info(json_encode($item));
    //         });
    //     });
    // }
    

    public function testLazy()
    {
        $this->testManyInsert();

        $collection = DB::table('counters')->orderBy('id')
                        ->lazy(10)
                        ->take(15)
                        ->each(function($item){
                                log::info(json_encode($item));
                            });
        self::assertNotNull($collection);
    }

    public function testCursor()
    {
        $this->testManyInsert();

        $collection = DB::table('counters')->orderBy('id')->cursor();

        self::assertNotNull($collection);
        $collection->each(function($item)
        {
            log::info(json_encode($item));
        });
    }

    public function testRaw()
    {
        $this->testManyInsert();

        $collection = DB::table('counters')
        ->select(
            DB::raw('count(id) as total'),
            DB::raw('min(id) as minimal'),
            DB::raw('max(id) as max')
        )->get();

        self::assertNotNull($collection);
        $collection->each(function($item)
        {
            log::info(json_encode($item));
        });
    }

    // public function testGroupby()
    // {
    //     DB::table('categories')
    //     ->insert([
    //         'id'=>112,
    //         'name'=>'mika',
    //         'alamat'=>'franch'
    //     ]);
        
    //     DB::table('categories')
    //     ->insert([
    //         'id'=>113,
    //         'name'=>'kami',
    //         'alamat'=>'franch'
    //     ]);

    //     $collection =DB::table('categories')
    //                  ->select('name')
    //                  ->groupBy('name')
    //                  ->having(DB::raw('count(*)',">",0))
    //                  ->orderBy('id')
    //                  ->get();

    //     self::assertCount(1,$collection);
    //     $collection->each(function($item)
    //     {
    //         log::info(json_encode($item));
    //     });
        
    // }

    public function testLocking()
    {
        DB::table('category')
        ->insert([
            'id'=>114,
            'name'=>'mika',
            'alamat'=>'franch'
        ]);

        $collection = DB::table('category')
                        ->where('id',114)
                        ->lockForUpdate()
                        ->get();

        self::assertCount(1,$collection);
    }

    public function testPagination()
    {
        $this->testManyInsert();

        $paginate = DB::table('counters')->paginate(perPage:5,page:1);

        self::assertEquals(5,$paginate->perPage());
        self::assertEquals(1,$paginate->currentPage());
        self::assertEquals(4,$paginate->lastPage());
        self::assertEquals(20,$paginate->total());

        $collection = $paginate->items();
        self::assertCount(5,$collection);
        foreach($collection as $item)
        {
            log::info(json_encode($item));
        }


    }

    public function testIterationPaginate()
    {
        $this->testManyInsert();


        $page = 1;

        while(true)
        {
            $paginate = DB::table('counters')->paginate(perPage:5,page : $page);
            
            if($paginate->isEmpty())
            {
                break;
            }
            else{

                $page++;

                $collection = $paginate->items();
                self::assertCount(5,$collection);
                foreach($collection as $item)
                {
                    log::info(json_encode($item));
                }

            }
        }
    }

    public function testCursorPagination()

    {
        $this->testManyInsert();

        $cursor = 'id';

        while(true)
        {
            $paginate = DB::table('counters')->orderby('id')->cursorPaginate(perPage:5,cursor:$cursor);

            foreach($paginate->items() as $item)
            {
                self::assertNotNull($item);
                log::info(json_encode($item));
            }

            $cursor = $paginate->nextCursor();
            if($cursor == null)
            {
                break;
            }

        }


    }
}
