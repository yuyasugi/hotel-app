<?php

namespace App\Http\Controllers\Guest;

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

    public function confirm(Request $request){

        $contact = $request->all();
        // dd($inquiry);

        if(!$contact){
            return redirect()->route('guest.contact.index');
        }
        $request->validate([
            'name' => 'required',
             'email' => 'required',
             'phone_number' => 'required',
             'content' => 'required'
         ]);

        return view('guest.contact.confirm',compact('contact'));
    }

    public function store(Request $request){

        $contact = $request->all();
        //  dd($inquirys);

        Contact::insert(['name' => $contact['name'], 'email' => $contact['email'], 'phone_number' => $contact['phone_number'], 'content' => $contact['content']]);

        Mail::to($contact['email'])->send(new GuestSendMail($contact));
        Mail::to('y.sugimot357@gmail.com')->send(new AdminSendMail($contact));

        $request->session()->regenerateToken();

        return view('guest.contact.thanks');
    }
}
