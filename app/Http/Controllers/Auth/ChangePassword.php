<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ChangePasswordRequest;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class ChangePassword extends Controller
{
    /**
     * @return Factory|View
     */
    public function index() {

        return view('auth.passwords.change');
    }

    /**
     * @param ChangePasswordRequest $request
     * @return RedirectResponse|Redirector
     */
    public function change(ChangePasswordRequest $request) {

        auth()->user()->update(['password' => Hash::make($request->input('password'))]);

        return redirect('/');
    }
}
