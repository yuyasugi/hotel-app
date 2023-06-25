<?php

namespace App\Http\Controllers\Admin;

use App\Models\Contact;
use App\Models\Inquiry;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class AdminContactController extends BaseController
{
    public function admin_contact(){

        $Contacts = Contact::get();
        // dd( $Inpuiries);

        return view('admin.contact.index',compact('Contacts'));
    }

    public function admin_contact_update(Request $request){

        $posts = $request->all();
        // dd($posts);

        $Contact = Contact::where('id', '=', $posts['id'])->first();
        // dd($Inquiry->type);

        if($Contact->type === 0){
            Contact::where('id', $posts['id'])->update(['type' => 1]);
        } else {
            Contact::where('id', $posts['id'])->update(['type' => 0]);
        }

        return redirect()->route('admin_contact');
    }

    public function admin_contact_detail($id){

        $Contact = Contact::where('id', '=', $id)->get();
//    dd($Inpuiry);

        return view('admin.contact.detail',compact('Contact'));
    }
}
