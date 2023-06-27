<?php

namespace App\Http\Controllers\Guest;

use App\Http\Requests\Contact\ConfilmRequest;
use App\Models\Inquiry;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Mail\GuestSendMail;
use App\Mail\AdminSendMail;
use App\Models\Contact;
use Illuminate\Support\Facades\Mail;

class ContactController extends BaseController
{
    public function index(){
        return view('guest.contact.index');
    }

    public function confirm(ConfilmRequest $request){
        $contact = $request->all();
        return view('guest.contact.confirm',compact('contact'));
    }

    public function store(Request $request){

        $contact = Contact::create(['name' => $request->name, 'email' => $request->email, 'phone_number' => $request->phone_number, 'content' => $request->content]);

        Mail::to($contact['email'])->send(new GuestSendMail($contact));
        Mail::to('y.sugimot357@gmail.com')->send(new AdminSendMail($contact));

        $request->session()->regenerateToken();

        return view('guest.contact.thanks');
    }
}
