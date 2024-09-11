<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{

    protected $fillable = ['code', 'title'];

    public function brands(){
        return $this->hasMany(Brand::class);
    }
    public function products(){
        return $this->hasMany(Product::class);
    }
}
