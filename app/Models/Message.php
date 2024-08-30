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
        "message_id",
        "chat",
        "response",
    ];

    protected $casts =[
        "chat_id"=>"string",
        "type"=>"string",
        "message_id"=>"string",
        "chat"=>"array",
        "response"=>"array",
    ];
}
