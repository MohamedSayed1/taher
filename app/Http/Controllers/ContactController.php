<?php

namespace App\Http\Controllers;


use App\Mail\ContactUs;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|min:3|max:1000'
        ]);
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['message'] = $request->message;
        Mail::to(Setting::find(1)->email)->send(new ContactUs($data));
       // Mail::to('Adnaanaltaher@aatheorie.nl')->send(new ContactUs($data));
        session()->flash('notif', trans('messages.Your Email send successfully.'));
        return redirect()->route('contactUs');
    }
}
