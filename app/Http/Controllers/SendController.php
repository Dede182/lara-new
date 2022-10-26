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

        // $senderSend = [];
        // foreach($sender as $key=>$singleSender){
        //     $senderSend[$key] = $singleSender->senders;
        // }
        // $senderSend= Arr::collapse($senderSend);

        // $senderRequest = [];
        // foreach($senderSend as $key=>$ss){
        //     $senderRequest[$key] = $ss->sends;
        // }
        // $senderRequest= Arr::collapse($senderRequest);
        // $last =[];
        // foreach($senderRequest as $key=>$l){
        //     $last[$key] =json_decode($l->message);
        // }
        // return ;

        return view('Layoutss.noti',compact(['sender']));
    }


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
            $newName = uniqid()."contactPhoto.".$contact->contactPhoto;
            Storage::makeDirectory('public/'.$newContact->folder);
            $contact->contactPhoto->storeAs('public/'.$newContact->folder.'/',$newName);
            $newContact->contactPhoto = $newName;
        }


        $newContact->save();
        $send = Send::findOrFail($id);
        $rece = Receiver::findOrFail($send->receiver_id);
        $rece->delete();
        $send->delete();

        return redirect()->route('contact.index')->with('status',$contact->fullName . ' is created successfully');
    }

    public function reject($id){
        $send = Send::findOrFail($id);
        $rece = Receiver::findOrFail($send->receiver_id);
        $rece->delete();
        $send->delete();

        return redirect()->route('contact.index')->with('status','contact  is rejected successfully');
    }
}
