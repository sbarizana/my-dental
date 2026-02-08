<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PaymentDetail as PaymentDetailModel;
use Illuminate\Http\Request;

class PaymentDetailController extends Controller
{
    public function createPaymentDetail(Request $request)
    {
        $paymentDetail = PaymentDetailModel::create([
            'user_id_created' => auth()->id(),
            'user_id_updated' => auth()->id(),
        ]);

        $paymentDetail = PaymentDetailModel::find($paymentDetail->id);
        if ($paymentDetail) {
            return response([
                'message' => 'success',
                'paymentDetail' => $paymentDetail,
                'status' => 200,
            ]);
        } else {
            return response([
                'message' => 'error',
                'paymentDetail' => 'paymentDetail does not exist!',
                'status' => 404,
            ]);
        }
    }

    public function getAllPaymentDetails()
    {
        $paymentDetails = PaymentDetailModel::all();
        if ($paymentDetails) {
            return response([
                'message' => 'Success',
                'paymentDetails' => $paymentDetails,
            ]);
        } else {
            return response([
                'message' => 'error',
                'paymentDetails' => 'No paymentDetails in database',
            ]);
        }
    }

    public function getPaymentDetail(Request $request)
    {
        $request->validate(['id' => 'required']);
        $paymentDetail = PaymentDetailModel::find($request->id);
        if ($paymentDetail) {
            return response([
                'message' => 'success',
                'paymentDetail' => $paymentDetail,
                'status' => 200,
            ]);
        } else {
            return response([
                'message' => 'error',
                'paymentDetail' => 'PaymentDetail does not exist',
                'status' => 404,
            ]);
        }
    }

    public function updatePaymentDetail(Request $request)
    {
        $request->validate(['id' => 'required']);
        $paymentDetail = PaymentDetailModel::find($request->id);
        if ($paymentDetail) {
            $paymentDetail->user_id_updated = auth()->id();
            $paymentDetail->save();

            return response([
                'message' => 'success',
                'paymentDetail' => $paymentDetail,
                'status' => 200,
            ]);
        } else {
            return response([
                'message' => 'error',
                'paymentDetail' => 'PaymentDetail doesn\'t exist',
                'status' => 404,
            ]);
        }
    }

    public function deletePaymentDetail(Request $request)
    {
        $request->validate(['id' => 'required']);
        $paymentDetail = PaymentDetailModel::find($request->id);
        if ($paymentDetail) {
            $paymentDetail->delete();

            return response([
                'message' => 'success',
                'paymentDetail' => 'PaymentDetail has been deleted successfully!',
                'status' => 200,
            ]);
        } else {
            return response([
                'message' => 'error',
                'paymentDetail' => 'PaymentDetail does not exist!',
                'status' => 404,
            ]);
        }
    }
}
