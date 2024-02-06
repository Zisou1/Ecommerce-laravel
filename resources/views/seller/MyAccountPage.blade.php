@extends('layouts.seller')

@section('content')
<style>
    .banner {
            background-color: #f2f2f2;
            text-align: center;
            overflow: hidden;
            height: 200px; /* Adjust the height as needed */
        }

        .banner-image {
            width: 100%;
            height: auto;
            object-fit: cover;
        }

        .logo {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            object-position: center;
        }

    .card {
        background-color: #ffffff;
        border: none;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        padding: 30px;
    }

    .card-title {
        font-size: 28px;
        font-weight: bold;
        margin-bottom: 20px;
        color: #333333;
    }

    .account-info {
        margin-bottom: 20px;
    }

    .account-info p {
        font-size: 18px;
        margin-bottom: 10px;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        padding: 10px 30px;
        font-size: 16px;
        font-weight: bold;
        text-transform: uppercase;
        color: #ffffff;
        transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }
</style>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="banner">
                    <img src="/images/{{ $seller->banner_path }}" alt="Banner" class="img-fluid">
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center mb-4">
                            <img src="/images/{{ $seller->logo_path }}" alt="Logo" class="img-fluid logo">
                        </div>
                        <h3 class="card-title text-center mb-4">{{$seller->nom_boutique}}</h3>
                        <div class="account-info">
                            <p><strong>Name:</strong> {{ $user->name }}</p>
                            <p><strong>Email:</strong> {{ $user->email }}</p>
                            <div class="text-center mt-4">
                                <a href="{{ route('seller.MyAccount.edit', ['MyAccountPage' => $seller]) }}" class="btn btn-primary">Edit Profile</a>

                            </div>
                            
                            <!-- Add more account information as needed -->
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


