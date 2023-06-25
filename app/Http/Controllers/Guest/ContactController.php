<?php

namespace App\Http\Controllers\Guest;

use App\Http\Requests\Contact\StoreRequest;
use Illuminate\Routing\Controller as BaseController;
use App\Mail\GuestSendMail;
use App\Mail\AdminSendMail;
use App\Models\Contact;
use Illuminate\Support\Facades\Mail;

class ContactController extends BaseController
{
    public function index(){
        return view('guest.contact.index');
    }

    public function confirm(StoreRequest $request){
        return view('guest.contact.confirm',compact('contact'));
    }

    public function store(StoreRequest $request){

        $contact = $request->all();

        Contact::insert(['name' => $contact['name'], 'email' => $contact['email'], 'phone_number' => $contact['phone_number'], 'content' => $contact['content']]);

        Mail::to($contact['email'])->send(new GuestSendMail($contact));
        Mail::to('y.sugimot357@gmail.com')->send(new AdminSendMail($contact));

        $request->session()->regenerateToken();

        return view('guest.contact.thanks');
    }
}
