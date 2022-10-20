<?php

namespace App\Imports;

use App\Models\Contact;
use Maatwebsite\Excel\Concerns\ToModel;

class ContactImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Contact([
           'firstName' => $row[1],
           'secondName' => $row[2],
           'fullName' => $row[3],
           'email' => $row[4],
           'folder'=>$row[5],
            'phone'=>$row[7]
        ]);
    }
}
