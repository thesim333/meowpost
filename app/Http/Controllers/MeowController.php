<?php

namespace App\Http\Controllers;

use App\Models\Meow;
use App\Models\Tag;
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
        $tags = Tag::all();
        $full_name = Auth::user()->fullName;
        return view('create_meow', ['name' => $full_name, 'tags' => $tags]);
    }

    /**
     * Delete Meow
     */
    public function delete(Request $request, $id)
    {
        $meow = Meow::whereId($id)->first();

        if (isset($meow) && $meow->user->id == Auth::id()) {
            $meow->delete();
            return response('deleted', 200);
        } elseif (!isset($meow)) {
            return response('Meow does not exist', 404);
        }

        return response('That is not your meow', 401);
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

        $tags = Tag::select('tag')->get();
        return view('single-meow', ['meow' => $meow, 'tags' => $tags]);
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
            'tags.*' => ['string', 'min:1', 'max:30'],
        ]);
        $meow = Meow::create(['content' => $request->content, 'user_id' => Auth::id()]);

        $tagIds = array_map(function ($tag) {
            $tagM = Tag::firstOrCreate(['tag' => $tag]);
            return $tagM->id;
        }, $request->tags);

        $meow->tags()->sync($tagIds);
        return response('success');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'content' => ['required', 'max:160', 'min:2'],
            'tags.*' => ['string', 'min:1', 'max:30'],
        ]);

        $meow = Meow::whereId($id)->first();

        if (isset($meow) && $meow->user->id == Auth::id()) {
            $meow->content = $request->content;
            $meow->save();

            $tagIds = array_map(function ($tag) {
                $tagM = Tag::firstOrCreate(['tag' => $tag]);
                return $tagM->id;
            }, $request->tags);

            $meow->tags()->sync($tagIds);
            return response('success');
        } elseif (!isset($meow)) {
            return response('Meow does not exist', 404);
        }

        return response('That is not your meow', 401);
    }
}
