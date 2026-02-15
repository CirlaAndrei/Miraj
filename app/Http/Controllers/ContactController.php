<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function show()
    {
        return view('contact');
    }

    public function send(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string',
            'message' => 'required|string',
            'consent' => 'required|accepted',
        ]);

        // Prepare email data
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'subject' => $request->subject,
            'message' => $request->message,
        ];

        try {
            // Send email to YOU (the store owner)
            Mail::send('emails.contact', ['data' => $data], function ($message) use ($request) {
                $message->to('your.email@gmail.com') // CHANGE THIS TO YOUR EMAIL
                        ->subject('Mesaj nou de la ' . $request->name . ' - Miraj')
                        ->replyTo($request->email, $request->name)
                        ->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
            });

            // Optional: Send auto-reply to the customer
            Mail::send('emails.auto-reply', ['name' => $request->name], function ($message) use ($request) {
                $message->to($request->email, $request->name)
                        ->subject('Am primit mesajul tău - Miraj')
                        ->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
            });

            return redirect()->route('contact')->with('success', 'Mesajul tău a fost trimis cu succes! Te vom contacta în curând.');

        } catch (\Exception $e) {
            return redirect()->route('contact')->with('error', 'A apărut o eroare. Te rugăm să încerci din nou mai târziu.');
        }
    }
}
