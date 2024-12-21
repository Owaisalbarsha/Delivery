<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use App\Notifications\ProductNotification;
class TestController extends Controller
{
    public function test(){
        //$user = auth('api')->user();
        User::find(4)->notify(new ProductNotification());
    }
}
