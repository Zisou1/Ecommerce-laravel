
@extends('adminlte::page')

@section('content')
@if(session()->has('success'))
<div class="alert alert-success" role="alert">
    <h4 class="alert-heading">Well done! user deleted succefuly</h4>
  </div>
@endif
<div class="d-flex justify-content-center">
    <h1 class="">Yazu users</h1>
  </div>
<div class="container">
    <btn type="submit" class=" btn btn-primary" ><a href="{{"/admin/userManagement/create"}}" style="color:white;"> Add a user</a> </btn>
</div>
<table class="table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Prenom</th>
            <th>E-mail</th>
            <th>Numero</th>
            <th>role</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($user as $users)
            <tr>
                <td>{{ $users->name }}</td>
                <td>{{ $users->Prenom }}</td>
                <td>{{ $users->email }}</td>
                <td>{{ $users->N_tel }}</td>
                <td>{{ $users->role }}</td>
                <td class="d-flex">
                    
                    <form action="{{ route('admin.users.destroy', $users->id) }}" method="POST" style="display: inline;">
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