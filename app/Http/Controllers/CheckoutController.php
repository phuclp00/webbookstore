<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    private $pathViewController = 'public.page.checkout';

    public function login_checkout()
    {
        return \route('login_view');
    }
    public function checkout_view()
    {
        return view($this->pathViewController);
    }
    public function register_address(Request $request)
    {
        $id_item = $request->id;
        $item = ProductModel::find($id_item);

        $items_qty = CategoryModel::select('total')->where("cat_id", $item->cat_id)->first();
        $data['id'] = $item->book_id;
        $data['qty'] = 1;
        $data['name'] = $item->book_name;
        $data['price'] = $item->price;
        $data['options']['image'] = $item->img;
        $data['id'] = $item->book_id;
        $data['weight'] = 25;
        Cart::add($data);
        return \redirect()->back();


    }

    //DESTROY 
    //UPDATE 
    public function update_cart(Request $request)
    {
       
        $rowId = $request->cart_rowId;
        $qty   = $request->cart_quantity;
        if (isset($request->remove_cart)) {
            Cart::update($rowId, 0);
            return redirect()->back();
        }
        else 
      
        Cart::update($rowId, $qty);
        return redirect()->back();

        
    }
    public function cart_view()
    {
        return view('public.page.cart');

    }
    
}
