<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ticket extends Model
{
    use HasFactory;
    protected $fillable = ['title','priority','message','user_id','date_ouverture'];

    public function user(){
        return $this->belongsTo(User::class);
    }
    
}
