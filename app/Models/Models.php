<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Models extends Model
{
    protected $fillable = ['code', 'title', 'brand_id'];

    public function brand(){
        return $this->belongsTo(Brand::class);
    }
    public function products(){
        return $this->hasMany(Product::class);
    }
}
