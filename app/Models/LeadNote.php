<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadNote extends Model
{
    use HasFactory;

    protected $table = 'lead_notes';
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'lead_id',
        'note',
        'created_by',
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }


}
