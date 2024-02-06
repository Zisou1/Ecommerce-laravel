<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItems;
use App\Models\ProductPrice;

class OrderManagementSeller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $userId = Auth::user()->id;

        $orderItems = OrderItems::whereIn('product_id', function ($query) use ($userId) {
            $query->select('id')
                  ->from('products')
                  ->where('user_id', $userId);
        })->get();
    
        $orderIds = $orderItems->pluck('order_id')->unique();
        $orders = Order::whereIn('id', $orderIds)->get();
    
        return view('seller.order', compact('orders', 'orderItems'));
// Do something with the orders...
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    /**
 * Display the specified resource.
 */
/**
 * Display the specified resource.
 */
/**
 * Display the specified resource.
 */
/**
 * Display the specified resource.
 */
public function show(string $orderNumber)
{
    $order = Order::where('order_number', $orderNumber)
        ->with('user')
        ->firstOrFail();
    
    $orderItems = OrderItems::where('order_id', $order->id)
        ->with('product')
        ->get();

    return view('seller.orderitems', compact('order', 'orderItems'));
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
    


    // Validate the incoming request
    public function update(Order $order)
{
    // Validate the incoming request
    $validatedData = request()->validate([
        'status' => 'in:In-progress,Completed,Cancelled',
        'notes' => 'nullable|string|max:255',
    ]);

    // Update the order with the new status and notes
    $order->status = $validatedData['status'];
    $order->notes = $validatedData['notes'];
    $order->save();

    if ($order->status === 'Completed') {
        // Retrieve the order items
        $orderItems = $order->orderItems;

        // Update the product quantities and weight
        foreach ($orderItems as $orderItem) {
            $productPrice = ProductPrice::where('product_id', $orderItem->product_id)
                ->firstOrFail();

            $weight = $orderItem->weight;
            $quantity = $orderItem->quantity;
            if ($weight === '250g') {
                $productPrice->{'250g_quantity'} -= $quantity;
            } elseif ($weight === '500g') {
                $productPrice->{'500g_quantity'} -= $quantity;
            } elseif ($weight === '750g') {
                $productPrice->{'750g_quantity'} -= $quantity;
            } elseif ($weight === '1kg') {
                $productPrice->{'1kg_quantity'} -= $quantity;
            }

            $productPrice->save();
        }
    }

    // Redirect back or return a response indicating success
    return redirect('seller/orders')->with('success', 'Order updated successfully');
}


    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
