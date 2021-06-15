<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductModel as MainModel;

class ShopController extends Controller
{
    private $pathViewController = 'public';
    private $controller_name    = '';

    public function hot_list_view()
    {
        $new_items =  MainModel::all();
        view()->share('list_hot_items', $new_items);
    }
    public function paginate_list_view()
    {
        $new_items =  MainModel::paginate(6);
        view()->share(['pagi_list_items' => $new_items, 'get_cat_items' => null]);
    }
    public function all_list_view()
    {
        $new_items =  MainModel::all();
        view()->share('list_product', $new_items);
    }

    public function form(Request $request)
    {
        $id = $request->id;

        return view($this->pathViewController . '.form', ['id' => $id,]);
    }
    public function delete(Request $request)
    {
        $id = $request->id;
        return view('public.test', ['id' => $id]);
    }
    public function status(Request $request)
    {
        $id = $request->id;
        $status = $request->status;
        return \redirect()->route('silder_view');
    }
}
