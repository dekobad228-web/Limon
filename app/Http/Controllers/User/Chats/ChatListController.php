<?php

namespace App\Http\Controllers\User\Chats;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Chats\ChatService;
use App\Views\ChatListViewModel;

class ChatListController extends Controller
{
    public function __construct(private ChatService $service) {}

    public function index(Request $request)
    {
        $ChatListView = ChatListViewModel::make($this->service->getChatList($request->user()));
        
        // dd($ChatListView);
        return view('user.chats.list', $ChatListView);
    }
}
