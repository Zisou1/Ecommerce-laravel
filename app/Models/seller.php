<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use app\Models\User;

class seller extends Model
{
    protected $table = 'seller';
    use HasFactory;
    protected $fillable = [ 'Nom_entreprise','adress','nom_boutique','N_registre_commerce','logo_path','banner_path','NIF','NIS','user_id',];
    public function user(){
        return $this -> belongsTo(User::class);
    }
}
