<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;


class CustomerController extends Controller
{
    public function getAllCustomers(Request $request): Response {
        try {
            if ($request->select){
                $customer = Customer::orderBy('razon_social')->get();
            }
            elseif ($request->search) {
                $customer = Customer::where(
                    'razon_social',
                    'LIKE',
                    "%{$request->search}%"
                )
                ->paginate(10);
            } else {
                $customer = Customer::paginate(10);
            }

            return Response()->json(
                [
                    'data' => $customer,
                    'message' => 'All Customers successfully',
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

    public function createCustomer(Request $request): Response {
        try {
            $validator = Validator::make($request->all(), [
                'nit' => 'required|string',
                'razon_social' => 'required|string',
                'type' => 'required|integer',
                'active' => 'required|integer',
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

            $customer = new Customer();
            $customer->create($request->all());

            return Response()->json(
                [
                    'message' => 'Provider successfully created.',
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

    public function updateCustomer(Request $request): Response{
        try {
            $validator = Validator::make($request->all(), [
                'nit' => 'required|string',
                'razon_social' => 'required|string',
                'type' => 'required|integer',
                'active' => 'required|integer',
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

            if (Customer::where(['id' => $id])->exists()) {
                $customer = Customer::findOrFail($id);
                $customer->update($request->all());

                return response()->json([
                    'status' => 200,
                    'msg' => 'Customer successfully updated.',
                ]);
            } else {
                return response()->json([
                    'status' => 404,
                    'msg' => 'Customer not found.',
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

    public function deleteCustomer(Request $request): Response {
        try {
            $id = $request->id;
            if (Customer::where(['id' => $id])->exists()) {
                $customer = Customer::where(['id' => $id])->first();
                $customer->delete();

                return response()->json([
                    'status' => 200,
                    'msg' => 'Customer successfully deleted.',
                ]);
            } else {
                return response()->json([
                    'status' => 404,
                    'msg' => 'Customer not found.',
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
