<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
   
    public function index(){
        return view("Email.contact");
    }
    public function sendEmail(Request $request)
{

    $data = [
        'name' => $request->name,
        'email' => $request->email,
        'subject' => $request->subject,
        'message' => $request->message,
    ];


    Mail::to($data['email'])->send(new ContactMail($data));

    return 'Email sent!';
}
}
