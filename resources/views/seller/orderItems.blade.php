@extends('layouts.seller')

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
                        <form action="{{ route('seller.order.update', $order->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                        <div class="row mb-3">
                            <label for="status" class="col-md-4 col-form-label text-md-end"> Status</label>
                            <div class="col-md-3">
                                <select id="status" name="status" class="form-control "{{ $order->status === 'Completed' || $order->status === 'Cancelled' ? 'disabled' : '' }}>
                                    <option value="In-progress" {{ $order->status == 'In-progress' ? 'selected' : '' }}>In progress</option>
                                        <option value="Completed" {{ $order->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                                        <option value="Cancelled" {{ $order->status == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    
                                </select>
                            </div> </div>
                        
                        <div class="row mb-3">
                            <label for="description" class="col-md-4 col-form-label text-md-end">Note</label>
                            <div class="col-md-5">
                                <textarea id="notes" class="form-control" name="notes" rows="4" placeholder="Notes" required>{{$order->notes}}</textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                        </form>
                        <div class="mb-3">
                            <h4>Order Items:</h4>
                            <table class="table">
                                <thead>
                                    <tr style="background-color: #e6e6e6;">
                                        <th>Product</th>
                                        <th>Quantity</th>
                                        <th>weight</th>
                                        <th>Price</th>
                                        <th> Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orderItems as $orderItem)
                                        <tr>
                                            <td>{{ $orderItem->product->title }}</td>
                                            <td>{{ $orderItem->quantity }}</td>
                                            <td>{{  $orderItem->weight }}</td>
                                            <td>{{ $orderItem->price }}Da</td>
                                            <td>{{ $orderItem->subtotal }}Da </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                
                                
                            </table>
                            <h1>Total price : {{$order->total_amount}}Da</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
