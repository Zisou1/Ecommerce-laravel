<?php


namespace App\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductPrice;
use Illuminate\Support\Facades\File;

class AdminProductManagement extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $products = Product::all();
        
        return view('admin.product.index', ['products' => $products]);
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image_path' => 'required|mimes:jpg,png|max:5048',
            'model' => 'required',
            'marque' => 'required',
            'price_250g' => 'nullable|required_without_all:price_500g,price_750g,price_1kg|numeric',
        'price_500g' => 'nullable|required_without_all:price_250g,price_750g,price_1kg|numeric',
        'price_750g' => 'nullable|required_without_all:price_250g,price_500g,price_1kg|numeric',
        'price_1kg' => 'nullable|required_without_all:price_250g,price_500g,price_750g|numeric',

        ]);
    
        $slug = Str::slug($request->title, '-');
        $newImageName = uniqid() . '-' . $slug . '.' . $request->image_path->extension();
        $count = 1;
        while (Product::where('slug', $slug)->exists()) {
            $slug = $slug . '-' . $count;
            $count++;
        }
        $request->image_path->move(public_path('images'), $newImageName);
    
        $product = Product::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'image_path' => $newImageName,
            'slug' => $slug,
            'model' => $request->input('model'),
            'marque' => $request->input('marque'),
            'user_id' => auth()->user()->id,
        ]);
    
        $product->productprice()->create([
            '250g' => $request->input('price_250g'),
            '500g' => $request->input('price_500g'),
            '750g' => $request->input('price_750g'),
            '1kg' => $request->input('price_1kg'),
        ]);
    
        return redirect('/admin/product')->with('message', 'Product added successfully');
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
        $products = Product::findOrFail($id);

    return view('admin.product.edit')
        ->with('products', $products);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([

            'title'=>'required',
            'description'=>'required',
            'image_path'=>'required|mimes:jpg,png|max:5048',
            'model'=>'required',
            'marque'=>'required',
           ]);
           $slug= Str::slug($request->title,'-');
            $newImageName = uniqid() . '-' . $slug . '.' . $request->image_path->extension();
            $count = 1;
            while (Product::where('slug', $slug)->exists()) {
                $slug = $slug . '-' . $count;
                $count++;
             }
            $request->image_path->move(public_path('images'), $newImageName);

           Product::where('id',$id)
           ->update([
            'title'=> $request->input('title'),
            'description'=>$request->input('description'),
            'image_path' =>$newImageName,
            'slug'=>$slug,
            'model'=>$request->input('model'),
            'marque'=>$request->input('marque'),
            'user_id' => auth()->user()->id
    ]);
    return redirect('/admin/product')
    ->with('message','your subject is updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);

        // Delete the product image from storage
        $imagePath = public_path('images') . '/' . $product->image_path;
        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }

        $product->delete();

        return redirect('/admin/product')->with('success', 'Product deleted successfully');
    }

    
}
