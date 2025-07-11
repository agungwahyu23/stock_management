<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mutation extends Model
{
    protected $fillable = [
        'user_id',
        'product_location_id',
        'date',
        'mutation_type',
        'qty',
        'note',
    ];

    public function user() 
    {
        return $this->belongsTo(User::class, 'user_id');    
    }

    public function product_location() 
    {
        return $this->belongsTo(ProdukLokasi::class, 'product_location_id');    
    }
}
