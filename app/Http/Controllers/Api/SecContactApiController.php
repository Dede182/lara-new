<?php

namespace App\Http\Controllers\Api;

use App\Models\Contact;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SecContactApiController extends Controller
{
    public function duplicate(Contact $contact){
        $newContact = new Contact();
        $newContact->firstName = $contact->firstName;
        $newContact->secondName = $contact->secondName;
        $newContact->fullName = $contact->firstName . $contact->secondName;
        $newContact->email = $contact->email;
        $newContact->folder =$contact->firstName;
        $newContact->phone = $contact->phone;
        $newContact->user_id =  Auth::user()->id;
        $newContact->contactPhoto = $contact->contactPhoto;
        $newContact->color = $contact->color;
        $newContact->save();
        return response()->json([
            "message"=>"contact is duplicated",
            "product" => $newContact,
            "status" => true,
        ]);

    }
    public function bulkDuplicate(Request $request){
        $arr = $request->check;
        $contactsId = [];
        $contacts = [];

        foreach($arr as $key=>$value){
            $contactsId[$key] = (int)$value;
        }
        foreach($contactsId as $key=>$value){
            $contacts[$key] = Contact::findOrFail($value);
        }

        Arr::map($contacts,function($contact,$key){
            $newContact[$key] = new Contact();
            $newContact[$key]->firstName = $contact->firstName;
            $newContact[$key]->secondName = $contact->secondName;
            $newContact[$key]->fullName = $contact->firstName . $contact->secondName;
            $newContact[$key]->email = $contact->email;
            $newContact[$key]->folder =$contact->firstName;
            $newContact[$key]->phone = $contact->phone;
            $newContact[$key]->user_id =  Auth::user()->id;
            $newContact[$key]->contactPhoto = $contact->contactPhoto;
            $newContact[$key]->color = $contact->color;
            $newContact[$key]->save();
        });
        return response()->json([
            "message"=>"contacts are duplicated",
            "status" => true,
        ]);
    }
}
