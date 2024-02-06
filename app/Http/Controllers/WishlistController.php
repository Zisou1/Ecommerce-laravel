<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        
        $wishlist = Wishlist::where('user_id', Auth::id())->with('product')->get();
    return view('wishlist', compact('wishlist'));
    }

    public function store(Request $request)
    {
         // Check if the wishlist already exists for the user
    $userId = auth()->id();
    $productId = $request->input('product_id');

    $wishlistExists = Wishlist::where('user_id', $userId)
                              ->where('product_id', $productId)
                              ->exists();

    // If the wishlist already exists, display a message
    if ($wishlistExists) {
        return redirect()->back()->with('message', 'This item is already in your wishlist.');
    }

    // If the wishlist doesn't exist, create a new entry
    Wishlist::create([
        'user_id' => $userId,
        'product_id' => $productId
    ]);

    return redirect()->back()->with('message', 'Item added to your wishlist.');
    }
    public function destroy($id){
        $user = Wishlist::findOrFail($id);

        // Delete the product image from storage

        $user->delete();

        return redirect()->back()->with('message', 'The items is deleted from wishlist succesefuly');
    }
}

