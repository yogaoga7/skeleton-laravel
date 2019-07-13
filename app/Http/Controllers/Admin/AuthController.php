<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        return view('admin.auth.login');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        try {
            if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password])) {
                // flash()->success('Welcome back ' . auth()->user()->name . '!');
                // dd(Auth::user());
                return redirect()->route('admin.dashboard.index');
            }
            // flash()->warning('We cannot find an account with that email address or password.');
            return redirect()->back();
        } catch (\Exception $e) {
            abort(503, $e->getMessage());
        }
    }

    /**
     * Logout From Session
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        auth()->logout();
        
        return redirect()->back();
    }
}
