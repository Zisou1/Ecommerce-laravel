@extends('layouts.app')
@section('content')
<div class="container my-5">
    <div class="card shadow">
        <div class="card-body">
            @if($cartItems->count()>0)
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Price</th>
                        <th>weight</th>
                        <th>Quantity</th>
                        <th>Shipping price</th>
                        <th>Subtotal</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cartItems as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->price }}DA</td>
                            <td>{{ $item->options->weight }}</td>
                            <td>{{  $item->qty }}</td>
                            <td>400DA</td>
                            <td>{{ $item->subtotal }}DA</td>
                            <td class="d-flex">
                                <form action="{{ route('cart.remove', $item->rowId) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        
                    @endforeach
                    <div class="">
                        <a type="submit" href="{{Route('user.order.create')}}" class="btn btn-primary">Check out Now!</a>
                    </div>
                @else
                    <h4>There are no products in your Cart.</h4>
                @endif
            </tbody>
        </table>
        
        
        
    </div>
</div>
</div>
@endsection
