<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = [
        'code',
        'name',
    ];

    public function product() 
    {
        return $this->belongsToMany(Product::class, 'product_location')->withPivot('stock');    
    }
}
