<?php

namespace App\Http\Controllers;

use App\Mail\SendMail as MailSendMail;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;

class SendMail extends Controller
{
    public function submit(Request $request)
    {
        try {
            // Validate input
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email',
                'mobile' => ['required', 'regex:/^\+?[0-9]{10,15}$/'],
                'message' => 'sometimes|nullable|max:1000',
                'recaptcha_token' => 'required|string',
            ]);

            // Verify reCAPTCHA v3
            $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
                'secret' => config('app.recaptcha_secret_key'),
                'response' => $validated['recaptcha_token'],
                'remoteip' => $request->ip(),
            ]);

            if (!$response->successful()) {
                return back()->with('error', 'Recaptcha verification service unavailable.');
            }

            $body = $response->json();

            if (!data_get($body, 'success')) {
                return back()->with('error', 'Recaptcha verification failed.');
            }

            $score = (float) data_get($body, 'score', 0.0);
            $threshold = 0.5; // adjust as needed

            if ($score < $threshold) {
                return back()->with('error', 'Recaptcha verification failed.');
            }

            // Prepare mail data
            $data = $request->only([]);

            $profile = User::first();
            $recipient = $profile->additional_info['emails'][0]['email'] ?? env("RECIPIENT_EMAIL_ADDRESS");
            // Send mail
            Mail::to($recipient)->send(new MailSendMail($data));

            return back()->with('success', 'Your enquiry has been sent successfully!');
        } catch (\Throwable $e) {
            return back()->with('error', 'There was an error sending your enquiry: ' . $e->getMessage());
        }
    }
}
