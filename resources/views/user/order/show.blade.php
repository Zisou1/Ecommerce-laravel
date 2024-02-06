@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-center">
    <h1 class="">Your Orders </h1>
  </div>

<table class="table">
    <thead>
        <tr style="background-color: #e6e6e6;" >
            <th>Order number</th>
            <th>order date</th>
            <th>Shipping price</th>
            <th>Total amount</th>
            <th>Number of items</th>
            <th>Status</th>
            <th>invoice</th>
        
        </tr>
    </thead>
    <tbody>
        @foreach ($orders as $order)
            <tr>
                <td>{{ $order->order_number }}</td>
                <td>{{ $order->order_date }}</td>
                <td>400DA</td>
                <td>{{ $order->total_amount }}Da</td>
                <td>{{ $order->orderItems->count() }}</td>
                <td class="@if ($order->status === 'Completed') bg-success @else bg-warning @endif">{{ $order->status }}</td>
                <td> <a href="{{ route('invoice', $order->id) }}"><i class="fa fa-print fa-2x"></i></a> </td>
                
                
            </tr>
        @endforeach
    </tbody>
</table>
@endsection