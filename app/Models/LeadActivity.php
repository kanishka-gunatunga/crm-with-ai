<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadActivity extends Model
{
    use HasFactory;

    protected $table = 'lead_activities';
    protected $primaryKey = 'id';

    protected $fillable = [
        'lead_id',
        'title',
        'type',
        'from',
        'to',
        'location',
        'description',
        'participants',
        'is_completed',
        'created_by',
    ];

    protected $casts = [
        'participants' => 'array',   
    ];

}
