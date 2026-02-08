<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Branch as BranchModel;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    public function createBranch(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);
        /* we create the record as shown below: */

        $branch = BranchModel::create([
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'user_id_created' => auth()->id(),
            'user_id_updated' => auth()->id(),
        ]);

        $branch = BranchModel::find($branch->id);
        if ($branch) {
            return response(
                [
                    'message' => 'success',
                    'branch' => $branch,
                    'status' => 200,
                ]
            );
        } else {
            return response(
                [
                    'message' => 'error',
                    'branch' => 'branch does not exist!',
                    'status' => 404,
                ]
            );
        }
    }

    /*
    READ ALL BRANCHES
    */
    public function getAllBranches()
    {
        $branches = BranchModel::all();
        if ($branches) {
            return response([
                'message' => 'Success',
                'branches' => $branches,
            ]);
        } else {
            return response([
                'message' => 'error',
                'branches' => 'No branches in database',
            ]);
        }
    }

    public function getBranch(Request $request)
    {
        $request->validate(['id' => 'required']);
        $branch = BranchModel::find($request->id);
        if ($branch) {
            return response([
                'message' => 'success',
                'branch' => $branch,
                'status' => 200,
            ]);
        } else {
            return response([
                'message' => 'error',
                'branch' => 'Branch does not exist',
                'status' => 404,
            ]);
        }
    }

    public function updateBranch(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);
        $branch = BranchModel::find($request->id);
        if ($branch) {
            $branch->name = $request->name;
            $branch->address = $request->address;
            $branch->phone = $request->phone;
            $branch->latitude = $request->latitude;
            $branch->longitude = $request->longitude;
            $branch->user_id_updated = auth()->id();
            $branch->save();

            return response([
                'message' => 'success',
                'branch' => $branch,
                'status' => 200,
            ]);
        } else {
            return response([
                'message' => 'error',
                'branch' => 'Branch doesn\'t exist',
                'status' => 404,
            ]);
        }
    }

    public function deleteBranch(Request $request)
    {
        $request->validate(['id' => 'required']);
        $branch = BranchModel::find($request->id);
        if ($branch) {
            $branch->delete();

            return response([
                'message' => 'success',
                'branch' => 'Branch has been deleted successfully!',
                'status' => 200,
            ]);
        } else {
            return response([
                'message' => 'error',
                'branch' => 'Branch does not exist!',
                'status' => 404,
            ]);
        }
    }
}
