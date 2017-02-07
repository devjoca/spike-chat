<?php

namespace App\Http\Controllers;

use App\User;
use App\Conversation;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $me = request()->user();
        $conversations = Conversation::of($me);

        //fiilter users with conversation with $me
        $users = User::all()->filter(function($user) use($conversations, $me) {
            return ! $conversations->map(function($conversation) use ($me) {
                return $conversation->peer;
            })->push($me)->contains($user);
        });

        return view('home', compact('conversations', 'users', 'me'));
    }
}
