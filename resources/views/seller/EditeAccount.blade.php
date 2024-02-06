@extends('layouts.seller')
@section('content')
<div class="text-center">
    <h1 class="font-weight-bold">Edite your Profile</h1>
</div>
<form action="{{ route('seller.MyAccount.update', $seller->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
<div class="row mb-3">
    <label for="title" class="col-md-4 col-form-label text-md-end">Adress boutique</label>
    <div class="col-md-5">
        <input id="title" type="text" class="form-control" value="{{$seller->adress}}" name="adress" placeholder="Adress" required>
    </div>
</div><div class="row mb-3">
    <label for="title" class="col-md-4 col-form-label text-md-end">Nom boutique</label>
    <div class="col-md-5">
        <input id="title" type="text" class="form-control" value="{{$seller->nom_boutique}}" name="nom_boutique" placeholder="Nom boutique" required>
    </div>
</div>
<div class="row mb-3">
    <label for="image_path" class="col-md-4 col-form-label text-md-end">Logo </label>
    <div class="col-md-5">
        <input class="form-control" type="file" id="image_path" name="logo_path" required>
    </div>
</div><div class="row mb-3">
    <label for="image_path" class="col-md-4 col-form-label text-md-end">Banner</label>
    <div class="col-md-5">
        <input class="form-control" type="file" id="image_path" name="banner_path" required>
    </div>
</div>
<div class="row mb-3">
    <div class="col-md-6 offset-md-4">
        <button type="submit" class="btn btn-primary">Update Profil</button>
    </div>
</div>
</form>
@endsection