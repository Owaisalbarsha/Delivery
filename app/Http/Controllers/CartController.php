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
        $user = auth('api')->user();
        $cart = $user->carts()->with('product')->get();

        return response()->json([
            "Cart" => $cart,
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
        $request->validate([
            'name' => 'required|string|exists:products,name',
            'quantity' => 'required|integer|min:1',
        ]);
        $user = $request->user();

        $product = Product::where('name', $request->name)->first();

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $cartItem = $user->carts()->where('product_id', $product->id)->first();

        if ($cartItem) {
            $cartItem->update([
                'quantity' => $cartItem->quantity + $request->quantity,
                'price' => $product->price * $request->quantity + $cartItem->price, // ضيف القديمة معها
            ]);
        } else {
            $user->carts()->create([
            'product_id' => $product->id,
            'quantity' => $request->quantity,
            'price' => $product->price * $request->quantity,
            ]);
        }

        return response()->json(['message' => 'Product added to cart'], 200);
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
    public function update(Request $request)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer|exists:products,id',
        ]);

        $user = auth('api')->user();

        $cart = Cart::where('product_id', $request->product_id)
                    ->where('user_id', $user->id)
                    ->first();

        if (!$cart) {
            return response()->json([
                "message" => "Cart item not found or you do not have permission to delete it"
            ], 404);
        }

        $cart->delete();

        return response()->json([
            "message" => "Cart item deleted successfully"
        ], 200);
    }
    public function increase(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer|exists:products,id',
        ]);

        $user = auth('api')->user();

        $cart = Cart::where('product_id', $request->product_id)
                    ->where('user_id', $user->id)
                    ->first();

        if (!$cart) {
            return response()->json([
                "message" => "Cart item not found or you do not have permission to update it"
            ], 404);
        }

        $cart->quantity += 1;
        $cart->save();

        return response()->json([
            "message" => "Cart item quantity increased successfully",
            "cart" => $cart
        ], 200);
    }
    public function decrease(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer|exists:products,id',
        ]);

        $user = auth('api')->user();

        $cart = Cart::where('product_id', $request->product_id)
                    ->where('user_id', $user->id)
                    ->first();

        if (!$cart) {
            return response()->json([
                "message" => "Cart item not found or you do not have permission to update it"
            ], 404);
        }

        $cart->quantity -= 1;
        $cart->save();

        return response()->json([
            "message" => "Cart item quantity increased successfully",
            "cart" => $cart
        ], 200);
    }
}
