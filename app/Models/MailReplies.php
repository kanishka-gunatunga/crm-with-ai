<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MailReplies extends Model
{
    use HasFactory;

    protected $table = 'mail_replies';
    protected $primaryKey = 'id';

    protected $fillable = [

        'to',
        'cc',
        'bcc',
        'subject',
        'body',
        'attachments',
        'parent_id'
    ];

    protected $casts = [
        'to' => 'array',
        'cc' => 'array',
        'bcc' => 'array',
        'attachments' => 'array',
    ];

    // Parent SentEmail (the email this reply belongs to)
    public function parent(): BelongsTo
    {
        return $this->belongsTo(SentEmails::class, 'parent_id');
    }

    // Replies (all MailReplies for this SentEmail)
    public function replies(): HasMany
    {
        return $this->hasMany(MailReplies::class, 'parent_id');
    }
}
