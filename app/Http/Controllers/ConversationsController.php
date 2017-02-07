<?php

namespace App\Http\Controllers;

use App\User;
use App\Conversation;
use Illuminate\Http\Request;

class ConversationsController extends Controller
{
    public function index(Conversation $conversation)
    {
        $user = request()->user();

        return view('conversations.index', compact('conversation', 'user'));
    }

    public function store()
    {
        $conversation = Conversation::create([
            'user1_id' => request()->user()->id,
            'user2_id' => request('receiver_id'),
        ]);

        return redirect("/conversations/{$conversation->id}");
    }
}
