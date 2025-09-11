<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;

    protected $table = 'organizations';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'address',
        'country',
        'state',
        'city',
        'post_code',
        'emails'
    ];

    protected $casts = [
        'emails' => 'array'
    ];


    public function persons()
    {
        return $this->hasMany(Person::class, 'organization');
    }
}
