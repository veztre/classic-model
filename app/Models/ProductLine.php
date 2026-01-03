<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductLine extends Model
{
    protected $table = 'productlines';
    protected $primaryKey = 'productLine';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'productLine',
        'textDescription',
        'htmlDescription',
        'image'
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'productLine', 'productLine');
    }
}
