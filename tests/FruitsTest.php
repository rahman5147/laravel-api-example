<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FruitsTest extends TestCase
{
	use DatabaseMigrations;

    public function testJSONFront(){
        $this->get('/api')
            ->seeJson([
                'Fruits' => 'Delicious and healthy!'
        ]);
    }
}
