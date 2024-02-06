@extends('adminlte::page')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h1>Order Items - Order #{{ $order->order_number }}</h1>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <h4>Client Information:</h4>
                            <p><strong>Name:</strong> {{ $order->user->name }}</p>
                            <p><strong>Email:</strong> {{ $order->user->email }}</p>
                            <p><strong>Phone:</strong> {{ $order->user->N_tel }}</p>
                            <h4>Shipping Information:</h4>
                            <p><strong>Wilaya:</strong> {{ $order->wilaya }}</p>
                            <p><strong>Ville:</strong> {{ $order->ville }}</p>
                            <p><strong>Adresse:</strong> {{ $order->shipping_adress }}</p>
                            <p><strong>Zip code:</strong> {{ $order->zip }}</p>
                        </div>
                        <hr>
                        
                        
                            
                        </div>

                        <div class="mb-3">
                            <h4>Order Items:</h4>
                            <table class="table">
                                <thead>
                                    <tr style="background-color: #e6e6e6;">
                                        <th>Product</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th> Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orderItems as $orderItem)
                                        <tr>
                                            <td>{{ $orderItem->product->title }}</td>
                                            <td>{{ $orderItem->quantity }}</td>
                                            <td>{{ $orderItem->price }}Da</td>
                                            <td>{{ $orderItem->subtotal }} Da</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                
                                
                            </table>
                            <h2>Total ammount: {{$order->total_amount}}Da</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
