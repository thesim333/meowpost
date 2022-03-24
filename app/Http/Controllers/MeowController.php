<?php

namespace App\Http\Controllers;

use App\Models\Meow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MeowController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'agreed.terms']);
    }

    /**
     * Display current 20 latest Meows page
     *
     * @return \Illuminate\Contracts\View
     */
    public function index()
    {
        $meows = Meow::orderBy('created_at', 'desc')
            ->take(20)
            ->get();
        return view('meows', ['data' => $meows]);
    }

    /**
     * Create a new Meow record.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Auth::user()->createMeow($request->content);

        return redirect('/user/my-meows');
    }

    /**
     * Create Meow Form View
     *
     * @return \Illuminate\Contracts\View
     */
    public function create()
    {
        $full_name = Auth::user()->fullName;
        return view('create_meow', ['name' => $full_name]);
    }

    /**
     * Display all Meows for the current User
     *
     * @return \Illuminate\Contracts\View
     */
    public function showCurrentUser()
    {
        return view('my-meows', ['data' => Auth::user()->meows, 'name' => Auth::user()->fullName]);
    }
}
