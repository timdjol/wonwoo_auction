<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Category extends Model
{

    protected $fillable = ['code', 'title', 'image', 'sort'];

    public function brands(){
        return $this->hasMany(Brand::class);
    }
    public function products(){
        return $this->hasMany(Product::class);
    }
}
