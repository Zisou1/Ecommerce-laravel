<?php

namespace App\Http\Controllers;
use App\Models\ProductPrice;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function checkStock()
{
    $productPrices = ProductPrice::all();
    $notifications = [];

    foreach ($productPrices as $productPrice) {
        if ($productPrice->isStockLow()) {
            // Add a notification message to the array
            $notifications[] = "Stock is low for product price with ID: " . $productPrice->id;
        }
    }

    return view('layouts.seller')->with('notifications', $notifications);
}

}
