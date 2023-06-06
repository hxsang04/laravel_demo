<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'price',
        'description',
        'image',
            
    ];

    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class,'product_order','product_id', 'order_id')
                    ->withPivot('quantity', 'unit_price');
    }
}
