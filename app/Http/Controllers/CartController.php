<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cart = Cart::where('user_id', auth('api')->user()->id)->get();
        if(!$cart){
            return response()->json(["Message" => "Not Found"], 400);
        }
        //$cart['product_name'] = Product::where('id', $cart['product_id'])->value('name');
        //$cart['store_name'] = Store::where('id', $cart['store_id'])->value('name');
        return response()->json([
            "Cart : " => $cart,
            "Message : " => "Retrieved Successfully"
        ], 200);
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
    public function store(Request $request)
    {
        /*
        'user_id',
        'store_id',
        'product_id',
        'order_quantity',
        'price'
        */
        $user_id = auth('api')->user()->id;
        $input = $request->all();
        $product = Product::where('name', $input['name'])->first();
        $input['user_id'] = $user_id;
        $input['product_id'] = $product->id;
        $input['price'] = $input['order_quantity']*$product->price;
        $cart = Cart::create($input);
        $cart->save();

        return response()->json([
            "Message : " => "Add to cart successfully",
            "Cart : " => $cart
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $cart = Cart::find($id);
        if(!$cart)
            return response()->json([
                "Message" => "cart not found"
            ], 400);
        $cart->delete();

        return response()->json([
            "Message : " => "Deleted Successfully"
        ], 200);
    }
}
