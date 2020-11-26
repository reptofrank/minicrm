<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    function __construct() {
        $this->authorize('admin');    
    }

    /**
     * Get all users
     */
    public function users(Request $request)
    {
        return response()->json(User::all());
    }
}
