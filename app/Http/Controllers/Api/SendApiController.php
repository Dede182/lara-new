<?php

namespace App\Http\Controllers\Api;

use App\Models\Send;
use App\Models\User;
use App\Models\Sender;
use App\Models\Contact;
use App\Models\Receiver;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SendApiController extends Controller
{
    public function send(Request $request){

        $contact = Contact::findOrFail($request->contactId);
        $receiverId = User::where('email',"$request->receiver")->first();

        if($receiverId){

            $receiver= new Receiver();
            $receiver->user_id = $receiverId->id;
            $receiver->save();

            $sender= new Sender();
            $sender->user_id = Auth::user()->id;;
            $sender->save();

            $send = new Send();
            $send->receiver = $receiverId->id;
            $send->sender = Auth::user()->id;
            $send->message = $contact;
            $send->receiver_id = $receiver->id;
            $send->sender_id = $sender->id;
            $send->save();

            return response()->json([
                'message' => "contact was sent",
                "sendsDetail" => $send,
                "status" => true
            ]);
        }
        return response()->json([
            'message' => "email was not found!",
            "status" => false
        ]);
    }

    public function multipleSends(Request $request){
         $request->validate([
            'check' => 'required',
        ]);
        $arr = $request->check;
        $contactsId = [];
        $contacts = [];

        foreach($arr as $key=>$value){
            $contactsId[$key] = (int)$value;
        }
        foreach($contactsId as $key=>$value){
            $contacts[$key] = Contact::findOrFail($value);
        }

         $receiverId = User::where('email',"$request->receiver")->first();

        if($receiverId){

                foreach($contacts as $key=>$contact){

                    $receiver[$key]= new Receiver();
                    $receiver[$key]->user_id = $receiverId->id;
                    $receiver[$key]->save();
                    $sender[$key]= new Sender();
                    $sender[$key]->user_id = Auth::user()->id;;
                    $sender[$key]->save();

                    $send[$key] = new Send();
                    $send[$key]->receiver = $receiverId->id;
                    $send[$key]->sender = Auth::user()->id;
                    $send[$key]->message = $contact;
                    $send[$key]->receiver_id = $receiver[$key]->id;
                    $send[$key]->sender_id = $sender[$key]->id;
                    $send[$key]->save();

                }

                return response()->json([
                    'message' => "contacts were sent",
                    "status" => true
                ]);


        }
        return response()->json([
            'message' => "email was not found!",
            "status" => false
        ]);
    }

    public function receiver(){
        return "hi";

        $contacts = Auth::user()->receivers;

        return response()->json([
            'message' =>'success',
            'receivers' => $contacts,
            "status" => true
        ]);
    }

    public function sender(){
        $contacts = Auth::user()->senders;

        return response()->json([
            'message' =>'success',
            'senders' => $contacts,
            "status" => true
        ]);
    }
    }



