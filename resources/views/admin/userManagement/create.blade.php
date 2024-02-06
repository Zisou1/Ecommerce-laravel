@extends('adminlte::page')
@section('content')
<div class="container">
    
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.users.store') }}">
                        @csrf
                        <div class="row mb-3">
                            <label for="role" class="col-md-4 col-form-label text-md-end">{{ __('role') }}</label>

                            <div class="col-md-2">
                                <select id="role" name="role" class="form-control" onchange="toggleSellerForm()">
                                    <option value="user">User</option>
                                   <option value="seller">Seller</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <label for="prenom" class="col col-form-label text-md">{{ __('Prenom') }}</label>
                            <div class="col">
                                <input id="Prenom" type="text" class="form-control @error('name') is-invalid @enderror" name="Prenom" value="{{ old('Prenom') }}" required autocomplete="Prenom" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="N_tel" class="col-md-4 col-form-label text-md-end">Numero telephone</label>

                            <div class="col-md-6">
                                <input id="N_tel" type="number" class="form-control @error('N_tel') is-invalid @enderror" name="N_tel" value="{{ old('N_tel') }}" required autocomplete="N_tel">

                                @error('N_tel')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div id="sellerFormFields" style="display: none;">
                            <!-- Additional form fields for sellers -->
                            <div class="row mb-3">
                                <label for="Nom_entreprise" class="col-md-4 col-form-label text-md-end">{{ __('Nom entreprise ') }}</label>
    
                                <div class="col-md-6">
                                    <input id="Nom_entreprise" type="text" class="form-control @error('Nom_entreprise') is-invalid @enderror" name="Nom_entreprise" value="{{ old('Nom_entreprise') }}" required autocomplete="Nom_entreprise">
    
                                    @error('Nom_entreprise')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="shopName" class="col-md-4 col-form-label text-md-end">{{ __('Shop Name') }}</label>
                                <div class="col-md-6">
                                    <input type="text" id="nom_boutique" name="nom_boutique" class="form-control">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="adress" class="col-md-4 col-form-label text-md-end">{{ __('Shop Address') }}</label>
                                <div class="col-md-6">
                                    <input type="text" id="adress" name="adress" class="form-control">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="Numero registre commerce" class="col-md-4 col-form-label text-md-end">{{ __('Numero registre commerce') }}</label>
    
                                <div class="col-md-6">
                                    <input id="N_registre_commerce" type="text" class="form-control @error('Numero registre commerce') is-invalid @enderror" name="N_registre_commerce" required autocomplete="new-numero">
    
                                    @error('Numero registre commerce')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="NIF" class="col-md-4 col-form-label text-md-end">{{ __('NIF') }}</label>
    
                                <div class="col-md-6">
                                    <input id="NIF" type="text" class="form-control @error('NIF') is-invalid @enderror" name="NIF" required autocomplete="new-numero">
    
                                    @error('NIF')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="NIS" class="col-md-4 col-form-label text-md-end">{{ __('NIS') }}</label>
    
                                <div class="col-md-6">
                                    <input id="NIS" type="text" class="form-control @error('NIS') is-invalid @enderror" name="NIS" required autocomplete="new-numero">
    
                                    @error('NIS')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                        
                        
                        
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                    <script>
                        
                        function toggleSellerForm() {
                          var role = document.getElementById("role").value;
                          var sellerForm = document.getElementById("sellerFormFields");
                          var sellerInputs = sellerForm.getElementsByTagName("input");

                          if (role === "seller") {
                            sellerForm.style.display = "block";
                            for (var i = 0; i < sellerInputs.length; i++) {
                              sellerInputs[i].disabled = false;
                            }
                          } else {
                            sellerForm.style.display = "none";
                            for (var i = 0; i < sellerInputs.length; i++) {
                              sellerInputs[i].disabled = true;
                            }
                          }
                        }
                        toggleSellerForm(); // Call the function initially to set the form state
                    
                      </script>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection