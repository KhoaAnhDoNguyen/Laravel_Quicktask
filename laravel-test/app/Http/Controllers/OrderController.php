<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    // Lấy tất cả các đơn hàng
    public function index()
    {
        $orders = Order::all();
        return response()->json($orders, 200);
    }

    // Lấy một đơn hàng theo ID
    public function show($id)
    {
        $order = Order::find($id);

        if ($order) {
            return response()->json($order, 200);
        } else {
            return response()->json(['message' => 'Order not found'], 404);
        }
    }

    // Tạo một đơn hàng mới
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'order_details' => 'required|string',
        ]);

        $order = Order::create($validatedData);

        return response()->json($order, 201);
    }

    // Cập nhật một đơn hàng
    public function update(Request $request, $id)
    {
        $order = Order::find($id);

        if ($order) {
            $validatedData = $request->validate([
                'customer_id' => 'required|exists:customers,id',
                'order_details' => 'required|string',
            ]);

            $order->update($validatedData);

            return response()->json($order, 200);
        } else {
            return response()->json(['message' => 'Order not found'], 404);
        }
    }

    // Xóa một đơn hàng
    public function destroy($id)
    {
        $order = Order::find($id);

        if ($order) {
            $order->delete();
            return response()->json(['message' => 'Order deleted successfully'], 200);
        } else {
            return response()->json(['message' => 'Order not found'], 404);
        }
    }
}

