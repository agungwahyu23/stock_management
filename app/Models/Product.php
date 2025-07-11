<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'code',
        'category_id',
        'unit',
    ];

    public function location() 
    {
        return $this->belongsToMany(Location::class, 'product_location')->withPivot('stock');    
    }
}
