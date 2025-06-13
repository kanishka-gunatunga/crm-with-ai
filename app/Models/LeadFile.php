<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadFile extends Model
{
    use HasFactory;

    protected $table = 'lead_files';
    protected $primaryKey = 'id';

    protected $fillable = [
        'lead_id',
        'name',
        'description',
        'file'
    ];


}
