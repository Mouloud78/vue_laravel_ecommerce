<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthAdminRequest;
use App\Models\Order;
use Illuminate\Support\Carbon;

class AdminController extends Controller
{
    /**
     * Fetch today yesterday this month and this year orders
     */
    public function index()
    {
        /**
         *  Fetch today, yesterday, this month and this year orders
         */
        $todayOrders = Order::whereDay('created_at', Carbon::today())->get();
        $yesterdayOrders = Order::whereDay('created_at', Carbon::yesterday())->get();
        $monthOrders = Order::whereDay('created_at', Carbon::now()->month)->get();
        $yearOrders = Order::whereDay('created_at', Carbon::now()->year)->get();

        /**
         *  Return the view with the orders
         */
        return view('admin.dashboard')->with([
            'todayOrders' => $todayOrders,
            'yesterdayOrders' => $yesterdayOrders,
            'monthOrders' => $monthOrders,
            'yearOrders' => $yearOrders,
        ]);
    }

    /**
     * display the login form
     */

    public function login()
    {
        if (!auth()->guard('admin')->check()) {
            return view('login');
        }
        return redirect()->route('admin.index');
    }

    /**
     * Login the admin
     *
     * @return void
     */
    public function auth(AuthAdminRequest $request)
    {
        if ($request->validated()) {
            if (auth()->guard('admin')->attempt([
                'email' => $request->email,
                'password' => $request->password
            ])) {
                $request->session()->regenerate();
                return redirect()->route('admin.index');
            } else {
                return redirect()->route('admin.login')->with([
                    'error' => 'These credentials do not match our records.'
                ]);
            }
        }
    }

    public function logout()
    {
        auth()->guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
