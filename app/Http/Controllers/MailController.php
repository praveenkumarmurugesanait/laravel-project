<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;
use App\Models\MailHistory;

class MailController extends Controller
{
    public function index()
    {
        // show form + history
        $history = MailHistory::latest()->paginate(5);
        return view('sendmail', compact('history'));
    }

    public function send(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'subject' => 'nullable|string',
            'body' => 'nullable|string',
            'attachment' => 'nullable|file|mimes:pdf,jpg,png|max:5120'
        ]);

        $subject = $request->input('subject') ?? 'Welcome to Our App';
        $body    = $request->input('body') ?? 'We’re excited to have you join us!';
        $file    = $request->file('attachment');

        try {
            Mail::to($request->input('email'))
                ->send(new WelcomeMail($subject, $body, $file));

            MailHistory::create([
                'recipient' => $request->input('email'),
                'subject'   => $subject,
                'body'      => $body,
                'status'    => 'success',
            ]);

            return redirect()->back()->with('success', 'Mail sent successfully!');
        } catch (\Exception $e) {
            MailHistory::create([
                'recipient'    => $request->input('email'),
                'subject'      => $subject,
                'body'         => $body,
                'status'       => 'failed',
                'error_message'=> $e->getMessage(),
            ]);

            return redirect()->back()->with('error', 'Mail failed: '.$e->getMessage());
        }
    }
}
