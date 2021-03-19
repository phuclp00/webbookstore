<?php

namespace App\Http\Controllers;

use App\Models\ProductModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    private $pathViewController = 'public.page.checkout';


    public function checkout_view()
    {
        if(Auth::check()){
            $user=UserModel::find(Auth::user()->user_id)->with('user_detail')->first();
            return view($this->pathViewController,['user'=>$user]);
        }
    }
    public function register_address(Request $request)
    {
       

    }
    public function add_order_detail(Request $var = null)
    {
        # code...
    }
    public function add_order_cart(Request $var = null)
    {
        # code...
    }
}
