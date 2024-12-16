<?php

namespace App\Models;

//use App\Services\CurrencyConversion;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    protected $fillable = ['user_id', 'sum', 'name', 'phone', 'email', 'product_id', 'product_title', 'status', 'date'];

    public function scopeActive($query)

    {
        return $query->where('status', 1);
    }

    public function showDate()
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->format('d/m/Y H:i');
    }

}
