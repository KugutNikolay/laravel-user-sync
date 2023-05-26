<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Routing\Controller;

class UsersController extends Controller
{
    public function get()
    {
        return view('users.index', ['users' => User::paginate()]);
    }
}
