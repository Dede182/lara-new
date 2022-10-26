<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receiver extends Model
{
    use HasFactory;

    protected $with = ['sends'];

    public function sends(){
        return $this->hasMany(Send::class);
    }
}
