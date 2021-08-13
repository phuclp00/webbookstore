<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SlideModel;

class SilderController extends Controller
{


    public function __construct()
    {
        //view()->share('controller_name', $this->controller_name);
    }
    public function slide_homepage()
    {
        $data = SlideModel::all();
        view()->share('hero_item', $data);
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
