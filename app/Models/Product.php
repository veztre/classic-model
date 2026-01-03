<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'productCode';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'productCode',
        'productName',
        'productLine',
        'productScale',
        'productVendor',
        'productDescription',
        'quantityInStock',
        'buyPrice',
        'MSRP'
    ];

    public function productLine()
    {
        return $this->belongsTo(ProductLine::class, 'productLine', 'productLine');
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'productCode', 'productCode');
    }
}
