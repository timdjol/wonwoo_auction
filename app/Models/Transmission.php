<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transmission extends Model
{
    protected $fillable = ['product_id', 'image'];

    public function products(){
        return $this->belongsToMany(Product::class);
    }
}
