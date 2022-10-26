<?php

namespace App\Http\Controllers;

use App\Models\Send;
use App\Models\User;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreSendRequest;
use App\Http\Requests\UpdateSendRequest;
use App\Models\Receiver;

class SendController extends Controller
{
    public function index(){
        return "hi";
        $re= Receiver::all();
        return $re;
    }
    public function send(Request $request){
        $contact = Contact::findOrFail($request->contactId);
        $receiverId = User::where('email',"$request->receiver")->first();

        $send = new Send();
        $send->receiver = $receiverId->id;
        $send->sender = Auth::user()->id;
        $send->message = $contact;
        $send->receiver_id = Auth::user()->id;
        $send->save();

        $receiver= new Receiver();
        $receiver->user_id = $receiverId->id;
        $receiver->sendId = $send->id;
        $receiver->save();
        return $send;
    }


}
