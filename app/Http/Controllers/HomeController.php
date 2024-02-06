<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductPrice;
use App\Models\seller;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
{
    $products = Product::with('productPrice')->get();
    $userIds = $products->pluck('user_id');
    $sellers = seller::whereIn('user_id', $userIds)->get();

    return view('home', compact('products', 'sellers'));
}
    
}
