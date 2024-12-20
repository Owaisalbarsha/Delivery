<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Favorite;
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
    protected $hidden=['created_at','updated_at'];


    public function stores()
    {
        return $this->belongsToMany(Store::class, 'store_product');
    }
    public function favorites(){
        return $this->hasMany('Favorite','product_id');
    }
}
