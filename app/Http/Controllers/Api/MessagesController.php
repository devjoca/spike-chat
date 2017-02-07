<?php

namespace App\Http\Controllers\Api;

use App\Message;
use App\Conversation;
use Illuminate\Http\Request;
use App\Events\MessageWasSend;
use App\Http\Controllers\Controller;

class MessagesController extends Controller
{
   public function index(Conversation $conversation)
    {
        $messages = $conversation->messages;
        $messages->load('sender');

        return response()->json($messages);
    }

    public function store(Conversation $conversation)
    {
        $sender = request()->user();
        $conversation->send(
            $message = new Message([
                'sender_id' => $sender->id,
                'body' => request('body'),
            ])
        );

        broadcast(new MessageWasSend($sender, $message))->toOthers();

        return response()->json($message);
    }
}
