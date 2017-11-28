<?php

namespace App\Http\Controllers;

use App\Products;
use Illuminate\Http\Request;

class IndexController extends Controller
{
	public function index(){
		$products=Products::select('id','title')->get()->toArray();
		return view('index',compact('products'));
	}
}
