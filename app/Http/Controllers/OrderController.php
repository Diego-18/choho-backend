<?php

namespace App\Http\Controllers;

use App\Models\{Order, OrderDetail};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class OrderController extends Controller
{
    public function createOrder(Request $request): Response
    {
        try {
            $validator = Validator::make($request->all(), [
                'order_date' => 'required',
                'prefix' => 'required|string',
                'order_number' => 'required|numeric',
                'seller' => 'required|string',
                'provider_id' => 'required|numeric',
                'department_id' => 'required|numeric',
                'city_id' => 'required|numeric',
                'user_id' => 'required|numeric',
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

            $input = $request->all();

            DB::transaction(function () use ($input) {
                $order = new Order();
                $order->order_date = $input['order_date'];
                $order->prefix = $input['prefix'];
                $order->order_number = $input['order_number'];
                $order->seller = $input['seller'];
                $order->provider_id = $input['provider_id'];
                $order->department_id = $input['department_id'];
                $order->city_id = $input['city_id'];
                $order->user_id = $input['user_id'];
                $order->save();

                foreach ($input['detailOrder'] as $key => $value) {
                    $orderDetail = new OrderDetail();
                    $orderDetail->prefix = $value['prefix'];
                    $orderDetail->profile = $value['profile'];
                    $orderDetail->family = $value['family'];
                    $orderDetail->group = $value['group'];
                    $orderDetail->subgroup = $value['subgroup'];
                    $orderDetail->description = $value['description'];
                    $orderDetail->subtotal = $value['subtotal'];
                    $orderDetail->iva = $value['iva'];
                    $orderDetail->total = $value['total'];
                    $orderDetail->order_id = $value['order_id'];
                    $orderDetail->product_id = $value['product_id'];
                    $orderDetail->order_id = $order->id;
                    $orderDetail->save();
                };

                return Response()->json(
                    [
                        'message' =>
                        'Services Schedule successfully created.',
                        'status' => 200,
                    ],
                    200
                );
            });
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

    public function updateOrder(Request $request): Response
    {
        try {
            $validator = Validator::make($request->all(), [
                'order_date' => 'required',
                'prefix' => 'required|string',
                'order_number' => 'required|numeric',
                'seller' => 'required|string',
                'provider_id' => 'required|numeric',
                'department_id' => 'required|numeric',
                'city_id' => 'required|numeric',
                'user_id' => 'required|numeric',
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

            $input = $request->all();
            $input['orderId'] = $request->id;

            DB::transaction(function () use ($input) {
                $order = Order::findOrFail($input['orderId']);
                $order->order_date = $input['order_date'];
                $order->prefix = $input['prefix'];
                $order->order_number = $input['order_number'];
                $order->seller = $input['seller'];
                $order->provider_id = $input['provider_id'];
                $order->department_id = $input['department_id'];
                $order->city_id = $input['city_id'];
                $order->user_id = $input['user_id'];
                $order->save();

                OrderDetail::where('order_id', $input['orderId'])->delete();
                foreach ($input['detailOrder'] as $key => $value) {
                    $orderDetail = new OrderDetail();
                    $orderDetail->prefix = $value['prefix'];
                    $orderDetail->profile = $value['profile'];
                    $orderDetail->family = $value['family'];
                    $orderDetail->group = $value['group'];
                    $orderDetail->subgroup = $value['subgroup'];
                    $orderDetail->description = $value['description'];
                    $orderDetail->subtotal = $value['subtotal'];
                    $orderDetail->iva = $value['iva'];
                    $orderDetail->total = $value['total'];
                    $orderDetail->order_id = $value['order_id'];
                    $orderDetail->product_id = $value['product_id'];
                    $orderDetail->order_id = $order->id;
                    $orderDetail->save();
                }
                return Response()->json(
                    [
                        'message' =>
                        'Services Schedule successfully created.',
                        'status' => 200,
                    ],
                    200
                );
            });
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

    public function deleteOrder(Request $request): Response
    {
        try {
            DB::transaction(function () use ($request) {
                $id = $request->id;

                $orderDetail = OrderDetail::where(['order_id' => $id])->get();
                $countDetail = count($orderDetail);

                $countDetail > 0 ? $orderDetail->each->delete() : null;

                $order = Order::where(['id' => $id])->firstOrFail();
                $order->delete();
            });
            return Response()->json(
                [
                    'message' => 'Order successfully deleted.',
                    'status' => 200,
                ],
                200
            );
        } catch (\Exception $e) {
            return response()->json(
                [
                    'status' => false,
                    'error' => $e->getMessage(),
                ],
                500
            );
        }
    }
}
