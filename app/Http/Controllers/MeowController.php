<?php

namespace App\Http\Controllers;

use App\Models\Meow;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MeowController extends Controller
{
    /**
     * Create a new Meow record.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $id)
    {
        $meow_id = Meow::create([
            'user_id' => intval($id, 10),
            'content' => strip_tags($request->input('content')),
        ]);

        return response('success', 200);
    }

    public function getCreateView($id)
    {
        return view('create_meow', ['id' => $id]);
    }

    public function getMeowsView()
    {
        $meows = Meow::orderBy('created_at', 'desc')
            ->take(20)
            ->get();
        return view('meows', ['data' => $meows]);
    }
}