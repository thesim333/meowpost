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

    public function getTermsView()
    {
        return view('terms-agree');
    }

    public function postTermsAcceptance(Request $request, Response $response)
    {
        if ($request->agree == true) {
            Auth::user()->agreed_terms = now();
            Auth::user()->save();

            if (isset($request->intended)) {
                return redirect(urldecode($request->intended));
            }

            return redirect('/meows');
        }
        return back();
    }

    /**
     * Get the post register / login redirect path.
     *
     * @return string
     */
    public function redirectPath()
    {
        if ($this->request->filled('redirect_url')) {
            return $this->request->redirect_url;
        }

        return $this->redirectTo;
    }
}
