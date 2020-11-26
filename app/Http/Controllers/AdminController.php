<?php

namespace App\Http\Controllers;

use App\Company;
use App\Employee;
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
        $this->authorize('admin');
        return response()->json(User::all());
    }
}
