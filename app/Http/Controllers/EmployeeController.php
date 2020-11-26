<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('manage-employees');

        $user = $request->user();

        $employees = Employee::where(['company_id' => $user->company->id])->get();

        return response()->json($employees);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->authorize('manage-employees');

        $data = $request->all();
        $user = $this->createUser($data, 'employee');

        $employee = new Employee;
        $employee->name = $data['name'];
        $employee->company_id = $data['company'];
        $employee->user_id = $user->id;
        $employee->save();

        return response()->json($employee, 201, ['Location' => '/employees/' . $employee->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        $this->authorize('view-employee', $employee);

        return response()->json($employee);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        $this->authorize('view-employee', $employee);

        $data = $request->all();

        if(array_key_exists('user_id', $data)) unset($data['user_id']);

        $updatedEmployee = $employee->fill($data);

        $updatedEmployee->save();

        return response()->json($updatedEmployee);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        $this->authorize('manage-employees', $employee);
        
        $user = $employee->user;
        $employee->delete();
        $user->delete();

        return response(null, 204);
    }
}
