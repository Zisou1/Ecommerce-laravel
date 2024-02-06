@extends('layouts.app')

@section('content')
<style>
    .container {
        max-width: 960px;
        margin: 0 auto;
    }

    .img-fluid {
        max-width: 100%;
        height: auto;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .text-center {
        text-align: center;
    }
</style>

<div class="container">
    @if (session('message'))
        <div class="alert alert-info">
            {{ session('message') }}
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-md-6">
                    <img src="/images/{{ $product->image_path }}" class="img-fluid" alt="{{ $product->title }}">
                </div>
                <div class="col-md-6">
                    <h2 class="card-title">{{ $product->title }}</h2>
                </br>
                    <h5>Description</h5>
                    <p class="card-text">{{ $product->description }}</p>

                    <form action="{{ route('cart.add') }}" method="POST">
                        @csrf
                        @method('POST')
                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                        <div class="form-group">
                            <label for="quantity">Quantity</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" value="1">
                        </div>

                        <div class="form-group">
                            <label for="weight">Weight</label><br>
                            <div class="form-check form-check-inline">
                                <input type="radio" name="weight" id="weight_250g" value="250g" {{ $productPrices->{'250g_quantity'} ? '' : 'disabled' }}>
                                <label class="{{ $productPrices->{'250g'} ? 'available' : 'out-of-stock' }}" for="weight_250g">250g ({{ $productPrices->{'250g'} }}Da)</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" name="weight" id="weight_500g" value="500g" {{ $productPrices->{'500g_quantity'} ? '' : 'disabled' }}>
                                <label class="{{ $productPrices->{'500g'} ? 'available' : 'out-of-stock' }}" for="weight_500g">500g ({{ $productPrices->{'500g'} ?? 'out of stock' }})</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" name="weight" id="weight_750g" value="750g" {{ $productPrices->{'750g_quantity'} ? '' : 'disabled' }}>
                                <label class="{{ $productPrices->{'750g'} ? 'available' : 'out-of-stock' }}" for="weight_750g">750g ({{ $productPrices->{'750g'} ?? 'out of stock' }})</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" name="weight" id="weight_1kg" value="1kg" {{ $productPrices->{'1kg_quantity'} ? '' : 'disabled' }}>
                                <label class="{{ $productPrices->{'1kg'} ? 'available' : 'out-of-stock' }}" for="weight_1kg">1kg ({{ $productPrices->{'1kg'} ?? 'out of stock' }})</label>
                            </div>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Add to Cart</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
