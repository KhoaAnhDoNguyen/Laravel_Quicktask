<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function index()
    {
        return Customer::all();
    }

    public function store(Request $request)
    {
        $customer = Customer::create($request->all());
        return response()->json($customer, 201);
    }

    public function show(Customer $customer)
    {
        return $customer;
    }

    public function update(Request $request, Customer $customer)
    {
        $customer->update($request->all());
        return response()->json($customer, 200);
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();
        return response()->json(null, 204);
    }

    /**
     * Search customers by username.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search($request)
    {
        $customer = Customer::where('username', $request)->first();

        if ($customer) {
            return response()->json($customer, 200);
        } else {
            return response()->json(['message' => 'Customer not found'], 404);
        }
    }

    public function getCustomerOrders($customerId)
    {
        // Sử dụng Query Builder để join hai bảng và lấy dữ liệu
        $data = DB::table('customers')
            ->join('orders', 'customers.id', '=', 'orders.customer_id')
            ->where('customers.id', $customerId)
            ->select('customers.username', 'orders.order_details')
            ->get();

        if ($data->isNotEmpty()) {
            return response()->json($data, 200);
        } else {
            return response()->json(['message' => 'Customer or orders not found'], 404);
        }
    }
}
