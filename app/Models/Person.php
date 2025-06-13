<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    protected $table = 'persons';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'organization',
        'emails',
        'contact_numbers',
    ];

    protected $casts = [
        'emails' => 'array',  
        'contact_numbers' => 'array',  
    ];

    public function leads()
    {
        return $this->hasMany(Lead::class, 'person');
    }
}
