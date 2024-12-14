<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::where('user_id', auth('api')->user()->id)->get();
        return response()->json([
            "Message : " => "Orders Retrieved Successfully",
            "Orders : "  => $ordres
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    // update quantities after making an order
    /*
        'user_id',
        'order_price',
        'order_status',
    */
    public function store(Request $request)
    {
        $id = auth('api')->user()->id;
        $cart = Cart::where('user_id', $id)->get();

        // create order:
        $input['user_id'] = auth('api')->user()->id;
        $input['order_price'] = 0;
        foreach($cart as $x){
            $product = Product::where('id', $x->product)->first();
            $input['order_price'] += ($x->order_quantity)*$med->price;
        }
        $input['order_status'] = "in_progress";
        $order = Order::create($input);
        $order->save();

       return response()->json([
            "Message : " => "Order Create Successfully",
            "Order : " => $order
       ]);
    }
    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }

    public function status_update($new_status)
    {
        
    }
}
