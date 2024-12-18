<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'brand',
        'quantity',
        //'expiration_date',
        'price',
        'image',
    ];

    public function stores()
    {
        return $this->belongsToMany(Store::class, 'store_product');
    }
}
