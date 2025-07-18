<?php

namespace App\Http\Controllers;

use App\Models\Homepage;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $products = Homepage::getProducts(); // This calls the method from your model
        return view('home', compact('products'));
    }
}
