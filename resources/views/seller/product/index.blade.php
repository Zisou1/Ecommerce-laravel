@extends('layouts.seller')

@section('content')
@if(session()->has('success'))
<div class="alert alert-success" role="alert">
    <h4 class="alert-heading">Well done! User deleted successfully</h4>
</div>
@endif
<div class="d-flex justify-content-center">
    <h1>Your Products</h1>
</div>
<div class="container">
    <a href="{{ url('seller/product/create') }}" class="btn btn-primary" style="color:white;">Add a Product</a>
</div>
<table class="table">
    <thead>
        <tr>
            <th>Title</th>
            <th>Description</th>
            <th>Model</th>
            <th>Marque</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $product)
        <tr>
            <td>{{ $product->title }}</td>
            <td>{{ $product->description }}</td>
            <td>{{ $product->model }}</td>
            <td>{{ $product->marque }}</td>
            <td class="d-flex">
                <!-- Add a clickable icon to show the QR code in a modal -->
                <button type="button" class="btn btn-link qr-code-btn" data-toggle="modal" data-target="#qrCodeModal{{ $product->id }}">
                    <img src="{{ url('/product/' . $product->id . '/qrcode') }}" alt="Product QR Code" style="width: 50px; height: 50px;">
                </button>

                <!-- QR code modal -->
                <div class="modal fade" id="qrCodeModal{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="qrCodeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="qrCodeModalLabel">Product QR Code</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body text-center">
                                <img src="{{ url('/product/' . $product->id . '/qrcode') }}" alt="Product QR Code" style="max-width: 100%;">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="px-2">
                    <a href="{{ route('seller.product.edit', $product->id) }}" class="btn btn-primary">Edit</a>
                </div>

                <form action="{{ route('seller.product.destroy', $product->id) }}" method="POST" style="display: inline;">
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
