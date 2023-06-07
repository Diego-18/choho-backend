<?php

namespace App\Http\Controllers;

use App\Models\Provider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;


class ProviderController extends Controller
{
    public function getAllProviders(): Response {
        try {
            $providers = Provider::all();

             return Response()->json(
                [
                    'data' => $providers,
                    'message' => 'all Providers.',
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

    public function createProvider(Request $request): Response {
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

            $provider = new Provider();
            $provider->create($request->all());

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

    public function updateProvider(Request $request): Response{
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

            if (Provider::where(['id' => $id])->exists()) {
                $provider = Provider::findOrFail($id);
                $provider->update($request->all());

                return response()->json([
                    'status' => 200,
                    'msg' => 'Provider successfully updated.',
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

    public function deleteProvider(Request $request): Response {
        try {
            $id = $request->id;
            if (Provider::where(['id' => $id])->exists()) {
                $provider = Provider::where(['id' => $id])->first();
                $provider->delete();

                return response()->json([
                    'status' => 200,
                    'msg' => 'Provider successfully deleted.',
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
