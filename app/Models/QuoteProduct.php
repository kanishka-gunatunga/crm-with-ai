<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuoteProduct extends Model
{
    use HasFactory;

    protected $table = 'quote_products';
    protected $primaryKey = 'id';

    protected $fillable = [
        'quote_id',
        'type',
        'product_id',
        'note',
        'quantity',
        'price',
        'amount',
        'discount',
        'tax',
        'total'
    ];

}
