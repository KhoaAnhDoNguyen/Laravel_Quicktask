<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    // Hiển thị danh sách khách hàng
    public function index()
    {
        $customers = Customer::all();
        return view('dashboard', compact('customers'));
    }

    // Hiển thị form tạo mới khách hàng
    public function create()
    {
        return view('customers.create');
    }

    // Lưu khách hàng mới vào cơ sở dữ liệu
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'password' => 'required|string|min:6',
        ]);

        $customer = Customer::create([
            'username' => $request->username,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('dashboard')->with('success', 'Customer added successfully.');
    }

    // Hiển thị form chỉnh sửa khách hàng
    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    // Cập nhật thông tin khách hàng
    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'password' => 'required|string|min:6',
        ]);

        $customer->update([
            'username' => $request->username,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('dashboard')->with('success', 'Customer updated successfully.');
    }

    // Xóa khách hàng
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('dashboard')->with('success', 'Customer deleted successfully.');
    }
}