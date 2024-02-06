<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [ 'title','slug','marque','model','description','image_path','user_id'];
    public function user(){
        return $this -> belongsTo(User::class);
    }
    public function productprice(){
        return $this->HasOne(ProductPrice::class);
    }
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }
    
}
