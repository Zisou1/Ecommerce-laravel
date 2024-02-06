@extends('adminlte::page')
@section('content')





    <div class="text-center">
        <h1 class="font-weight-bold"> Edite your Product </h1>
    </div>
<form action="{{route('admin.product.update', $products->id) }} "method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row mb-3">
        <label for="title" class="col-md-4 col-form-label text-md-end">Title</label>
        <div class="col-md-5">
            <input id="title" type="text" class="form-control " name="title" value="{{$products->title}}" >

        </div>
    </div>
    <div class="row mb-3">
        <label for="model" class="col-md-4 col-form-label text-md-end">Model</label>
        <div class="col-md-5">
            <input id="model" type="text" class="form-control " name="model" value="{{$products->model}}">

        </div>
    </div>
    <div class="row mb-3">
        <label for="marque" class="col-md-4 col-form-label text-md-end">Marque</label>
        <div class="col-md-5">
            <input id="marque" type="text" class="form-control " name="marque" value="{{$products->marque}}">

        </div>
    </div>
    <div class="row mb-3">
        <label for="text" class="col-md-4 col-form-label text-md-end">Description</label>
        <div class="col-md-5" style="height:150px;">
            <input id="description" type="text" class="form-control" name="description" style="height:150px;" value="{{$products->description}}">

    </div>
    
    
    </div>
    <div class="row mb-3">
        <label for="formFile" class="col-md-4 col-form-label text-md-end"> Please upload the image</label>
        <div class="col-md-5"><input class="form-control" type="file" id="" name="image_path"></div>
        
    </div>
    <div class="row mb-3">
        <label  class="col-md-4 col-form-label text-md-end">Submit your product</label>
        <div class="col-md-5">
            <button type="submit" class="btn btn-primary btn-lg btn-block">Submit</button>
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