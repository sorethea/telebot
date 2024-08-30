<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $fillable = [
        "chat_id",
        "type",
        "message",
        "chat",
        "response",
    ];

    protected $casts =[
        "chat_id"=>"string",
        "type"=>"string",
        "message"=>"array",
        "chat"=>"array",
        "response"=>"array",
    ];
}
