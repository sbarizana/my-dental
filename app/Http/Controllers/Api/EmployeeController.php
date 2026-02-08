<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employee as EmployeeModel;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function createEmployee(Request $request)
    {
        $request->validate([
            'phone' => 'required',
            'email' => 'required|email',
        ]);

        $employee = EmployeeModel::create([
            'phone' => $request->phone,
            'email' => $request->email,
            'user_id_created' => auth()->id(),
            'user_id_updated' => auth()->id(),
        ]);

        $employee = EmployeeModel::find($employee->id);
        if ($employee) {
            return response([
                'message' => 'success',
                'employee' => $employee,
                'status' => 200,
            ]);
        } else {
            return response([
                'message' => 'error',
                'employee' => 'employee does not exist!',
                'status' => 404,
            ]);
        }
    }

    public function getAllEmployees()
    {
        $employees = EmployeeModel::all();
        if ($employees) {
            return response([
                'message' => 'Success',
                'employees' => $employees,
            ]);
        } else {
            return response([
                'message' => 'error',
                'employees' => 'No employees in database',
            ]);
        }
    }

    public function getEmployee(Request $request)
    {
        $request->validate(['id' => 'required']);
        $employee = EmployeeModel::find($request->id);
        if ($employee) {
            return response([
                'message' => 'success',
                'employee' => $employee,
                'status' => 200,
            ]);
        } else {
            return response([
                'message' => 'error',
                'employee' => 'Employee does not exist',
                'status' => 404,
            ]);
        }
    }

    public function updateEmployee(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
        ]);
        $employee = EmployeeModel::find($request->id);
        if ($employee) {
            $employee->phone = $request->phone;
            $employee->email = $request->email;
            $employee->user_id_updated = auth()->id();
            $employee->save();

            return response([
                'message' => 'success',
                'employee' => $employee,
                'status' => 200,
            ]);
        } else {
            return response([
                'message' => 'error',
                'employee' => 'Employee doesn\'t exist',
                'status' => 404,
            ]);
        }
    }

    public function deleteEmployee(Request $request)
    {
        $request->validate(['id' => 'required']);
        $employee = EmployeeModel::find($request->id);
        if ($employee) {
            $employee->delete();

            return response([
                'message' => 'success',
                'employee' => 'Employee has been deleted successfully!',
                'status' => 200,
            ]);
        } else {
            return response([
                'message' => 'error',
                'employee' => 'Employee does not exist!',
                'status' => 404,
            ]);
        }
    }
}
