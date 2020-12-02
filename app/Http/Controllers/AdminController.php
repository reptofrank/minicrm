<?php

namespace App\Http\Controllers;

use App\Company;
use App\Employee;
use App\Http\Resources\User as ResourcesUser;
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
        return response()->json(ResourcesUser::collection(User::all()));
    }

    /**
     * Add User
     */
    public function addAdminUser(Request $request)
    {
        $user = $this->createUser($request->all(), 'admin');

        return response()->json($user, 201);
    }

    /**
     * Delete user
     */
    public function deleteUser(User $user)
    {
        switch ($user->role) {
            case 'company':
                $company = Company::where('user_id', $user->id)->first();
                Employee::where('company_id', $company->id)->delete();
                $company->delete();
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
