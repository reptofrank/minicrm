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

    /**
     * Delete user
     */
    public function deleteUser(User $user)
    {
        $this->authorize('admin');

        switch ($user->role) {
            case 'company':
                Company::where('user_id', $user->id)->delete();
                break;
            case 'employee':
                Employee::where('user_id', $user->id)->delete();
                break;
            default:
                //
                break;
        }

        $user->delete();

        return response(null, 204);
    }
}
