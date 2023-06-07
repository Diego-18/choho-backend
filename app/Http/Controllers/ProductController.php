<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    public function getAllProducts(Request $request): Response {
        try {
            if ($request->select){
                $product = Product::orderBy('name')->get();
            }
            elseif ($request->search) {
                $product = Product::where(
                    'name',
                    'LIKE',
                    "%{$request->search}%"
                )
                ->paginate(10);
            } else {
                $product = Product::paginate(10);
            }

            return Response()->json(
                [
                    'data' => $product,
                    'message' => 'All Products successfully',
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

    public function createProduct(Request $request): Response {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
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

            $product = new Product();
            $product->create($request->all());

            return Response()->json(
                [
                    'message' => 'Product successfully created.',
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

    public function updateProduct(Request $request): Response{
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
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

            if (Product::where(['id' => $id])->exists()) {
                $product = Product::findOrFail($id);
                $product->update($request->all());

                return response()->json([
                    'status' => 200,
                    'msg' => 'Product successfully updated.',
                ]);
            } else {
                return response()->json([
                    'status' => 404,
                    'msg' => 'Product not found.',
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

    public function deleteProduct(Request $request): Response {
        try {
            $id = $request->id;
            if (Product::where(['id' => $id])->exists()) {
                $product = Product::where(['id' => $id])->first();
                $product->delete();

                return response()->json([
                    'status' => 200,
                    'msg' => 'Product successfully deleted.',
                ]);
            } else {
                return response()->json([
                    'status' => 404,
                    'msg' => 'Product not found.',
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
