<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Mail\NewOrder;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class DashboardController extends Controller
{
    // Index of dashboard
    public function index()
    {
        $titlename = "Dashboard";
        if (Auth::guest()) {
            return redirect(route('viewLogin'));
        }
        if (Auth::user()->role == 1 || Auth::user()->role == 2) {
            $totalToday = Order::whereDate('created_at', Carbon::today())->count();
            $thisMonth = Order::whereMonth('created_at', date('m'))->count();
            $pending = Order::where('order_status', 'pending')->count();
            $pendingOrders = Order::where('order_status', 'pending')->paginate(10, ['*'], 'pendings');
            $confirmed = Order::where('order_status', 'confirmed')->count();
            $confirmedOrders = Order::where('order_status', 'confirmed')->paginate(10, ['*'], 'confirmed');
            $ncmOrders = Order::where('order_status', 'ncm')->paginate(10, ['*'], 'ncm');
            $dispatchedOrders = Order::where('order_status', 'dispatch')->paginate(10, ['*'], 'dispatched');
            $deliveredOrders = Order::where('order_status', 'delivered')->orWhere('order_status', 'follow1')->orWhere('order_status', 'follow2')->orWhere('order_status', 'follow3')->paginate(10, ['*'], 'delivered');
            $ncm = Order::where('order_status', 'ncm')->count();
            $delivered = Order::where('order_status', 'delivered')->count();
            $dispatched = Order::where('order_status', 'dispatch')->count();
            $canceled = Order::where('order_status', 'canceled')->count();
        } else {
            $totalToday = Order::whereDate('created_at', Carbon::today())->where('user_id', Auth::user()->id)->count();
            $thisMonth = Order::whereMonth('created_at', date('m'))->where('user_id', Auth::user()->id)->count();
            $pending = Order::where('order_status', 'pending')->where('user_id', Auth::user()->id)->count();
            $pendingOrders = Order::where('order_status', 'pending')->where('user_id', Auth::user()->id)->paginate(10, ['*'], 'pendings');
            $confirmed = Order::where('order_status', 'confirmed')->where('user_id', Auth::user()->id)->count();
            $confirmedOrders = Order::where('order_status', 'confirmed')->where('user_id', Auth::user()->id)->paginate(10, ['*'], 'confirmed');
            $ncmOrders = Order::where('order_status', 'ncm')->where('user_id', Auth::user()->id)->paginate(10, ['*'], 'ncm');
            $dispatchedOrders = Order::where('order_status', 'dispatch')->where('user_id', Auth::user()->id)->paginate(10, ['*'], 'dispatched');
            $deliveredOrders = Order::where('order_status', 'delivered')->orWhere('order_status', 'follow1')->orWhere('order_status', 'follow2')->orWhere('order_status', 'follow3')->where('user_id', Auth::user()->id)->paginate(10, ['*'], 'delivered');
            $ncm = Order::where('order_status', 'ncm')->where('user_id', Auth::user()->id)->count();
            $delivered = Order::where('order_status', 'delivered')->where('user_id', Auth::user()->id)->count();
            $dispatched = Order::where('order_status', 'dispatch')->where('user_id', Auth::user()->id)->count();
            $canceled = Order::where('order_status', 'canceled')->where('user_id', Auth::user()->id)->count();
        }
        return view('dashboard.index', compact('titlename', 'totalToday', 'thisMonth', 'pending', 'delivered', 'confirmed', 'ncm', 'dispatched', 'canceled', 'pendingOrders', 'confirmedOrders', 'deliveredOrders', 'ncmOrders', 'dispatchedOrders'));
    }
}
