<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer as CustomerModel;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function createCustomer(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'nullable|email',
        ]);

        $customer = CustomerModel::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'user_id_created' => auth()->id(),
            'user_id_updated' => auth()->id(),
        ]);

        $customer = CustomerModel::find($customer->id);
        if ($customer) {
            return response([
                'message' => 'success',
                'customer' => $customer,
                'status' => 200,
            ]);
        } else {
            return response([
                'message' => 'error',
                'customer' => 'customer does not exist!',
                'status' => 404,
            ]);
        }
    }

    public function getAllCustomers()
    {
        $customers = CustomerModel::all();
        if ($customers) {
            return response([
                'message' => 'Success',
                'customers' => $customers,
            ]);
        } else {
            return response([
                'message' => 'error',
                'customers' => 'No customers in database',
            ]);
        }
    }

    public function getCustomer(Request $request)
    {
        $request->validate(['id' => 'required']);
        $customer = CustomerModel::find($request->id);
        if ($customer) {
            return response([
                'message' => 'success',
                'customer' => $customer,
                'status' => 200,
            ]);
        } else {
            return response([
                'message' => 'error',
                'customer' => 'Customer does not exist',
                'status' => 404,
            ]);
        }
    }

    public function updateCustomer(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'name' => 'required',
            'phone' => 'required',
            'email' => 'nullable|email',
        ]);
        $customer = CustomerModel::find($request->id);
        if ($customer) {
            $customer->name = $request->name;
            $customer->phone = $request->phone;
            $customer->email = $request->email;
            $customer->user_id_updated = auth()->id();
            $customer->save();

            return response([
                'message' => 'success',
                'customer' => $customer,
                'status' => 200,
            ]);
        } else {
            return response([
                'message' => 'error',
                'customer' => 'Customer doesn\'t exist',
                'status' => 404,
            ]);
        }
    }

    public function deleteCustomer(Request $request)
    {
        $request->validate(['id' => 'required']);
        $customer = CustomerModel::find($request->id);
        if ($customer) {
            $customer->delete();

            return response([
                'message' => 'success',
                'customer' => 'Customer has been deleted successfully!',
                'status' => 200,
            ]);
        } else {
            return response([
                'message' => 'error',
                'customer' => 'Customer does not exist!',
                'status' => 404,
            ]);
        }
    }
}
