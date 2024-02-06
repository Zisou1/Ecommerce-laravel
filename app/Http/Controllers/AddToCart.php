<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Product;
use App\Models\ProductPrice;

class AddToCart extends Controller
{
    public function addToCart(Request $request)
{
    // Retrieve the product details from the request
    $productId = $request->input('product_id');
    $quantity = $request->input('quantity');
    $selectedWeight = $request->input('weight');
    if (!$selectedWeight) {
        return redirect()->back()->with('message', 'Weight is not selected.');
    }
    // Retrieve the product from the database
    $product = Product::findOrFail($productId);

    // Retrieve the product price based on the selected option
    $productPrice = ProductPrice::where('product_id', $productId)->first();

    // Check if a valid price is available for the selected weight option
    if (!$productPrice || !$productPrice->$selectedWeight) {
        return redirect()->back()->with('message', 'Selected weight option is not available.');
    }

    // Get the price based on the selected weight
    $price = $productPrice->$selectedWeight;

    // Add the product to the shopping cart
    Cart::add([
        'id' => $product->id,
        'name' => $product->title,
        'price' => $price,
        'qty' => $quantity,
        'associatedModel' => $product,
        
        'options' => [
            'shipping_price' => 400,
            'weight' => $selectedWeight, // Add the shipping price as an option
        ],
        
    ]);

    // Update the subtotal of each item in the cart
    $cartItems = Cart::content();
    foreach ($cartItems as $item) {
        $item->subtotal;
    }

    // Store the cart in the session
    Cart::store('user_cart');

    // Redirect or return a response
    return redirect()->back()->with('message', 'Product added to cart successfully.');
}

public function showCart()
    {
        $cartItems = Cart::content();

        return view('cart', compact('cartItems'));
    }
    public function removeItem($itemId)
{
    Cart::remove($itemId);

    return redirect()->route('cart.show')->with('message', 'Item removed from cart successfully.');
}
}
