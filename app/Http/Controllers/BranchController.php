<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class BranchController extends Controller
{
    public function getAllBranchs(): Response {
        try {
            $branchs = Branch::all();

             return Response()->json(
                [
                    'data' => $branchs,
                    'message' => 'all Branchs.',
                    'status' => 200,
                ],
                500
            );

        } catch (\Exception $error) {
            return Response()->json(
                [
                    'message' => $error->getMessage(),
                    'line' => $error->getLine(),
                    'file' => $error->getFile(),
                ],
                500
            );
        }
    }

    public function createBranch(Request $request): Response {
        try {
            $validator = Validator::make($request->all(), [
                'nit' => 'required|string',
                'phone' => 'required|string',
                'address' => 'required|string',
                'department_id' => 'required|integer',
                'city_id' => 'required|integer',
            ]);

            if ($validator->fails()) {
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'Missing input data.',
                        'error' => $validator->errors(),
                        'status' => 406,
                    ],
                    406
                );
            }

            $branch = new Branch();
            $branch->create($request->all());

            return Response()->json(
                [
                    'message' => 'Branch successfully created.',
                    'status' => 200,
                ],
                200
            );

        } catch (\Exception $error) {
            return Response()->json(
                [
                    'message' => $error->getMessage(),
                    'line' => $error->getLine(),
                    'file' => $error->getFile(),
                ],
                500
            );
        }
    }

    public function updateBranch(Request $request): Response{
        try {
            $validator = Validator::make($request->all(), [
                'nit' => 'required|string',
                'phone' => 'required|string',
                'address' => 'required|string',
                'department_id' => 'required|integer',
                'city_id' => 'required|integer',
            ]);

            if ($validator->fails()) {
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'Missing input data.',
                        'error' => $validator->errors(),
                        'status' => 406,
                    ],
                    406
                );
            }

            $id = $request->id;

            if (Branch::where(['id' => $id])->exists()) {
                $branch = Branch::findOrFail($id);
                $branch->update($request->all());

                return response()->json([
                    'status' => 200,
                    'msg' => 'Branch successfully updated.',
                ]);
            } else {
                return response()->json([
                    'status' => 404,
                    'msg' => 'Provider not found.',
                ]);
            }
        } catch (\Exception $error) {
            return Response()->json(
                [
                    'message' => $error->getMessage(),
                    'line' => $error->getLine(),
                    'file' => $error->getFile(),
                ],
                500
            );
        }
    }

    public function deleteBranch(Request $request): Response {
        try {
            $id = $request->id;
            if (Branch::where(['id' => $id])->exists()) {
                $branch = Branch::where(['id' => $id])->first();
                $branch->delete();

                return response()->json([
                    'status' => 200,
                    'msg' => 'Branch successfully deleted.',
                ]);
            } else {
                return response()->json([
                    'status' => 404,
                    'msg' => 'Provider not found.',
                ]);
            }
        } catch (\Exception $error) {
            return Response()->json(
                [
                    'message' => $error->getMessage(),
                    'line' => $error->getLine(),
                    'file' => $error->getFile(),
                ],
                500
            );
        }
    }
}
