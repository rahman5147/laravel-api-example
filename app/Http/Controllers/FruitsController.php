<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Fruit;
use Dingo\Api\Routing\Helpers;
use App\Transformers\FruitsTransformer;

class FruitsController extends Controller
{
	use Helpers;
    public function index(){
        $fruits = Fruit::all();

        // return $this->response->array(['data' => $fruits], 200);
        return $this->collection($fruits, new FruitsTransformer);
    }
}
