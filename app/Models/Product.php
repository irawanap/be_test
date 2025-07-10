<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'name_product',
        'code_product',
        'category',
        'unit',
        'description',
    ];


    
    public function locations()
{
    return $this->belongsToMany(Location::class, 'product_location')
                ->using(ProductLocation::class)
                ->withPivot('stok')
                ->withTimestamps();
}
}
