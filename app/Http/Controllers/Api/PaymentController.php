<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Payment as PaymentModel;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function createPayment(Request $request)
    {
        $request->validate([
            'method_payment' => 'required',
            'total' => 'required|numeric',
        ]);

        $payment = PaymentModel::create([
            'method_payment' => $request->method_payment,
            'total' => $request->total,
            'user_id_created' => auth()->id(),
            'user_id_updated' => auth()->id(),
        ]);

        $payment = PaymentModel::find($payment->id);
        if ($payment) {
            return response([
                'message' => 'success',
                'payment' => $payment,
                'status' => 200,
            ]);
        } else {
            return response([
                'message' => 'error',
                'payment' => 'payment does not exist!',
                'status' => 404,
            ]);
        }
    }

    public function getAllPayments()
    {
        $payments = PaymentModel::all();
        if ($payments) {
            return response([
                'message' => 'Success',
                'payments' => $payments,
            ]);
        } else {
            return response([
                'message' => 'error',
                'payments' => 'No payments in database',
            ]);
        }
    }

    public function getPayment(Request $request)
    {
        $request->validate(['id' => 'required']);
        $payment = PaymentModel::find($request->id);
        if ($payment) {
            return response([
                'message' => 'success',
                'payment' => $payment,
                'status' => 200,
            ]);
        } else {
            return response([
                'message' => 'error',
                'payment' => 'Payment does not exist',
                'status' => 404,
            ]);
        }
    }

    public function updatePayment(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'method_payment' => 'required',
            'total' => 'required|numeric',
        ]);
        $payment = PaymentModel::find($request->id);
        if ($payment) {
            $payment->method_payment = $request->method_payment;
            $payment->total = $request->total;
            $payment->user_id_updated = auth()->id();
            $payment->save();

            return response([
                'message' => 'success',
                'payment' => $payment,
                'status' => 200,
            ]);
        } else {
            return response([
                'message' => 'error',
                'payment' => 'Payment doesn\'t exist',
                'status' => 404,
            ]);
        }
    }

    public function deletePayment(Request $request)
    {
        $request->validate(['id' => 'required']);
        $payment = PaymentModel::find($request->id);
        if ($payment) {
            $payment->delete();

            return response([
                'message' => 'success',
                'payment' => 'Payment has been deleted successfully!',
                'status' => 200,
            ]);
        } else {
            return response([
                'message' => 'error',
                'payment' => 'Payment does not exist!',
                'status' => 404,
            ]);
        }
    }
}
