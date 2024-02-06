<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\Product;

class ProductQrcodeController extends Controller
{
    public function generateQrCode($id)
    {
        $product = Product::findOrFail($id);
        $productTitle = $product->title;

        $qrCode = QrCode::size(400)->generate($productTitle);
        $imagePath = public_path('qrcodes/' . $product->id . '.png');
        File::put($imagePath, $qrCode);

        // Optionally, you can return the image path to display it in the view
        return view('your-view')->with('imagePath', $imagePath);
    }

    public function showQrCode($id)
{
    $product = Product::findOrFail($id);
    $productTitle = $product->title;

    $qrCode = QrCode::size(400)->generate($productTitle);
    $imagePath = public_path('qrcodes/' . $product->id . '.png');
    File::put($imagePath, $qrCode);

    return response()->file($imagePath);
}
}
