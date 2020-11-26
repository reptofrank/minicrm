<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Get all users
     */
    public function users(Request $request)
    {
        return response()->json(User::all());
    }
}
