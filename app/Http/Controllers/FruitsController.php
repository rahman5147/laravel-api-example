<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class FruitsController extends Controller
{
    public function index(){
        $fruits = Fruit::all();

        return $this->response->array(['data' => $fruits], 200);
    }
}
