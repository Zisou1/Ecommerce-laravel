<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItems;
use App\Models\ProductPrice;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;

class orderManagement extends Controller
{
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    $cartItems = Cart::content()->map(function ($item) {
        $product = Product::find($item->id);
        $item->product_id = $product->id;
        return $item;
    });

    $totalAmount = $this->calculateTotalAmount($cartItems)+ 400 ;

    return view('user.order.create', compact('cartItems', 'totalAmount'));
}


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $cartItems = Cart::content();
    $groupedItems = $cartItems->groupBy(function ($item) {
        $product = Product::find($item->id);
        return $product->user_id;
    });

    foreach ($groupedItems as $userId => $items) {
        $totalAmount = $this->calculateTotalAmount($items)+400;
        $orderNumber = $this->generateOrderNumber();

        $validatedData = $request->validate([
            'wilaya' => 'required',
            'ville' => 'required',
            'adress' => 'required',
            'zip' => 'required',
        ]);

        $paymentMethod = 'COD'; // Cash on delivery
        $status = '	In-progress';
        $note = 'Your custom note goes here';

        // Create the order
        $order = Order::create([
            'order_number' => $orderNumber,
            'total_amount' => $totalAmount,
            'order_date' => now(),
            'shipping_adress' => $request->input('adress'),
            'wilaya' => $request->input('wilaya'),
            'ville' => $request->input('ville'),
            'zip' => $request->input('zip'),
            'payment_methode' => $paymentMethod,
            'status' => $status,
            'notes' => $note,
            'user_id' => Auth::id(),
        ]);

        // Create order items
        foreach ($items as $item) {
            OrderItems::create([
                'quantity' => $item->qty,
                'price' => $item->price,
                'subtotal' => $item->subtotal,
                'weight' => $item->options->weight,
                'discount' => 0,
                'order_id' => $order->id,
                'product_id' => $item->id,
            ]);
        }
    }

    Cart::destroy();

    return redirect('/carts')->with('message', 'Products added successfully');
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        

        
        
            $orders = Order::where('user_id', Auth::id())->get();
            $orderItems = OrderItems::whereIn('order_id', $orders->pluck('id'))->get();
        
            return view('user.order.show', compact('orders', 'orderItems'));
        
        


    
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    private function calculateTotalAmount($cart)
{
    $totalAmount = 0;

    foreach ($cart as $item) {
        $subtotal = $item->price * $item->qty;
        $totalAmount += $subtotal;
    }

    return $totalAmount;
}
 private function generateOrderNumber()
{
    $prefix = 'ORD'; // Optional prefix for the order number
    $uniqueId = substr(uniqid(), -6); // Extract the last 6 characters of the unique ID

    $orderNumber = $prefix . '-' . $uniqueId;

    return $orderNumber;

}
}
