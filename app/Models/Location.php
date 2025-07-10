<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'name_location',
        'code_location',
    ];


    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_location')
                    ->using(ProductLocation::class)
                    ->withPivot('stok')
                    ->withTimestamps();
    }

}
