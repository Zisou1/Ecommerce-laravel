<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\seller;

class UserManagement extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $user = User::all();
        
        return view('admin.userManagement.index', ['user' => $user]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.userManagement.create');
    }

    /**
     * Store a newly created resource in storage.
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
public function store(Request $data)
{
    $this->validator($data->all())->validate();

    $user = User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
        'N_tel' => $data['N_tel'],
        'role' => $data['role'],
        'Prenom' => $data['Prenom'],
    ]);

    if ($data['role'] === 'seller') {
        $seller = Seller::create([
            'Nom_entreprise' => $data['Nom_entreprise'],
            'adress' => $data['adress'],
            'nom_boutique' => $data['nom_boutique'],
            'N_registre_commerce' => $data['N_registre_commerce'],
            'NIF' => $data['NIF'],
            'NIS' => $data['NIS'],
            'user_id' => $user->id,
        ]);
    }

    return redirect('/admin/userManagement')->with('success', 'User added successfully');
}

    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        // Delete the product image from storage
        $imagePath = public_path('images') . '/' . $user->image_path;
        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }

        $user->delete();

        return redirect('/admin/userManagement')->with('success', 'Product deleted successfully');
    }
}
