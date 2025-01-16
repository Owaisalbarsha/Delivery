<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::
                        where('state', 'pending')
                        ->get();
        return response()->json([
            "Message" => "Orders Retrieved Successfully",
            "Order"  => $orders
        ]);
    }
    public function index1()
    {
        $orders = Order::where('user_id', auth('api')->user()->id)
                        //->where('state', 'pending')
                        ->get();
        return response()->json([
            "Message" => "Orders Retrieved Successfully",
            "Order"  => $orders
        ]);
    }
    public function details(Request $request)
    {
        $user = auth('api')->user();
        $order = Order::where('id', $request->order_id)->first();
        // dd($order);
        $order_items = $order->items()->with('product')->get();
        foreach ($order_items as $item) {
            $item->product->image = asset('storage/images/' . basename($item->product->image));
        }
        return response()->json([
            "Items" => $order_items,
            "Message : " => "Retrieved Successfully"
        ], 200);
    }
    /**
     * Show the form for creating a new resource.
     */
    // get, edit, driver,
    public function create(Request $request)
    {
        $user_id = auth('api')->user()->id;

        $cart = Cart::where('user_id', $user_id)->get();

        if ($cart->isEmpty()) {
            return response()->json([
                "message" => "Cannot create an order with an empty cart.",
            ], 400);
        }

        $total_cost = 0;
        foreach ($cart as $item) {
            $total_cost += $item->price;
        }

        $input = [
            'user_id' => $user_id,
            'cost' => $total_cost,
            'state' => 'pending',
            'pay_status' => $request->pay_status,
            'location' => $request->location
        ];

        $order = Order::create($input);

        foreach ($cart as $item) {
           $order->items()->create([
               'product_id' => $item->product_id,
               'quantity' => $item->quantity,
               'price' => $item->price,
            ]);
        }

        Cart::where('user_id', $user_id)->delete(); // delete

        return response()->json([
            "Message" => "Order Created Successfully",
            "Order" => $order,
        ]);
    }
    /**
     * Display the specified resource.
     */

     public function show()
     {
         $orders = Order::where('order_status', 'pending')->get();
         return response()->json($orders);
     }




    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update()
    {
       // $driver = Auth::user();
       $users = User::select('x&&y')->get();
       $affectedRows = Order::where('x&&y',$users) ->update(['status' => 'shipped']);
       return response()->json([
        "Message : " => "The order is being delivered",
   ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Request $request)
    {
        $order = Order::where('id', $request->order_id)->first();
        $order->delete();

        return response()->json([
            "Message" => "Orders deleted Successfully",
        ]);
    }

    public function status_update_shipped(Request $request)
    {
        $order = Order::where('id', $request->order_id)->first();
        $order->state = 'shipped';
        $order->save();

        return response()->json([
            "Message" => "Orders Shipped Successfully",
            "Order"  => $order
        ]);
    }
    public function status_update_delivered(Request $request)
    {
        $order = Order::where('id', $request->order_id)->first();
        $order->state = 'delivered';
        $order->save();

        return response()->json([
            "Message" => "Orders Shipped Successfully",
            "Order"  => $order
        ]);
    }
    public function remove_product(Request $request)
    {
         //$request->validate([
         //    'order_id' => 'required|exists:orders,id',
         //    'product_name' => 'required|string',
         //]);

        //DB::beginTransaction();

        $order = Order::where('id', $request->order_id)->first();
        $product = Product::where('name', $request->product_name)->first();
        if (!$product) {
            return response()->json([
                "message" => "Product not found.",
            ], 404);
        }

        $orderItem = OrderItem::where('order_id', $order->id)
            ->where('product_id', $product->id)
            ->first();


        $order->cost -= $orderItem->price * $order_item->quantity;
        $order->save();

        $orderItem->delete();
        $order_items = OrderItem::where('product_id', $product->id)->where('order_id', $request->order_id)->get();

        if (!$orderItems) {
            $order->delete();
            $order->save();
        }

        return response()->json([
            "message" => "Product removed from the order successfully.",
            "order" => $order,
        ], 200);
    }

    public function increase(Request $request)
    {
        $user = auth('api')->user();
        $product = Product::find($request->product_id);

        $order_item = OrderItem::where('product_id', $product->id)->where('order_id', $request->order_id)->first();
        $order_item->quantity += 1;
        $order_item->price += $product->price;
        $order_item->save();

        $order = Order::where('id', $request->order_id)->first();
        // dd($order);
        $order->cost += $product->price;
        $order->save();

        return response()->json([
            "message" => "Icreased Successfully",
            "Order" => $order
        ], 200);
    }
    public function decrease(Request $request)
    {
        $user = auth('api')->user();
        $product = Product::find($request->product_id);

        $order_item = OrderItem::where('product_id', $product->id)->where('order_id', $request->order_id)->first();
        $order_item->quantity -= 1;
        $order_item->price -= $product->price;
        $order_item->save();

        $order = Order::where('id', $request->order_id)->first();
        // dd($order);
        $order->cost -= $product->price;
        $order->save();

        return response()->json([
            "message" => "Icreased Successfully",
            "Order" => $order
        ], 200);
    }
}
