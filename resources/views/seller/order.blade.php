@extends('layouts.seller')

@section('content')
    <div class="d-flex justify-content-center">
        <h1>Your Orders</h1>
    </div>

    <table class="table">
        <thead>
            <tr style="background-color: #e6e6e6;">
                <th>Order number</th>
                <th>Order date</th>
                <th>Total amount</th>
                <th>Number of items</th>
                <th>Status</th>
                <th>Note</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->order_number }}</td>
                    <td>{{ $order->order_date }}</td>
                    <td>{{ $order->total_amount }} Da</td>
                    <td>{{ $order->orderItems->count() }}</td>
                    <td class="@if ($order->status === 'Completed') bg-success @elseif ($order->status === 'Cancelled') bg-danger @else bg-warning @endif">{{ $order->status }}</td>
                    <td>{{ $order->notes }}</td>
                    <td class="d-flex">
                        <div class="px-2">
                            <a href="{{ route('seller.order.show', ['orderNumber' => $order->order_number]) }}" class="btn btn-primary">View</a>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
