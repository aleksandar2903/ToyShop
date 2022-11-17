<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Toy;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::latest()->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!auth()->user()->cart->isEmpty())
        {
            return view('orders.create',['toys'=>auth()->user()->cart]);
        }

        return back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'zip' => 'required|size:5',
            'card_number' => 'required|digits:10|numeric',
            'card_name' => 'required|min:3',
            'expiration' => 'required|size:7',
            'shippingAddress' => 'required|min:3',
            'cvv' => 'required|digits:4|numeric',
        ]);
        $order = auth()->user()->order()->create($request->all());
        foreach (auth()->user()->cart as $toy) {
            $order->toys()->create([
                'toy_id' => $toy->toy_id,
                'quantity' => $toy->quantity,
                'total_amount' => $toy->totalAmount
            ]);
            $toy->delete();
        }
        return redirect()->route('orders.myorders');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }

    public function myOrders(Order $order)
    {
        $orders = auth()->user()->order;
        return view('orders.index', compact('orders'));
    }
    public function myOrder(Order $order)
    {
        return view('orders.show', compact('order'));
    }
}
