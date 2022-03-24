<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class TermsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('terms-agree');
    }

    public function store(Request $request, Response $response)
    {
        $request->validate([
            'agree' => 'accepted',
        ]);

        Auth::user()->agreed_terms = now();
        Auth::user()->save();

        if (isset($request->intended)) {
            return redirect(urldecode($request->intended));
        }

        return redirect()->route('meows');
    }
}
