<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Store extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    //use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'image',
        'location',
    ];

    /**
     * The roles that belong to the Store
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_store');
    }
}
