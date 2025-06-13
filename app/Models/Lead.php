<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;

    protected $table = 'leads';
    protected $primaryKey = 'id';

    protected $fillable = [
        'title',
        'lead_value',
        'source',
        'type',
        'sales_owner',
        'closing_date',
        'description',
        'status',
        'category',
        'pipeline',
        'stage',
        'person',
        'won_value',
        'closed_date',
        'reason',
    ];

    public function person()
    {
        return $this->belongsTo(Person::class, 'person');
    }

}
