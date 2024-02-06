@extends('adminlte::page')

@section('content')
@if(session()->has('success'))
<div class="alert alert-success" role="alert">
    <h4 class="alert-heading">Well done! user deleted succefuly</h4>
  </div>
@endif
<div class="d-flex justify-content-center">
    <h1 class="">Your Products</h1>
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
                    <div class="px-2">
                        <a type="submit" href="{{ route('admin.product.edit', $product->id) }}" class="btn btn-primary">Edite</a>
                    </div>
                    
                    <form action="{{ route('admin.product.destroy', $product->id) }}" method="POST" style="display: inline;">
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
