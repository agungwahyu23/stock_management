<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProdukLokasi extends Model
{
    use HasFactory;
    protected $table= 'product_location';

    protected $fillable = [
        'product_id',
        'location_id',
        'stock',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function mutations()
    {
        return $this->hasMany(Mutation::class);
    }
}
