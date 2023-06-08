<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

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

     public function logIn(Request $request): Response
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|string|email|max:255',
                'password' => 'required|string|min:6',
            ]);

            if ($validator->fails()) {
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'Faltan datos de entrada.',
                        'error' => $validator->errors(),
                    ],
                    406
                );
            }

            if (!Auth::attempt($request->all())) {
                return $this->error('Credentials not match', 401);
            }
            $user = User::where('email', $request['email'])->firstOrFail();

            if ($user) {
               $token = $user->createToken('auth_token')->plainTextToken;

                return response()->json(
                    [
                        'res' => true,
                        'token' => $token,
                        'user_id' => $user->id,
                        'user_name' => $user->name,
                    ],
                    200
                );
            } else {
                return response()->json(
                    [
                        'success' => false,
                        'error' => $validator->errors(),
                        'status' => 406,
                    ],
                    406
                );
            }
        } catch (\Exception $error) {
            return Response()->json(
                [
                    'message' => 'Invalid Credentials',
                    'error' => $error->getMessage(),
                    'line' => $error->getLine(),
                    'file' => $error->getFile(),
                ],
                500
            );
        }
    }

    public function logOut(User $user): Response
    {
        try {
            $user->tokens()->delete();

            return response()->json(
                [
                    'res' => true,
                    'msg' => 'Close session successfully',
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

    public function me(Request $request)
    {
        $user_logged = $request->user();
        $id = $user_logged['id'];
        $user = User::find($id);

        return $user;
    }
}
