<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiOrderShowRequest;
use App\Http\Requests\ApiOrderStoreRequest;
use App\Models\Order;
use Illuminate\Http\Request;

class ApiOrderController extends Controller
{
    /**
     * Create new order through API
     *
     * @param ApiOrderStoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function store(ApiOrderStoreRequest $request) {

        // Get validated data from the request
        $data = $request->validated();

        // Get product ids from the request
        $productIds = $data['product_ids'];

        // Unset product ids from the request
        unset($data['product_ids']);

        // Save order data to the database
        $order = Order::create($data);

        // Attach product ids to the order
        $order->products()->attach($productIds);

        // Return order_id
        return response()
            ->json([
                'status' => true,
                'order_id' => $order->id
            ])
            ->setStatusCode(201);
    }

    /**
     * Get all orders through API
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index() {

        // Get all orders from the database
        $orders = Order::all();

        // If orders found return orders data
        if ($orders->count() > 0) {
            return response()
                ->json([
                    'status' => true,
                    'orders' => $orders
                ])
                ->setStatusCode(200);
        } else {
            return response()
                ->json([
                    'status' => false,
                    'message' => 'Orders not found',
                ])
                ->setStatusCode(404);
        }
    }

    /**
     * Get order by id through API
     *
     * @param ApiOrderShowRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(ApiOrderShowRequest $request) {

        // Get validated data (order_id) from the request
        $data = $request->validated();

        // Get the order from the database by order_id
        $order = Order::find($data['order_id']);

        // Create order data response
        $response = [
            'id' => $order->id,
            'status' => $order->status,
            'need_delivery' => $order->need_delivery,
            'delivery_period' => $order->delivery_period,
            'user_id' => $order->user_id,
            'user_phone' => $order->user->phone,
            'user_address' => $order->user->address,
            'products' => $order->products,
        ];

        // Return order data response
        return response()->json([
            'status' => true,
            'order' => $response
        ]);
    }
}
