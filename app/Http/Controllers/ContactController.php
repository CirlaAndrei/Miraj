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

        // Here you would send an email
        // For now, we'll just flash a success message

        // Mail::send('emails.contact', $request->all(), function ($message) use ($request) {
        //     $message->to('contact@miraj.ro')
        //             ->subject('Mesaj nou de la ' . $request->name)
        //             ->from($request->email, $request->name);
        // });

        return redirect()->route('contact')->with('success', 'Mesajul tău a fost trimis cu succes! Te vom contacta în curând.');
    }
}
