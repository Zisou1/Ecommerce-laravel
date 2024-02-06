<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\seller;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected function redirectTo(){
        if(auth()->user()->role === 'admin'){
            return '/admin/dashboard';
        }
        if(auth()->user()->role === 'seller'){
            return '/seller/dashboard';
        }
        else{
            return'/';
        }
    }
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'N_tel' => ['required'],
            'role' => ['required', 'string', 'in:seller,user'],
            'Prenom' => ['required', 'string', 'max:255'],
        ];
    
        if ($data['role'] === 'seller') {
            $rules = array_merge($rules, [
                'Nom_entreprise' => ['required', 'string', 'max:255'],
                'adress' => ['required', 'string'],
                'nom_boutique' => ['required', 'string', 'max:255'],
                'N_registre_commerce' => ['required'],
                'NIF' => ['required'],
                'NIS' => ['required'],
            ]);
        }
    

    return Validator::make($data, $rules);
}


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user= User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'N_tel' =>$data['N_tel'],
            'role' =>$data['role'],
            'Prenom'=>$data['Prenom'],
        ]);
        $Logo='Profil.png';
        $Banner='Banner.jpg';
        if($data['role']==='seller'){
    $seller= seller::create([
        'Nom_entreprise' => $data['Nom_entreprise'],
        'adress' => $data['adress'],
        'nom_boutique' =>$data['nom_boutique'],
        'N_registre_commerce' =>$data['N_registre_commerce'],
        'NIF' =>$data['NIF'],
        'NIS'=>$data['NIS'],
        'logo_path'=>$Logo,
        'banner_path'=>$Banner,
        'user_id' => $user->id,
    ]);
    
};
       
    
    return $user;

}
}

/*if($data['role']==='seller'){
    $seller= seller::create([
        'Nom_entreprise' => $data['Nom_entreprise'],
        'adress' => $data['adress'],
        'nom_boutique' =>$data['nom_boutique'],
        'N_registre_commerce' =>$data['N_registre_commerce'],
        'NIF' =>$data['NIF'],
        'NIS'=>$data['NIS'],
        'user_id' => $user->id,
    ]);
    
};*/