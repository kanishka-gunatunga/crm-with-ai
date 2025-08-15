<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SentEmails extends Model
{
    use HasFactory;

    protected $table = 'sent_emails';
    protected $primaryKey = 'id';

    protected $fillable = [
        'lead_id',
        'to',
        'cc',
        'bcc',
        'subject',
        'body',
        'attachments',
        'is_favourite',
    ];

    protected $casts = [
        'to' => 'array', 
        'cc' => 'array', 
        'bcc' => 'array',   
        'attachments' => 'array',   
    ];

}
