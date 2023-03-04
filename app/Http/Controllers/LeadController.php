<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\User;
use App\Models\Order;
use App\Mail\NewOrder;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class LeadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $titlename = 'Leads';
        $users = Lead::where('claimed', 0)->paginate(10);
        if(Auth::guest()){
            return redirect(route('viewLogin'));
        }
        return view('dashboard.leads', compact('titlename', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required'
        ]);
        Lead::create($formFields);
        return redirect()->route('lead_created');
    }

    public function created() {
        $titlename = 'Order Placed';
        return view('orderplaced', compact('titlename'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function show(Lead $lead)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function edit(Lead $lead)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lead $lead)
    {
        $update['claimed'] = 1;
        $update['user_id'] = $request['user_id'];
        $lead->update($update);
        $formFields = $request->validate([
            'user_id' => '',
            'product_id' => '',
        ]);

        $formFields['fullName'] = $lead['name'];
        $formFields['phone'] = $lead['phone'];
        $formFields['address'] = $lead['address'];
        $formFields['order_status'] = 'pending';

        Order::create($formFields);
        
        $order = Order::orderBy('id', 'desc')->first();
        $orderNumber = $order->id;

        return redirect(route('orders') . '/' . $orderNumber . '/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lead $lead)
    {
        //
    }
}
