<?php

namespace App\Http\Controllers;

use App\Http\Resources\User as UserResource;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('welcome');
    }

    public function getUser(Request $request)
    {
        $user = $request->user();
        $res = $user ? new UserResource($user) : null;

        // var_dump($res);die;

        return response()->json($res);
    }
}
