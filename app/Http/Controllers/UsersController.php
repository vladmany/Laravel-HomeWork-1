<?php

namespace App\Http\Controllers;

use Faker\Provider\Lorem;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    function set() {
        $users = DB::table('users')
            ->select('name','email','id')
            ->limit(10)
            ->get();

        return view('users',compact('users'));
    }
}
