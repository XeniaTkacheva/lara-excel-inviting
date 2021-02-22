<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePasswordRequest;
use Illuminate\Http\Request;

class SetPasswordController extends Controller
{
    /**
     * Show the form for setting a new password.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('auth.setpassword');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StorePasswordRequest $request)
    {
        auth()->user()->update([
            'password' => bcrypt($request->password)
        ]);

        return redirect()->route('home')
            ->with('status', 'Password set successfully!');
    }
}
