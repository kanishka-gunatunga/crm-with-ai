<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;

    protected $table = 'attributes';
    protected $primaryKey = 'id';

    protected $fillable = [
        'code',
        'name',
        'entity_type',
        'type',
        'is_required',
        'is_unique',
        'input_validation',
        'option_type',
        'lookup_type',
        'options',
    ];
    protected $casts = [
        'options' => 'array',   
    ];

}
