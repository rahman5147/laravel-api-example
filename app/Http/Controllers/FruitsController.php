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

    public function show($id){
        $fruit = Fruit::where('id', $id)->first();

        if ($fruit) {
            return $this->item($fruit, new FruitsTransformer);
        }

        return $this->response->errorNotFound();
    }

    public function store(Requests\StoreFruitRequest $request){
        if (Fruit::Create($request->all())) {
            return $this->response->created();
        }

        return $this->response->errorBadRequest();
    }

    /**
     * Remove the specified fruit.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $fruit = Fruit::find($id);

        if ($fruit) {
            $fruit->delete();
            return $this->response->noContent();
        }

        return $this->response->errorBadRequest();
    }
}
