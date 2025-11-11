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
        'dob',
    ];

    protected $casts = [
        'emails' => 'array',  
        'contact_numbers' => 'array',  
        'custom_attributes' => 'array',
    ];

    public function leads()
    {
        return $this->hasMany(Lead::class, 'person');
    }

     public function organization()
    {
        return $this->belongsTo(Organization::class, 'organization');
    }

     public function quotes()
    {
        return $this->hasMany(Quote::class, 'person', 'id');
    }
}
