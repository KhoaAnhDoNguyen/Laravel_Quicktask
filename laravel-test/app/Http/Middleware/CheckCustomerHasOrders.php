<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Customer;

class CheckCustomerHasOrders
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Giả định rằng ID của khách hàng được truyền qua route
        $customerId = $request->route('customer');

        // Tìm customer với ID được truyền qua
        $customer = Customer::find($customerId);

        if (!$customer || $customer->orders->isEmpty()) {
            // Nếu customer không tồn tại hoặc không có đơn hàng, chuyển hướng về trang 'no-orders'
            return redirect('no-orders');
        }

        return $next($request);
    }
}
