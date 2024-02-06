@extends('adminlte::page')
@section('content')
@if(session()->has('success'))
<div class="alert alert-success" role="alert">
    <h4 class="alert-heading">Well done! user deleted succefuly</h4>
  </div>
@endif
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
            <th>Action</th>
        
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
                <td class="d-flex">
                    <div class="px-2">
                        <a href="{{ route('admin.order.show', ['orderNumber' => $order->order_number]) }}" class="btn btn-primary">View</a>
                    </div>
                    <form action="{{ route('admin.order.destroy', $order->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                    </form>
                </td>
                
                
            </tr>
        @endforeach
    </tbody>
</table>
@endsection