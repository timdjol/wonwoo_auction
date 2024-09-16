<?php

namespace App\Models;

//use App\Services\CurrencyConversion;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id', 'sum', 'name', 'phone', 'email', 'product_id', 'product_title'];

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function showDate(){
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->format('d/m/Y H:i');
    }

}
