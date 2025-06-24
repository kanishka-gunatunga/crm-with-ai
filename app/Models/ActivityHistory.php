<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityHistory extends Model
{
    use HasFactory;

    protected $table = 'activity_history';
    protected $primaryKey = 'id';

    protected $fillable = [
        'lead_id',
        'source',
        'source_id',
        'user_id',
        'action'
    ];

}
