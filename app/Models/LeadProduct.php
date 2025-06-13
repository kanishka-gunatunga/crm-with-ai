<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadProduct extends Model
{
    use HasFactory;

    protected $table = 'lead_products';
    protected $primaryKey = 'id';

    protected $fillable = [
        'lead_id',
        'type',
        'product_id',
        'price',
        'quantity',
        'amount'
    ];



}
