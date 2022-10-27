<?php

namespace App\Http\Controllers;

use App\Models\Send;
use App\Models\User;
use App\Models\Sender;
use App\Models\Contact;
use App\Models\Receiver;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreSendRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateSendRequest;

class SendController extends Controller
{
    public function noti(){
        $contacts = Auth::user()->receivers;
        // return $contacts;
        $con = [];
        foreach($contacts as $key=>$contact){
            $con[$key] = $contact->sends;
        };
        $con = Arr::collapse($con);
        // return $con;
        // finding senderId
        $sendId = [];
        foreach($con as $key=>$sen){
            $sendId[$key] =  $sen->sender;
        };
        $sendId = array_unique($sendId);
        $sendId = array_values($sendId);

        // finding sender
        $sender = [];
        foreach($sendId as $key=>$send){
            $sender[$key] = User::findOrFail($send);
        }
        return view('Layoutss.noti',compact(['sender']));
    }


    public function send(Request $request){
        return $request;
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

            return redirect()->route('contact.index')->with('status','contact was sent');
        }
        return redirect()->route('contact.index')->with('status','contact not found');
    }

    public function accept($id,Contact $contact){
         $newContact = new Contact();
        $newContact->firstName = $contact->firstName;
        $newContact->secondName = $contact->secondName;
        $newContact->fullName = $contact->firstName . " " . $contact->secondName;
        $newContact->folder = $contact->firstName;
        $newContact->email = $contact->email;
        $newContact->phone = $contact->phone;
        $newContact->user_id = Auth::user()->id;
        $newContact->color = $contact->color;
        if($contact->contactPhoto != null){
            $newContact->contactPhoto = $contact->contactPhoto;
        }


        $newContact->save();
        $send = Send::findOrFail($id);
        $sender = Sender::findOrFail($send->sender_id);
        $rece = Receiver::findOrFail($send->receiver_id);
        $sender ->Delete();
        $rece->delete();
        $send->delete();

        return redirect()->back()->with('status',$contact->fullName . ' is created successfully');
    }

    public function reject($id){
        $send = Send::findOrFail($id);
        $sender = Sender::findOrFail($send->sender_id);
        $rece = Receiver::findOrFail($send->receiver_id);
        $sender ->Delete();
        $rece->delete();
        $send->delete();

        return redirect()->back()->with('status','contact  is rejected successfully');
    }

    public function sendMultiple(Request $request){
        $arr = $request->check;
        $contactsId = [];
        $contacts = [];

        foreach($arr as $key=>$value){
            $contactsId[$key] = (int)$value;
        }
        foreach($contactsId as $key=>$value){
            $contacts[$key] = Contact::findOrFail($value);
        }

         $receiverId = User::where('email',"$request->recei")->first();

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

                return redirect()->route('contact.index')->with('status','contacts are sent');



        }
        return redirect()->route('contact.index')->with('status','contact not found');
        return $contactsId;
    }
}
