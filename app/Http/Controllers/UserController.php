<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function getAllUsers(): Response {
        try {
            $users = User::all();

             return Response()->json(
                [
                    'data' => $users,
                    'message' => 'all Users.',
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

    public function createUser(Request $request): Response {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'email' => 'required|string',
                'password' => 'required',
                'rol_user' => 'required|integer',
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

            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->rol_user = $request->rol_user;
            $user->active = $request->active;
            $user->save();

            return Response()->json(
                [
                    'message' => 'User successfully created.',
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
}
