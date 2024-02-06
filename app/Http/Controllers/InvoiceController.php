<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItems;
use App\Models\ProductPrice;
use PDF;


class InvoiceController extends Controller
{
    

    // Fetch order details and data for the invoice





public function generateInvoice($orderId)
{
    $order = Order::with('orderItems')->find($orderId);
    

    $data = [
        'order' => $order,
    ];

    $pdf = PDF::loadView('invoice', $data);

    $fileName = 'invoice-' . $order->order_number . '.pdf';

    return $pdf->download($fileName);
}



}
