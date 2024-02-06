<?php


namespace App\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductPrice;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $products = Product::where('user_id', $user->id)->get();
        
        return view('seller.product.index', ['products' => $products]);
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('seller.product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
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
        'quantity_250g' => 'nullable|required_with:price_250g|numeric',
        'price_500g' => 'nullable|required_without_all:price_250g,price_750g,price_1kg|numeric',
        'quantity_500g' => 'nullable|required_with:price_500g|numeric',
        'price_750g' => 'nullable|required_without_all:price_250g,price_500g,price_1kg|numeric',
        'quantity_750g' => 'nullable|required_with:price_750g|numeric',
        'price_1kg' => 'nullable|required_without_all:price_250g,price_500g,price_750g|numeric',
        'quantity_1kg' => 'nullable|required_with:price_1kg|numeric',
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
        '250g_quantity' => $request->input('quantity_250g'),
        '500g' => $request->input('price_500g'),
        '500g_quantity' => $request->input('quantity_500g'),
        '750g' => $request->input('price_750g'),
        '750g_quantity' => $request->input('quantity_750g'),
        '1kg' => $request->input('price_1kg'),
        '1kg_quantity' => $request->input('quantity_1kg'),
    ]);

    return redirect('/seller/product')->with('message', 'Product added successfully');
}


    /**
     * Display the specified resource.
     */
    public function show(string $slug)
{
    $product = Product::where('slug', $slug)->first();
    $productPrices = ProductPrice::where('product_id', $product->id)->first();

    return view('user.product.show', [
        'product' => $product,
        'productPrices' => $productPrices,
    ]);
}


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $products = Product::findOrFail($id);

    return view('seller.product.edit')
        ->with('products', $products);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    $request->validate([
        'title' => 'required',
        'description' => 'required',
        'image_path' => 'nullable|mimes:jpg,png|max:5048',
        'model' => 'required',
        'marque' => 'required',
        'price_250g' => 'nullable|required_without_all:price_500g,price_750g,price_1kg|numeric',
        'quantity_250g' => 'nullable|required_with:price_250g|numeric',
        'price_500g' => 'nullable|required_without_all:price_250g,price_750g,price_1kg|numeric',
        'quantity_500g' => 'nullable|required_with:price_500g|numeric',
        'price_750g' => 'nullable|required_without_all:price_250g,price_500g,price_1kg|numeric',
        'quantity_750g' => 'nullable|required_with:price_750g|numeric',
        'price_1kg' => 'nullable|required_without_all:price_250g,price_500g,price_750g|numeric',
        'quantity_1kg' => 'nullable|required_with:price_1kg|numeric',
    ]);

    $product = Product::findOrFail($id);

    // Update the product data
    $product->title = $request->input('title');
    $product->description = $request->input('description');
    $product->model = $request->input('model');
    $product->marque = $request->input('marque');

    // Update the image if a new one is provided
    if ($request->hasFile('image_path')) {
        $request->validate([
            'image_path' => 'mimes:jpg,png|max:5048',
        ]);

        // Delete the old image file
        $oldImagePath = public_path('images') . '/' . $product->image_path;
        if (File::exists($oldImagePath)) {
            File::delete($oldImagePath);
        }

        // Upload and store the new image
        $newImageName = uniqid() . '-' . Str::slug($request->title, '-') . '.' . $request->image_path->extension();
        $request->image_path->move(public_path('images'), $newImageName);
        $product->image_path = $newImageName;
    }

    $product->save();

    // Update the product prices and quantities
    $productPrice = $product->productprice;
    $productPrice->fill([
        '250g' => $request->input('price_250g'),
        '250g_quantity' => $request->input('quantity_250g'),
        '500g' => $request->input('price_500g'),
        '500g_quantity' => $request->input('quantity_500g'),
        '750g' => $request->input('price_750g'),
        '750g_quantity' => $request->input('quantity_750g'),
        '1kg' => $request->input('price_1kg'),
        '1kg_quantity' => $request->input('quantity_1kg'),
    ]);
    $productPrice->save();

    return redirect('/seller/product')->with('message', 'Product updated successfully');
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

        return redirect('/seller/product')->with('success', 'Product deleted successfully');
    }

    
}
