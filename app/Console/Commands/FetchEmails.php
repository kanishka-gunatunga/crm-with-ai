<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Webklex\IMAP\Facades\Client;
use App\Models\MailInbox;

class FetchEmails extends Command
{
    protected $signature = 'emails:fetch';
    protected $description = 'Fetch new emails using IMAP and store them in the database';

    public function handle()
    {
        $client = Client::account('default'); // Refers to config/imap.php
        $client->connect();

        $folder = $client->getFolder('INBOX');
        $messages = $folder->query()->unseen()->get(); // Only unseen emails

        foreach ($messages as $message) {
            MailInbox::create([
                'subject' => $message->getSubject(),
                'from' => $message->getFrom()[0]->mail ?? null,
                'body' => $message->getTextBody(),
                'received_at' => $message->getDate(),
            ]);
        }

        $this->info('Fetched and stored ' . count($messages) . ' new emails.');
    }
}
