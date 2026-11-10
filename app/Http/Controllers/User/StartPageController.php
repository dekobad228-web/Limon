<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class StartPageController extends Controller
{
    public function index(User $user)
    {
        return view('index');
    }
}
