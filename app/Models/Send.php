<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Send extends Model
{
    use HasFactory;
    protected  $fillable = ['receiver','sender','message','status'];

    public function receiver(){
        return $this->belongsTo(Receiver::class);
    }
    public function senders(){
        return $this->belongsTo(Sender::class);
    }
}
