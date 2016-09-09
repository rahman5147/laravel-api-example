<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FruitsTest extends TestCase
{
	use DatabaseMigrations;

	public function testFruit(){
		$this->seed('FruitsTableSeeder');
		$this->get('/api/fruits')
         ->seeJsonStructure([
             'data' => [
                '*' => [
                    'name', 'color', 'weight', 'delicious'
                ]
             ]
         ]);
	}

    public function testJSONFront(){
        $this->get('/api')
            ->seeJson([
                'Fruits' => 'Delicious and healthy!'
        ]);
    }
}
