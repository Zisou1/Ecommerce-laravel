@extends('adminlte::page')
@section('content')

<div class="text-center">
    <h1 class="font-weight-bold">Add a new Product</h1>
</div>

<form action="/admin/product" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row mb-3">
        <label for="title" class="col-md-4 col-form-label text-md-end">Title</label>
        <div class="col-md-5">
            <input id="title" type="text" class="form-control" name="title" placeholder="Title" required>
        </div>
    </div>
    <div class="row mb-3">
        <label for="model" class="col-md-4 col-form-label text-md-end">Model</label>
        <div class="col-md-5">
            <input id="model" type="text" class="form-control" name="model" placeholder="Model" required>
        </div>
    </div>
    <div class="row mb-3">
        <label for="marque" class="col-md-4 col-form-label text-md-end">Marque</label>
        <div class="col-md-5">
            <input id="marque" type="text" class="form-control" name="marque" placeholder="Marque" required>
        </div>
    </div>

    <div class="row mb-3">
        <label for="description" class="col-md-4 col-form-label text-md-end">Description</label>
        <div class="col-md-5">
            <textarea id="description" class="form-control" name="description" rows="4" placeholder="Description" required></textarea>
        </div>
    </div>
    <div class="row mb-3">
        <label for="price_250g" class="col-md-4 col-form-label text-md-end">Price (250g)</label>
        <div class="col-md-5">
            <input id="price_250g" type="number" step="0.01" min="0" class="form-control" name="price_250g" placeholder="Price (250g)">
        </div>
    </div>
    <div class="row mb-3">
        <label for="price_500g" class="col-md-4 col-form-label text-md-end">Price (500g)</label>
        <div class="col-md-5">
            <input id="price_500g" type="number" step="0.01" min="0" class="form-control" name="price_500g" placeholder="Price (500g)">
        </div>
    </div>
    <div class="row mb-3">
        <label for="price_750g" class="col-md-4 col-form-label text-md-end">Price (750g)</label>
        <div class="col-md-5">
            <input id="price_750g" type="number" step="0.01" min="0" class="form-control" name="price_750g" placeholder="Price (750g)">
        </div>
    </div>
    <div class="row mb-3">
        <label for="price_1kg" class="col-md-4 col-form-label text-md-end">Price (1kg)</label>
        <div class="col-md-5">
            <input id="price_1kg" type="number" step="0.01" min="0" class="form-control" name="price_1kg" placeholder="Price (1kg)">
        </div>
    </div>
    <div class="row mb-3">
        <label for="image_path" class="col-md-4 col-form-label text-md-end">Please upload the image</label>
        <div class="col-md-5">
            <input class="form-control" type="file" id="image_path" name="image_path" required>
        </div>
    </div>

    

    <div class="row mb-3">
        <div class="col-md-6 offset-md-4">
            <button type="submit" class="btn btn-primary">Add Product</button>
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
