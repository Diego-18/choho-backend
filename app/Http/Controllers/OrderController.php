<?php

namespace App\Http\Controllers;

use App\Models\{Order, OrderDetail};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class OrderController extends Controller
{
    public function getAllOrders(Request $request): Response
    {
        try {
             if ($request->select){
                $orders = Order::orderBy('number_order')->get();
            }
            elseif ($request->search) {
                $orders = Order::where(
                    'name',
                    'LIKE',
                    "%{$request->search}%"
                )
                ->paginate(10);
            } else {
                $orders = Order::paginate(10);
            }

            for ($index = 0; $index < count($orders); $index++) {
                $order = Order::find($orders[$index]['id']);

                $orderDetail = $order->detail;
                $orders[$index]['details'] = $orderDetail;

                $orderDepartment = $order->department;
                $orders[$index]['department'] = $orderDepartment;

                $orderCity = $order->city;
                $orders[$index]['city'] = $orderCity;
            }

            return Response()->json(
                [
                    'data' => $orders,
                    'message' => 'All Orders successfully',
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

    public function createOrder(Request $request): Response
    {
        try {
            $validator = Validator::make($request->all(), [
                'order_date' => 'required',
                'prefix' => 'required|string',
                'order_number' => 'required',
                'seller' => 'required|string',
                'customer_id' => 'required|numeric',
                'department_id' => 'required|numeric',
                'city_id' => 'required|numeric',
                'detailOrder' => 'required|array'
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
                $order->customer_id = $input['customer_id'];
                $order->department_id = $input['department_id'];
                $order->city_id = $input['city_id'];
                $order->user_id = $input['user_id'];
                $order->save();


                $orderDetail = new OrderDetail();
                $orderDetail->prefix = $input['prefix'];
                $orderDetail->profile = $input['detailOrder']['profile'];
                $orderDetail->family = $input['detailOrder']['family'];
                $orderDetail->group = $input['detailOrder']['group'];
                $orderDetail->subgroup = $input['detailOrder']['subgroup'];
                $orderDetail->description = $input['detailOrder']['description'];
                $orderDetail->subtotal = $input['detailOrder']['subtotal'];
                $orderDetail->iva = $input['detailOrder']['iva'];
                $orderDetail->total = $input['detailOrder']['total'];
                $orderDetail->product_id = $input['detailOrder']['product_id'];
                $orderDetail->type_tax = $input['detailOrder']['type_tax'];
                $orderDetail->order_id = $order->id;
                $orderDetail->save();
            });

            return Response()->json(
                    [
                        'message' =>
                        'Services Schedule successfully created.',
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

    public function updateOrder(Request $request): Response
    {
        try {
            $validator = Validator::make($request->all(), [
                'order_date' => 'required',
                'prefix' => 'required|string',
                'order_number' => 'required|numeric',
                'seller' => 'required|string',
                'customer_id' => 'required|numeric',
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
                $order->customer_id = $input['customer_id'];
                $order->department_id = $input['department_id'];
                $order->city_id = $input['city_id'];
                $order->user_id = $input['user_id'];
                $order->save();

                OrderDetail::where('order_id', $input['orderId'])->delete();
                $orderDetail = new OrderDetail();
                $orderDetail->prefix = $input['prefix'];
                $orderDetail->profile = $input['detailOrder']['profile'];
                $orderDetail->family = $input['detailOrder']['family'];
                $orderDetail->group = $input['detailOrder']['group'];
                $orderDetail->subgroup = $input['detailOrder']['subgroup'];
                $orderDetail->description = $input['detailOrder']['description'];
                $orderDetail->subtotal = $input['detailOrder']['subtotal'];
                $orderDetail->iva = $input['detailOrder']['iva'];
                $orderDetail->total = $input['detailOrder']['total'];
                $orderDetail->product_id = $input['detailOrder']['product_id'];
                $orderDetail->type_tax = $input['detailOrder']['type_tax'];
                $orderDetail->order_id = $order->id;
                $orderDetail->save();
            });

            return Response()->json(
                    [
                        'message' =>
                        'Services Schedule successfully created.',
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
