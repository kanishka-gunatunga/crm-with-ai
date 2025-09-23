<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
        'sent_by',
        'parent_id'
    ];

    protected $casts = [
        'to' => 'array',
        'cc' => 'array',
        'bcc' => 'array',
        'attachments' => 'array',
        'is_favourite' => 'boolean',
    ];

    // Parent (the email this one replies to)
    public function parent(): BelongsTo
    {
        return $this->belongsTo(SentEmails::class, 'parent_id');
    }

    // Replies (all emails that replied to this one)
    public function replies()
    {
        return $this->hasMany(MailReplies::class, 'parent_id');
    }

    public function lead(): BelongsTo
    {
        return $this->belongsTo(Lead::class, 'lead_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }
}
