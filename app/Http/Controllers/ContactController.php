<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Imports\ContactImport;
use App\Exports\ContactsExport;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;
use Illuminate\Support\Facades\Gate;

// use Maatwebsite\Excel\Excel;


class ContactController extends Controller
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
        ->where('user_id','=',Auth::id())
        ->latest('id')
        ->paginate(10)
        ->withQueryString();
        return view('contact.index',compact('contacts'));
    }

    public function export(){
        Excel::store(new ContactsExport,'contactss.csv');
        return Excel::download(new ContactsExport,'contactss.csv');
        // return (new ContactsExport)->download('contacts.csv',Excel::CSV, ['Content-Type' => 'text/csv']);
        // return Excel::download(new ContactsViewExport,'contacts.csv');
    }
    public function import(Request $request){

        Excel::import(new ContactImport,$request->importFile);
        return redirect()->route('contact.index')->with('success','All Good!');
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
        // return $request->contactPhoto;
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
        Gate::authorize('view',$contact);
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
        Gate::authorize('update',$contact);
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
        Gate::authorize('update',$contact);
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
        Gate::authorize('delete',$contact);
        Storage::delete('public/'.$contact->firstName.'/'.$contact->contactPhoto);
        Storage::deleteDirectory('public/'.$contact->firstName);
        $contact->delete();
        return redirect()->route('contact.index')->with('status',$contact->fullName . ' is deleted successfully');
    }

    public function bulk(Request $request,Contact $contact){
        Gate::authorize('delete',$contact);
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

        // return $contacts;
        Contact::destroy($int);
        return redirect()->route('contact.index')->with('status',count($arr) . ' contacts is deleted');

    }
}
