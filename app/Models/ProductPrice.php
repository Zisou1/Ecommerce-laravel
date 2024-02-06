<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPrice extends Model
{
    use HasFactory;
    protected $fillable = [ '250g','500g','750g','1kg','products_id','250g_quantity','500g_quantity','750g_quantity','1kg_quantity'];
    public function product(){
        return $this->belongsTo(Product::class);
    }
    public function getStockStatusAttribute()
{
    $quantityColumns = ['250g_quantity', '500g_quantity', '750g_quantity', '1kg_quantity'];

    foreach ($quantityColumns as $column) {
        if ($this->attributes[$column] === 0) {
            return 'Stock Rupture';
        }
    }

    return 'In Stock';
}
}
