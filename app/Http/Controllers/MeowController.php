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
     * Display view to edit Meow with {id}
     *
     * @return \Illuminate\Contracts\View
     */
    public function edit($id)
    {
        $meow = Meow::whereId($id)->first();

        if (!isset($meow)) {
            return response('Meow does not exist', 404);
        }

        return view('single-meow', ['meow' => $meow]);
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
     * Display all Meows for the current User
     *
     * @return \Illuminate\Contracts\View
     */
    public function showCurrentUser()
    {
        return view('my-meows', [
            'data' => Auth::user()->meows,
            'name' => Auth::user()->fullName
        ]);
    }

    /**
     * Create a new Meow record.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'content' => ['required', 'max:160', 'min:2'],
        ]);

        Auth::user()->createMeow($request->content);
        return redirect()->route('myMeows');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'content' => ['required', 'max:160', 'min:2'],
        ]);

        $meow = Meow::whereId($id)->first();

        if (isset($meow) && $meow->user->id == Auth::id()) {
            $meow->content = $request->content;
            $meow->save();
            return redirect()->back()->with('success', 'Meow Updated');
        } elseif (!isset($meow)) {
            return response('Meow does not exist', 404);
        }

        return response('That is not your meow', 401);
    }
}
