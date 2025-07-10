<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ProductLocation extends Pivot
{
    use HasFactory;

    protected $table = 'product_location';

    protected $fillable = [
        'product_id',
        'location_id',
        'stok',
    ];

    public $timestamps = true;
}
