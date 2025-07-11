<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProdukLokasi extends Model
{
    protected $table= 'product_location';

    protected $fillable = [
        'product_id',
        'location_id',
        'stock',
    ];
}
