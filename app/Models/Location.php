<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = [
        'code',
        'name',
    ];

    public function products() 
    {
        return $this->belongsToMany(Product::class, 'product_location')->withPivot('stock');    
    }
}
