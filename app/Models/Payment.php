<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{

    use SoftDeletes;
    protected $fillable = [
        'name',
        'email',
        'phone',
        'sum',
        'user_id'
    ];

    public function users(){
        return $this->hasMany(User::class);
    }
}
