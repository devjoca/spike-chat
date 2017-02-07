<?php

namespace App\Http\Controllers\Api;

use App\Conversation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ConversationsController extends Controller
{
    public function index()
    {
        $conversations = Conversation::of(request()->user());

        return response()->json($conversations);
    }

    public function store()
    {
        return response()->json(Conversation::create([
            'user1_id' => request()->user()->id,
            'user2_id' => request('receiver_id'),
        ]));
    }
}
