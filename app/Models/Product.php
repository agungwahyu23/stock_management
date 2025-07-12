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

    public function locations() 
    {
        return $this->belongsToMany(Location::class, 'product_location')->withPivot('stock')->withTimestamps();    
    }

    public function mutations()
    {
        return $this->hasManyThrough(Mutation::class, ProdukLokasi::class);
    }
}
