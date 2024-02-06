<!-- user.order.create.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center">Order Details</h1>

        <h3>Cart Items:</h3>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>weight</th>
                    <th>Subtotal</th>
                    <th>Shipping price</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cartItems as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->price }}DA</td>
                    <td>{{ $item->qty }}</td>
                    <td>{{$item->options->weight}}</td>
                    <td>{{ $item->subtotal }}DA</td>
                    <td>400DA</td>
                    <td>
                        <input type="hidden" name="product_id[]" value="{{ $item->product_id }}">
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="text-center">
            <h3 style="background-color: #8fb1d4; padding: 10px; border-radius: 5px; display: inline-block;">Total Amount: <span style="font-size: 24px;">{{ $totalAmount }}DA</span></h3>
        </div>

        <h3 class="text-center">Shipping Information</h3>
        <form method="POST" action="/order">
            @csrf
            

        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="row mb-3">
                    <label for="title" class="col-md-3 col-form-label text-md-end">Wilaya</label>
                    <div class="col-md-8">
                        <input id="wilaya" type="text" class="form-control form-control-lg" name="wilaya" placeholder="Wilaya" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="model" class="col-md-3 col-form-label text-md-end">Ville</label>
                    <div class="col-md-8">
                        <input id="ville" type="text" class="form-control form-control-lg" name="ville" placeholder="Ville" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="marque" class="col-md-3 col-form-label text-md-end">Adresse</label>
                    <div class="col-md-8">
                        <input id="adress" type="text" class="form-control form-control-lg" name="adress" placeholder="Adresse" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="marque" class="col-md-3 col-form-label text-md-end">Zip code</label>
                    <div class="col-md-8">
                        <input id="zip" type="text" class="form-control form-control-lg" name="zip" placeholder="Zip code" required>
                    </div>
                </div>
                <div class="row mb-3 justify-content-center">
                    <div class="col-md-5">
                        <button type="submit" class="btn btn-primary btn-lg btn-block">Order Now!</button>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
    @if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
@endsection
