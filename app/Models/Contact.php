<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $fillable  = ['firstName','secondName','fullName','folder','email','phone','color','contactPhoto','user_id'];

    public function scopeSearch($q){
        $q->when(request('search'),function($q){
            $search = request('search');
            $q->orWhere('fullName' ,'like',"%$search%")
            ->orWhere('phone','like',"%$search%");
        });
    }

}
