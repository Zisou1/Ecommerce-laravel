<?php

namespace App\Http\Controllers;
use App\Models\Seller;
use App\Models\User;
use Illuminate\Http\Request;

class MyProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user(); // Get the authenticated user
    $seller = Seller::where('user_id', $user->id)->first(); // Get the associated seller

    $data = [
        'user' => $user,
        'seller' => $seller
    ];

    return view('seller.MyAccountPage', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        $user = auth()->user(); // Get the authenticated user
    $seller = Seller::where('user_id', $user->id)->first(); // Get the associated seller

    $data = [
        'user' => $user,
        'seller' => $seller
    ];

    return view('seller.EditeAccount', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = auth()->user(); // Get the authenticated user
    $seller = Seller::where('user_id', $user->id)->first(); // Get the associated seller

    // Validate the request data
    $validatedData = $request->validate([
        'adress' => ['required', 'string'],
        'nom_boutique' => ['required', 'string'],
        'logo_path' => ['required', 'image'],
        'banner_path' => ['required', 'image'],
    ]);

    // Update the seller data
    $seller->adress = $validatedData['adress'];
    $seller->nom_boutique = $validatedData['nom_boutique'];

    // Handle logo upload
    if ($request->hasFile('logo_path')) {
        $logo = $request->file('logo_path');
        $logoName = time() . '_' . $logo->getClientOriginalName();
        $logo->move(public_path('images'), $logoName);
        $seller->logo_path = $logoName;
    }

    // Handle banner upload
    if ($request->hasFile('banner_path')) {
        $banner = $request->file('banner_path');
        $bannerName = time() . '_' . $banner->getClientOriginalName();
        $banner->move(public_path('images'), $bannerName);
        $seller->banner_path = $bannerName;
    }

    // Save the changes
    $seller->save();

    return redirect()->route('seller.MyAccount.index')->with('success', 'Profile updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
