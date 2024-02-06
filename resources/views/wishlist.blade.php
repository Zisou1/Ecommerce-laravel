@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="card shadow">
        <div class="card-body">
            @if($wishlist->count()>0)
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
                    @foreach ($wishlist as $item)
                        <tr>
                            <td>{{ $item->product->title }}</td>
                            <td>{{ $item->product->description }}</td>
                            <td>{{ $item->product->model }}</td>
                            <td>{{ $item->product->marque }}</td>
                            <td class="d-flex">
                                <form action="{{ route('user.wishlist.destroy', $item->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                                </form>
                                <div class="px-2">
                                    <a href="/product/{{$item->product->slug}}" class="btn btn-primary">Add to Cart</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <h4>There are no products in your wishlist.</h4>
            @endif
        </div>
    </div>
</div>
@endsection
