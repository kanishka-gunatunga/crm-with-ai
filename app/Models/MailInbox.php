<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MailInbox extends Model
{
    use HasFactory;

    protected $table = 'mail_inbox';
    protected $primaryKey = 'id';

    protected $fillable = [
        'subject',
        'from',
        'body',
        'received_at'
    ];

}
