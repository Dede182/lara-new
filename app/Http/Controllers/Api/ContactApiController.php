<?php

namespace App\Http\Controllers\Api;

use App\Models\Contact;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ContactApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = Contact::
        search()
        ->latest('id')
        ->paginate(10)
        ->withQueryString();
        return response()->json([
            'success' => true,
            'message' => "contacts fetched successfully",
            'contacts' => $contacts
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'firstName' => "required",
            'secondName' => "nullable",
            'email' => 'email|required',
            'phone' => 'numeric|min:3',
            'contactPhoto' => 'file|mimes:png,jpg,max:2000'
        ]);


        if($request->hasFile('contactPhoto')){
            $some =  uniqid()."contactPhoto.".$request->file('contactPhoto')->extension();
            $newName = $request->contactPhoto->storeAs('public/'.$request->firstName.'/',$some);
            Storage::makeDirectory('public/'.$request->firstName);
        }
        // return $request->contactPhoto;
        $contact =  Contact::create([
            'firstName' => $request->firstName,
            'secondName' => $request->secondName,
            'fullName' => $request->firstName . $request->secondName,
            'email' => $request->email,
            'folder' => $request->firstName,
            'phone' => $request->phone,
            'contactPhoto' => $some,
        ]);

        return response()->json([
            "message"=>"contact is added",
            "product" => $contact,
            "success" => true
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contact = Contact::findOrFail($id);
        return response()->json([
            'success' => true,
            'message' => "contact is found",
            'contact' => $contact
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'firstName' => "",
            'secondName' => "nullable",
            'email' => 'email',
            'phone' => 'numeric|min:3',
            'contactPhoto' => 'file|mimes:png,jpg,max:2000'
        ]);
        $contact = Contact::findOrFail($id);
        if($request->has('firstName')){
            $contact->firstName = $request->firstName;
        }
        if($request->has('secondName')){
            $contact->secondName = $request->secondName;
        }
        $contact->fullName = $request->firstName . $request->secondName;
        $contact->folder = $request->firstName;
        if($request->has('email')){
            $contact->email = $request->email;
        }
        if($request->has('phone')){
            $contact->phone = $request->phone;
        }
        if($request->has('contactPhoto')){
            $contact->contactPhoto = $request->contactPhoto;
        }
        $contact->update();
        return response()->json([
            'success' => true,
            'message' => "contact is updated",
            'contact' => $contact
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        Storage::delete('public/'.$contact->firstName.'/'.$contact->contactPhoto);
        Storage::deleteDirectory('public/'.$contact->firstName);
        $contact->delete();
        return response()->json([
            'success' => true,
            'message' => "contact is deleted",
        ]);
    }

    public function bulk(Request $request){
        // return $request;
        $arr = $request->check;
        $contactsId = [];
        $contacts = [];
        foreach($arr as $key=>$value){
            $contactsId[$key] = (int)$value;
        }
        foreach($contactsId as $key=>$value){
            $contacts[$key] = Contact::findOrFail($value);
        }
        foreach($contacts as $key=>$value){
            Storage::deleteDirectory('public/'.$value->firstName);
        }
        $int = Arr::map($arr,function($value,$key){
            return (int)$value;
        });
        // return $arr;

        // return $contacts;
        Contact::destroy($int);
        return response()->json([
            'success' => true,
            'message' => 'contacts are deleted'
        ]);

    }
}
