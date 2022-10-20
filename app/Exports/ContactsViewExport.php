<?php

namespace App\Exports;

use App\Models\Contact;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ContactsViewExport implements FromView
{
    public function view(): View
    {
        return view('contact.index', [
            'contacts' => Contact::all()
        ]);
    }
}
