<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ListUserController extends Controller
{
    public function index()
    {
        // $this->authorize('admin');
        return view('dashboard.list_users.index',[
            'users'=>User::all()
        ]);
    }
}
