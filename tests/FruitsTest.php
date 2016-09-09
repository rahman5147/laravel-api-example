<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Fruit;

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
	public function testSingleFruit(){
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

	/**
	 * @test
	 * Test: GET /api/authenticate.
	 */
	public function testAuthenticate(){
	    $user = factory(App\User::class)->create(['password' => bcrypt('foo')]);

	    $this->post('/api/authenticate', ['email' => $user->email, 'password' => 'foo'])
	         ->seeJsonStructure(['token']);
	}

	/**
	 * @test
	 * Test: POST /api/fruits.
	 */
	public function testSaveFruit(){
	    $user = factory(App\User::class)->create(['password' => bcrypt('foo')]);

	    $fruit = ['name' => 'peache', 'color' => 'peache', 'weight' => 175, 'delicious' => true];

	    $this->post('/api/fruits', $fruit, $this->headers($user))
	         ->seeStatusCode(201);
	}

	/**
	 * @test
	 * Test authenticate route is not valid if not authenticate
	 * Test: POST /api/fruits.
	 */
	public function testFailSaveFruit(){
	    $fruit = Fruit::create(['name' => 'peache', 'color' => 'peache', 'weight' => 175, 'delicious' => true])->toArray();

	    $this->post('/api/fruits', $fruit)
	         ->seeStatusCode(401);
	}

	/**
	 * @test
	 *
	 * Test: POST /api/fruits.
	 */
	public function test_it_422_when_validation_fails(){
	    $user = factory(App\User::class)->create(['password' => bcrypt('foo')]);

	    $fruit = ['name' => 'peache', 'color' => 'peache', 'weight' => 175, 'delicious' => true];

	    $this->post('/api/fruits', $fruit, $this->headers($user))
	         ->seeStatusCode(201);

	    $this->post('/api/fruits', $fruit, $this->headers($user))
	         ->seeStatusCode(422);
	}

	/**
	 * @test
	 *
	 * Test: DELETE /api/fruits/$id.
	 */
	public function test_it_deletes_a_fruit(){
	    $user = factory(App\User::class)->create(['password' => bcrypt('foo')]);

	    $fruit = Fruit::create(['name' => 'peache', 'color' => 'peache', 'weight' => 175, 'delicious' => true]);

	    $this->delete('/api/fruits/' . $fruit->id, [], $this->headers($user))
	         ->seeStatusCode(204);
	}
}
