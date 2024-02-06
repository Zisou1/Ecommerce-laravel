<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [ 'order_number','total_amount','order_date','shipping_adress','wilaya','ville','zip','payment_methode','status','notes','user_id'];
    public function orderItems()
    {
        return $this->hasMany(OrderItems::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
