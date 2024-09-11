<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'phone',
        'email',
        'phone2',
        'address',
        'whatsapp',
        'instagram',
        'facebook',
        'tiktok',
        'telegram',
        'date_auc',
        'sum_auc',
        'time_auc'
    ];
}
