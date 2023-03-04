<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Mail\NewOrder;
use App\Models\Product;
use App\Models\orderStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Providers\RouteServiceProvider;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $titlename = "Orders";

        if (Auth::guest()) {
            return redirect(route('viewLogin'));
        }

        if (Auth::user()->role == 1 || Auth::user()->role == 2) {
            $orders = Order::orderBy('id', 'desc')->paginate(10);
        } else {
            $orders = Order::where('user_id', Auth::user()->id)->paginate(10);
        }

        return view('dashboard.orders', compact('titlename', 'orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Show order form
        $titlename = 'Place order';
        $products = Product::all();
        if (Auth::guest()) {
            return redirect(route('viewLogin'));
        }
        return view('dashboard.createOrder', compact('titlename', 'products'));
    }

    public function createMobile()
    {
        // Show order form
        $titlename = 'Place order';
        $products = Product::all();
        if (Auth::guest()) {
            return redirect(route('viewLogin'));
        }
        return view('dashboard.createOrderMobile', compact('titlename', 'products'));
    }

    public function createdMobile()
    {
        // Show order form
        $titlename = 'Order Placed';
        if (Auth::guest()) {
            return redirect(route('viewLogin'));
        }
        return view('dashboard.orderCreatedMobile', compact('titlename'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'fullName' => 'required',
            'email' => '',
            'phone' => 'required|digits:10',
            'additionalPhone' => 'digits:10|nullable',
            'location' => 'required',
            'address' => 'required',
            'user_id' => 'required',
            'product_id' => 'required',
            'qty' => 'required',
            'discount' => '',
            'advance' => '',
            'gateway' => 'required',
            'payment_status' => 'required',
            'note' => '',
        ]);
        $formFields['order_status'] = 'pending';

        $p = Product::where('id', $formFields['product_id'])->first();

        if ($formFields['location'] == 'inside') {
            $delivery = 100;
        } else {
            $delivery = 150;
        }

        $formFields['total_price'] = ($request['qty'] * $p['price']) - $formFields['discount'] + $delivery;

        Order::create($formFields);

        $name = $formFields['fullName'];
        $phone = $formFields['phone'];
        $address = $formFields['address'];
        $product = $p['name'];
        $order = Order::orderBy('id', 'desc')->first();
        $userquery = User::where('id', $formFields['user_id'])->first();
        $user = $userquery->name;
        $userEmail = $userquery->email;
        $orderNumber = $order->id;
        $total_price = $order->total_price;

        Mail::to($userEmail)->send(new NewOrder($name, $phone, $address, $orderNumber, $product, $total_price, $user));
        Mail::to('orders@vidantaca.com.np')->send(new NewOrder($name, $phone, $address, $orderNumber, $product, $total_price, $user));

        return redirect(route('orders'))->with('success', 'Order placed successfully.');
    }

    public function storeMobile(Request $request)
    {
        $formFields = $request->validate([
            'fullName' => 'required',
            'email' => '',
            'phone' => 'required|digits:10',
            'additionalPhone' => 'digits:10|nullable',
            'location' => 'required',
            'address' => 'required',
            'user_id' => 'required',
            'product_id' => 'required',
            'qty' => 'required',
            'discount' => '',
            'advance' => '',
            'gateway' => 'required',
            'payment_status' => 'required',
            'note' => '',
        ]);
        $formFields['order_status'] = 'pending';

        $p = Product::where('id', $formFields['product_id'])->first();

        if ($formFields['location'] == 'inside') {
            $delivery = 100;
        } else {
            $delivery = 150;
        }

        $formFields['total_price'] = ($request['qty'] * $p['price']) - $formFields['discount'] + $delivery;

        Order::create($formFields);

        $name = $formFields['fullName'];
        $phone = $formFields['phone'];
        $address = $formFields['address'];
        $product = $p['name'];
        $order = Order::orderBy('id', 'desc')->first();
        $userquery = User::where('id', $formFields['user_id'])->first();
        $user = $userquery->name;
        $userEmail = $userquery->email;
        $orderNumber = $order->id;
        $total_price = $order->total_price;
        Mail::to($userEmail)->send(new NewOrder($name, $phone, $address, $orderNumber, $product, $total_price, $user));
        Mail::to('orders@aphrodite.com.np')->send(new NewOrder($name, $phone, $address, $orderNumber, $product, $total_price, $user));

        return redirect(route('created_orders_mobile'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        $titlename = 'Order #' . $order->id;
        $order_id = $order->id;
        if (Auth::guest()) {
            return redirect(route('viewLogin'));
        }
        return view('dashboard.singleOrder', compact('titlename', 'order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        $titlename = "Edit order";
        $products = Product::all();
        if (Auth::guest()) {
            return redirect(route('viewLogin'));
        }
        return view('dashboard.editOrder', compact('order', 'titlename', 'products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $formFields = $request->validate([
            'fullName' => 'required',
            'email' => '',
            'phone' => 'required|digits:10',
            'additionalPhone' => 'digits:10|nullable',
            'location' => 'required',
            'address' => 'required',
            'user_id' => 'required',
            'product_id' => 'required',
            'qty' => 'required',
            'discount' => '',
            'advance' => '',
            'gateway' => 'required',
            'payment_status' => 'required',
            'note' => '',
        ]);
        $formFields['order_status'] = $request['order_status'];

        $p = Product::where('id', $formFields['product_id'])->first();

        if ($formFields['location'] == 'inside') {
            $delivery = 100;
        } else {
            $delivery = 150;
        }

        $formFields['total_price'] = ($request['qty'] * $p['price']) - $formFields['discount'] + $delivery;
        $order->update($formFields);

        return redirect()->back()->with('success', 'Order updated successfully.');
    }

    public function updateStatus(Request $request, Order $order)
    {

        $formFields['order_status'] = $request['order_status'];
        if ($formFields['order_status'] == 'delivered') {
            $formFields['payment_status'] = 'paid';
        }
        $order->update($formFields);
        return redirect()->back()->with('success', 'Order updated successfully.');
    }

    public function updateNote(Request $request, Order $order)
    {

        $formFields['note'] = $request['note'];
        $order->update($formFields);
        return redirect()->back()->with('success', 'Note updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return redirect(route('orders'))->with('success', 'Order deleted successfully.');
    }

    // Order Placed View
    public function completed()
    {
        $titlename = 'Order Placed';
        return view('orders.completed', compact('titlename'));
    }
}
