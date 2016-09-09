<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FruitsTest extends TestCase
{
	use DatabaseMigrations;

	/**
	* @test
	* Test: GET /api.
	*/
    public function testJSONFront(){
        $this->get('/api')
            ->seeJson([
                'Fruits' => 'Delicious and healthy!'
        ]);
    }

	/**
	* @test
	* Test: GET /api/fruits.
	*/
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

	/**
	 * @test
	 * Test: GET /api/fruit/1.
	 */
	public function it_fetches_a_single_fruit(){
	    $this->seed('FruitsTableSeeder');

	    $this->get('/api/fruit/1')
	        ->seeJson([
	            'data' => [
	                'id'        => 1,
	                'name'      => "Apple",
	                'color'     => "Green",
	                'weight'    => "150 grams",
	                'delicious' => true
	            ]
        ]);
	}
}
