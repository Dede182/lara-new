<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;
use Illuminate\Support\Facades\Storage;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = Contact::latest('id')
        ->paginate(10)
        ->withQueryString();
        return view('contact.index',compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contact.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreContactRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreContactRequest $request)
    {
        // return $request;
        $contact = new Contact();
        $contact->firstName = $request->firstName;
        $contact->secondName = $request->secondName;
        $contact->fullName = $request->firstName . " " . $request->secondName;
        $contact->folder = $request->firstName;
        $contact->email = $request->email;
        $contact->phone = $request->phone;

        if($request->hasFile('contactPhoto')){
                $newName = uniqid()."contactPhoto.".$request->file('contactPhoto')->extension();
                Storage::makeDirectory('public/'.$contact->folder);
                $request->file('contactPhoto')->storeAs('public/'.$contact->folder.'/',$newName);
                $contact->contactPhoto = $newName;
            }

        $contact->save();


        return redirect()->route('contact.index')->with('status',$contact->fullName . ' is created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        return view('contact.show',compact('contact'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        return view('contact.edit',compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateContactRequest  $request
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateContactRequest $request, Contact $contact)
    {
        // return $contact;

        $contact->firstName = $request->firstName;
        $contact->secondName = $request->secondName;
        $contact->fullName = $request->firstName . " " . $request->secondName;
        $contact->email = $request->email;
        $contact->phone = $request->phone;

        if($request->hasFile('contactPhoto')){
            $newName = uniqid()."contactPhoto.".$request->file('contactPhoto')->extension();
            Storage::makeDirectory('public/'.$contact->folder);
            $request->file('contactPhoto')->storeAs('public/'.$contact->folder.'/',$newName);
            $contact->contactPhoto = $newName;
        }

        $contact->update();


        return redirect()->route('contact.index')->with('status',$contact->fullName . ' is updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        Storage::delete('public/'.$contact->firstName.'/'.$contact->contactPhoto);
        Storage::deleteDirectory('public/'.$contact->firstName);
        $contact->delete();
        return redirect()->route('contact.index')->with('status',$contact->fullName . ' is deleted successfully');
    }
}
