<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Store;
use Illuminate\Support\Facades\Validator;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stores = Store::all();

        foreach ($stores as $store) {
            $store->image = asset('storage/images/' . basename($store->image));
        }
        return response()->json([
            "message" => "Stores retrieved successfully",
            "stores" => $stores,
        ], 200);
    }
    public function storeProducts(Request $request)
    {
        $name = $request->input('name');
        $store = Store::where('name', $name)->first();

        if (!$store) {
            return response()->json([
                "message" => "Store not found"
            ], 404);
        }

        $products = $store->products;

        foreach ($products as $product) {
            $product->image = asset('storage/images/' . basename($product->image));
        }

        return response()->json([
            "message" => "Store $name products retrieved successfully",
            "products" => $products
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
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            "location"   => 'regex:/^[a-zA-Z0-9\s,.-]{1,100}$/',
        ]);
        if($validator->fails())
            return response()->json([
                "Response Message" => "Invalid Information",
                "Errors" => $validator->errors()
            ] , 400);

        $validatedData = $validator->validated();

        $fileName = time() . '_' . $request->file('image')->getClientOriginalName();
        $path = $request->file('image')->storeAs('images', $fileName, 'public');
        $validatedData["image"] = '/storage/' . $path;
        //$imageUrl = asset('storage/images/' . basename($user->image));

        $store = Store::create($validatedData);

        return response()->json([
            "Response Message" => "Store added successfully",
            "Store" => $store,
        ],200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $store = Store::find($id);
        if(!$store)
            return response()->json([
                "Message" => "Store not found"
            ], 400);
        return response()->json([
            "Response Message" => "Store retrieved successfully",
            "Store" => $store,
        ],200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $store = Store::find($id);
        if(!$store)
            return response()->json([
                "Message" => "product not found"
            ], 400);

        $validator = Validator::make($request->all(),[
            'name' => 'string|max:255',
            'description' => 'string',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            "location"   => 'regex:/^[a-zA-Z0-9\s,.-]{1,100}$/',
        ]);
        if($validator->fails())
            return response()->json([
                "Response Message" => "Invalid Information",
                "Errors" => $validator->errors()
            ] , 400);

        $validatedData = $validator->validated();
        if ($request->hasFile('image')) {
            $fileName = time() . '_' . $request->file('image')->getClientOriginalName();
            $path = $request->file('image')->storeAs('images', $fileName, 'public');
            $validatedData["image"] = '/storage/' . $path;
        }
        $store->update($validatedData);
        return response()->json([
            "Response Message" => "Store updated successfully",
            "Store" => $store,
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $store = Store::find($id);
        if(!$store)
            return response()->json([
                "Message" => "store not found"
            ], 400);
        $store->delete();

        return response()->json([
            "Message : " => "Deleted Successfully"
        ], 200);
    }

    /**
     * Restore the specified soft deleted resource.
     */
    public function restore($id)
    {
        $product = Product::withTrashed()->findOrFail($id);
        $product->restore();

        return response()->json($product, 200);
    }

    /**
     * Permanently delete the specified soft deleted resource.
     */
    public function forceDelete($id)
    {
        $product = Product::withTrashed()->findOrFail($id);
        $product->forceDelete();

        return response()->json(null, 204);
    }
    public function search($name)
    {
        $store = Store::where('name', $name)->first();
        //$store = Store::whereRaw('LOWER(name) = ?', [strtolower($name)])->first();

        if(!$store)
            return response()->json([
                "Message : " => "Store Not Found"
            ], 200);

        return response()->json([
            "Message : " => "Store Retrieved Successflly",
            "Store : " => $store
        ], 400);
    }
}
