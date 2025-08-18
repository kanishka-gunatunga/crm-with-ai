<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Mailer;
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
// use Mail;
use League\Csv\Writer;
use App\Mail\LeadSendEmail;

date_default_timezone_set('Asia/Colombo');

class EmailsController extends Controller
{
    public function emails(Request $request)
    {
        if ($request->isMethod('get')) {

            $sent_emails = SentEmails::get();
            return view('mail.mail', [
                'sent_emails' => $sent_emails,
                
            ]);
        }
    }


    public function fetch_favourite_emails(Request $request)
    {
        if ($request->isMethod('get')) {
            $favourite_emails = SentEmails::where('is_favourite', 1)->get();
             return response()->json($favourite_emails);
        }
    }

    public function compose_email(Request $request)
    {
        if ($request->isMethod('post')) {
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
        } else {
            return view('mail.compose-mail');
        }
    }


    public function view_email(Request $request, $uid)
    {
        if ($request->isMethod('post')) {
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
        } else {
            // return view('mail.email-view');
            $sent_email = SentEmails::find($uid);
            // dd($sent_email);
            // $sent_email = SentEmails::find($uid);
            if (!$sent_email) {
                return redirect()->back()->with('error', 'Email not found.');
            }

            return view('mail.email-view', ['mail' => $sent_email]);
        }
    }
    public function delete_selected_emails(Request $request)
    {
        $emailIds = $request->input('selected_emails', []);

        if (!empty($emailIds)) {
            SentEmails::whereIn('id', $emailIds)->delete();
            return back()->with('success', 'Selected emails deleted successfully.');
        }

        return back()->with('error', 'No attributes selected.');
    }

    public function toggleFavourite($id, Request $request)
    {
        
        
        $mail = SentEmails::find($id);
        
        $mail->is_favourite = !$mail->is_favourite;
        $mail->save();

        return response()->json([
            'success' => true,
            'favourited' => (bool) $mail->is_favourite, // Ensure it's a boolean in the response
            'message' => $mail->is_favourite ? 'Mail marked as favourite' : 'Mail removed from favourites'
        ]);
    }


    public function reply(Request $request, $parentId)
{
    $request->validate([
        'body' => 'required|string',
    ]);

    $parentEmail = SentEmails::findOrFail($parentId);

    $reply = new SentEmails();
    $reply->to = $parentEmail->to;   // replies usually go to original sender/recipient
    $reply->cc = $request->cc ?? [];
    $reply->bcc = $request->bcc ?? [];
    $reply->subject = $parentEmail->subject; // usually same subject
    $reply->body = $request->body;
    $reply->attachments = [];

    $reply->parent_id = $parentEmail->id; // <<=== important
    $reply->save();

    // Send the actual mail
    Mail::to($reply->to)
        ->cc($reply->cc ?? [])
        ->bcc($reply->bcc ?? [])
        ->send(new LeadSendEmail($reply));

    return back()->with('success', 'Reply sent successfully.');
}

}
