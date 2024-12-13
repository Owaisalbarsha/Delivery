<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return response()->json([
            "message" => "Products retrieved successfully",
            "products" => $products,
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
            //'company' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            //'expiration_date' => 'required|date|after:today',
            'price' => 'required|numeric|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
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

        $product = Product::create($validatedData);

        return response()->json([
            "Response Message" => "Product added successfully",
            "Product" => $product,
        ],200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = Product::find($id);
        if(!$product)
            return response()->json([
                "Message" => "product not found"
            ], 400);
        return response()->json([
            "Response Message" => "Product retrieved successfully",
            "Product" => $product,
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
        //dd($request->all());
        $product = Product::find($id);
        if(!$product)
            return response()->json([
                "Message" => "product not found"
            ], 400);

        $validator = Validator::make($request->all(),[
            'name' => 'string|max:255',
            'description' => 'string',
            //'company' => 'required|string|max:255',
            'quantity' => 'integer|min:1',
            //'expiration_date' => 'required|date|after:today',
            'price' => 'numeric|min:0',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
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
        $product->update($validatedData);
        return response()->json([
            "Response Message" => "Product updated successfully",
            "Product" => $product,
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        if(!$product)
            return response()->json([
                "Message" => "product not found"
            ], 400);
        $product->delete();

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
        $product = Product::where('name', $name)->first();
        
        if(!$product)
            return response()->json([
                "Message : " => "Product Not Found"
            ], 200);

        return response()->json([
            "Message : " => "Product Retrieved Successflly",
            "Product : " => $product
        ], 400);
    }
}

