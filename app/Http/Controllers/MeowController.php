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
        $this->middleware('auth');
    }

    /**
     * Create a new Meow record.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        Auth::user()->createMeow($request->content);

        return response(200);
    }

    public function getCreateView()
    {
        $full_name = Auth::user()->fullName;
        return view('create_meow', ['name' => $full_name]);
    }

    public function getMeowsView()
    {
        $meows = Meow::orderBy('created_at', 'desc')
            ->take(20)
            ->get();
        return view('meows', ['data' => $meows]);
    }

    public function getUserMeowsView()
    {
        return view('my-meows', ['data' => Auth::user()->meows, 'name' => Auth::user()->fullName]);
    }
}
