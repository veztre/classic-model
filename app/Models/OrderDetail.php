<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = 'orderdetails';
    public $incrementing = false;
    public $timestamps = false;
    protected $primaryKey = null;

    protected $fillable = [
        'orderNumber',
        'productCode',
        'quantityOrdered',
        'priceEach',
        'orderLineNumber'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'orderNumber', 'orderNumber');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'productCode', 'productCode');
    }
}