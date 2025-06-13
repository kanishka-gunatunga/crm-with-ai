<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetails extends Model
{
    use HasFactory;

    protected $table = 'user_details';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'groups',
        'image',
    ];

    protected $casts = [
        'groups' => 'array'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
