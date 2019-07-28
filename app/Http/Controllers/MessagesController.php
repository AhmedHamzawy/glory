<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Mail;
use App\User;

class MessagesController extends Controller
{
    public function create()
    {
        $messages = Message::with('sender' , 'reciever')->get();
        $sender = User::whereId(Auth::user()->id)->firstOrFail();
        $reciever = User::whereId(Auth::user()->id)->firstOrFail();
        array_push($messages , $sender);
        array_push($messages , $reciever);
        return MessageResource::collection($messages);
    }

   
    public function store(Request $request)
    {
        $message =  new Message;
        $reciever = User::where('user_name' , $request->get('to'))->firstOrFail();
        
        
        $message->from = Auth::user()->id;
        $message->to = $reciever->id;
        $message->message = $request->input('message');


        if($message->save()){ return new MessageResource($message); }
    }
}
