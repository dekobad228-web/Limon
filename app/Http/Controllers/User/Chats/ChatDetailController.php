<?php

namespace App\Http\Controllers\User\Chats;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Communication\Chat;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ChatDetailController extends Controller
{

    public function __construct(){}

    public function index(User $user, Chat $chat)
    {
        $messages = DB::select(
            'select sender_id, body, is_hidden, created_at from messages m 
            where m.chat_id = ? 
            order by created_at desc 
            limit ?',
            [$chat->id, 50]
        );

        return view('user.chats.index', compact('chat', 'messages'));
    }

    public function store(Request $request)
    {
        $messages = DB::select(
            'select sender_id, body, is_hidden, created_at from messages m 
            where m.chat_id = ? 
            order by created_at desc 
            limit ?',
            [1, 50]
        );
        return view('user.chats.index', compact('messages'));
    }
}
