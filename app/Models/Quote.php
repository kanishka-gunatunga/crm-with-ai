<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    use HasFactory;

    protected $table = 'quotes';
    protected $primaryKey = 'id';

    protected $fillable = [
        'lead',
        'owner',
        'subject',
        'expired_at',
        'person',
        'description',
        'address',
        'country',
        'state',
        'city',
        'post_code',
        'shipping_address',
        'shipping_country',
        'shipping_state',
        'shipping_city',
        'shipping_post_code',
        'discount_total_amount',
        'tax_total_amount',
        'order_total_input',
        'pdf'
    ];

    public function lead()
    {
        return $this->belongsTo(Lead::class, 'lead');
    }

}
