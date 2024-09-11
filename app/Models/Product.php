<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'code',
        'title',
        'category_id',
        //'description',
        'image',
        'price',
        'price_sale',
        'brand_id',
        'models_id',
        'year',
        'oil',
        'engine',
        'transmission',
        'color',
        'drive',
        'markup',
        'parking',
        'vin',
        'mile',
        'steer',
        'type_own',
        'state',
        'power',
        'size',
        'type_wheel',
        'count_place',
        'salon_material',
        'salon_color',
        'youtube',
        'youtube2',
        'volume',
        'complex',
        'lot',
        'dateLot',
        'class',
        'stick',
        'comment',
        'tengine',
        'ttransmission',
        'tsuspension',
        'tbrake',
        'tsalon',
        'tbody',
        'status',
        'plk',
        'pld',
        'zld',
        'zlk',
        'pt',
        'pll',
        'ppl',
        'pk',
        'k',
        'zk',
        'zll',
        'zpl',
        'zt',
        'ppk',
        'ppd',
        'zpd',
        'zpk',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brands()
    {
        return $this->belongsTo(Brand::class);
    }

    public function models()
    {
        return $this->belongsTo(Models::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function images()
    {
        return $this->belongsToMany(Image::class, 'images');
    }

    public function engines()
    {
        return $this->belongsToMany(Engine::class, 'engines');
    }

    public function transmissions()
    {
        return $this->belongsToMany(Transmission::class, 'engines');
    }

    public function suspensions()
    {
        return $this->belongsToMany(Suspension::class, 'engines');
    }

    public function brakes()
    {
        return $this->belongsToMany(Brake::class, 'engines');
    }

    public function salons()
    {
        return $this->belongsToMany(Salon::class, 'engines');
    }

    public function bodies()
    {
        return $this->belongsToMany(Body::class, 'engines');
    }

    public function scopeByCode($query, $code)
    {
        return $query->where('code', $code);
    }


}
