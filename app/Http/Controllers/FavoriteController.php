<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;

class FavoriteController extends Controller
{
    public function addProductFavorite(Request $request){
       $validator = Validator::make($request->all(),[
           "product_id"=>'required|exists:products,id'
       ]);
       $user = auth('api')->user(); // Get the authenticated user for the API guard
       $userId = $user->id;

       if($validator->fails())
       return response()->json([
           "Response Message" => "Invalid Credentials",
           "Errors" => $validator->errors()
       ] , 400);
       $favoriteCreate=Favorite::create([
           'user_id'=>$userId,
           'product_id'=>$request->product_id
       ]);
       return response()->json([
           'message'=>'seccess message',
           'status'=>'true'
       ]);
    }

    public function getProductFavorite(Request $request){

        $user_id = auth('api')->user()->id;
        $products=Favorite::where('user_id',$user_id)->with('product')->get();

        if($products->count()>0){
          return response()->json([
              'data'=>$products,
              'message'=>'success message',
              'status'=>true
          ]);
        }

        return response()->json([
              'message'=>'products not found',
              'status'=>false
              ],400);
    }
    public function store(Request $request)
    {
       $validator = Validator::make($request->all(),[
           "order_quantity"=>'required',
           "product_id"=>'required|exists:products,id',
           "store_id"=>'required'
       ]);
       if ($validator->fails()) {
           return response()->json([
               'errors' => $validator->errors()
           ], 422);
       }
       $user = Auth::user();
       $validatedData = $validator->validated();
        $products_price=Favorite::where('product_id',$validatedData['product_id'])->with('product')->get()->pluck('product.price')->first();
        $products_user_id=Favorite::where('product_id',$validatedData['product_id'])->with('product')->pluck('user_id')->first();
             $cart = Cart::create([
                   'user_id' =>(int)$products_user_id,
                   'product_id' =>$validatedData['product_id'],
                   'store_id' => $validatedData['store_id'],
                    'order_quantity'=>$validatedData['order_quantity'],
                    'price'=>(int)$products_price,
                   // 'updated_at' => now(),
                   //  'created_at' => now(),
               ]);



        return response()->json([
            "Message : " => "Add to cart successfully",
           "Cart : " => $cart
        ], 200);
       }

       public function deleteProductFavorite(Request $request)
       {
           $validator = Validator::make($request->all(), [
               "product_id" => 'required|exists:products,id',
           ]);

           if ($validator->fails()) {
               return response()->json([
                   "Response Message" => "Invalid Credentials",
                   "Errors" => $validator->errors()
               ], 400);
           }

           $user = auth('api')->user();
           $userId = $user->id;

           $favorite = Favorite::where('user_id', $userId)
                               ->where('product_id', $request->product_id)
                               ->first();

           if ($favorite) {
               $favorite->delete();
               return response()->json([
                   "message" => "Favorite product deleted successfully",
                   "status" => true
               ], 200);
           }

           return response()->json([
               "message" => "Favorite product not found",
               "status" => false
           ], 404);
       }
}
