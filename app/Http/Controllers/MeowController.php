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
        $int_id = intval($id, 10);

        if (is_numeric($id) != 1) {
            return response('Unknown user id', 403);
        }

        $meow_id = Meow::create([
            'user_id' => $int_id,
            'content' => $request->input('content'),
        ]);

        return response('success', 200);
    }
}