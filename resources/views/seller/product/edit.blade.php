@extends('layouts.seller')
@section('content')

<div class="text-center">
    <h1 class="font-weight-bold">Edit your Product</h1>
</div>

<div class="row mb-3">
    <div class="col-md-8 offset-md-2">
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">Stock Status</h5>
                <div>
                    @if($products->productprice->{'1kg_quantity'} == 0)
                        <h5>1kg Out of Stock</h5>
                    @endif
                    @if($products->productprice->{'250g_quantity'} == 0)
                        <h5>250g Out of Stock</h5>
                    @endif
                    @if($products->productprice->{'500g_quantity'} == 0)
                        <h5>500g Out of Stock</h5>
                    @endif
                    @if($products->productprice->{'750g_quantity'} == 0)
                        <h5>750g Out of Stock</h5>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<form action="{{ route('seller.product.update', $products->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="row mb-3">
        <label for="title" class="col-md-4 col-form-label text-md-end">Title</label>
        <div class="col-md-5">
            <input id="title" type="text" class="form-control" name="title" value="{{ $products->title }}" required>
        </div>
    </div>

    <div class="row mb-3">
        <label for="model" class="col-md-4 col-form-label text-md-end">Model</label>
        <div class="col-md-5">
            <input id="model" type="text" class="form-control" name="model" value="{{ $products->model }}" required>
        </div>
    </div>

    <div class="row mb-3">
        <label for="marque" class="col-md-4 col-form-label text-md-end">Marque</label>
        <div class="col-md-5">
            <input id="marque" type="text" class="form-control" name="marque" value="{{ $products->marque }}" required>
        </div>
    </div>

    <div class="row mb-3">
        <label for="description" class="col-md-4 col-form-label text-md-end">Description</label>
        <div class="col-md-5">
            <textarea id="description" class="form-control" name="description" rows="4" required>{{ $products->description }}</textarea>
        </div>
    </div>

    <div class="row mb-3">
        <label class="col-md-4 col-form-label text-md-end">Price & Quantity</label>
        <div class="col-md-5">
            <div class="row">
                <div class="col-md-6">
                    <input type="number" step="0.01" min="0" class="form-control" name="price_250g" placeholder="Price (250g)" value="{{ $products->productprice->{'250g'} }}">
                </div>
                <div class="col-md-6">
                    <input type="number" min="0" class="form-control" name="quantity_250g" placeholder="Quantity (250g)" value="{{ $products->productprice->{'250g_quantity'} }}">
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-6">
                    <input type="number" step="0.01" min="0" class="form-control" name="price_500g" placeholder="Price (500g)" value="{{ $products->productprice->{'500g'} }}">
                </div>
                <div class="col-md-6">
                    <input type="number" min="0" class="form-control" name="quantity_500g" placeholder="Quantity (500g)" value="{{ $products->productprice->{'500g_quantity'} }}">
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-6">
                    <input type="number" step="0.01" min="0" class="form-control" name="price_750g" placeholder="Price (750g)" value="{{ $products->productprice->{'750g'} }}">
                </div>
                <div class="col-md-6">
                    <input type="number" min="0" class="form-control" name="quantity_750g" placeholder="Quantity (750g)" value="{{ $products->productprice->{'750g_quantity'} }}">
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-6">
                    <input type="number" step="0.01" min="0" class="form-control" name="price_1kg" placeholder="Price (1kg)" value="{{ $products->productprice->{'1kg'} }}">
                </div>
                <div class="col-md-6">
                    <input type="number" min="0" class="form-control" name="quantity_1kg" placeholder="Quantity (1kg)" value="{{ $products->productprice->{'1kg_quantity'} }}">
                </div>
            </div>
        </div>
    </div>
    <div class="text-center">
        <h1 class="font-weight-bold">{{$products->productprice->{'1kg_quantity'} }}</h1>
    </div>

    <div class="row mb-3">
        <label for="image_path" class="col-md-4 col-form-label text-md-end">Please upload the image</label>
        <div class="col-md-5">
            <input class="form-control" type="file" id="image_path" name="image_path">
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6 offset-md-4">
            <button type="submit" class="btn btn-primary">Update Product</button>
        </div>
    </div>
</form>

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
