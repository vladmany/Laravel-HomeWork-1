<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Library extends Controller
{
    function index() {
        return view('library.index');
    }
}
