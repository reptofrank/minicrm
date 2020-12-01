<?php

namespace App\Http\Controllers;

use App\Company;
use App\Employee;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function dashboard(Request $request)
    {
        return view('dashboard');
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
     * Add User
     */
    public function addAdminUser(Request $request)
    {
        $this->authorize('admin');

        $user = $this->createUser($request->all(), 'admin');

        return response()->json($user, 201);
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
