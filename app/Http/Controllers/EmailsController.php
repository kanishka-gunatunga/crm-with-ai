<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\OtherUserDetails;
use App\Models\Pipeline;
use App\Models\PipelineStage;
use App\Models\Source;
use App\Models\Type;
use App\Models\Group;
use App\Models\EmailTemplate;
use App\Models\SentEmails;

use File;
use PDF;
use Mail;
use League\Csv\Writer;
use App\Mail\LeadSendEmail;
date_default_timezone_set('Asia/Colombo');

class EmailsController extends Controller
{
    public function emails(Request $request)
    {
        if($request->isMethod('get')){

            $sent_emails = SentEmails::get();

            return view('emails.emails', [
                'sent_emails' => $sent_emails
            ]);
         }
        
    }
   
    public function compose_email(Request $request)
    {
        if($request->isMethod('post')){
            $request->validate([
                'to' => 'required',
                'subject' => 'required|string|max:255',
                'body' => 'required|string',
            ]);
    
            $sent_email =  new SentEmails();
            $sent_email->to = $request->to;
            $sent_email->cc = $request->cc;
            $sent_email->bcc = $request->bcc;
            $sent_email->subject = $request->subject;
            $sent_email->body = $request->body;

            $attachments = [];
            if ($request->hasFile('attchments')) {
                foreach ($request->file('attchments') as $file) {
                    $filename = time() . '_' . uniqid() . '_.' . $file->extension();
                    $file->move(public_path('uploads/leads/email_attachments'), $filename);
                    $attachments[] = $filename;
                }
            }

            $sent_email->attachments = $attachments;
            $sent_email->save();

            Mail::to($request->to)
            ->cc($request->cc ?? [])
            ->bcc($request->bcc ?? [])
            ->send(new LeadSendEmail($sent_email));

            return back()->with('success', 'Email sent successfully.');
        }
        
    }

}



