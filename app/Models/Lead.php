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
        'priority',
        'start_date',
    ];

    public function person()
    {
        return $this->belongsTo(Person::class, 'person');
    }
    public function source()
    {
        return $this->belongsTo(Source::class, 'source');
    }

    public function type()
    {
        return $this->belongsTo(Type::class, 'type');
    }

    public function salesOwner()
    {
        return $this->belongsTo(UserDetails::class, 'sales_owner');
    }

    public function quotes()
    {
        return $this->hasMany(Quote::class, 'lead_id');
    }


    public function leadnotes()
    {
        return $this->hasMany(LeadNote::class, 'lead_id');
    }

    public function emails()
    {
        return $this->hasMany(SentEmails::class, 'lead_id');
    }

}
