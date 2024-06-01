<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class Chatcontroller extends Controller
{
    public function dashboard()
    {
     
        $users = User::where('id', '!=', auth()->user()->id)->get();
        return view('dashboard', compact('users'));
    }

    public function chat($id){

        return view('chat', compact('id'));
    }
}
