<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;
use App\Models\CategoryModel as MainModel;
use App\Models\CategoryModel;
use App\Models\ProductModel;
use Exception;

class CategoryController extends Controller
{
    private $subpatchViewController = '.page';
    private $pathViewController = 'public.';
    public function list_category()
    {
        $mainModel =  new MainModel();
        $items = $mainModel->listItems(null, ['task' => "frontend-list-items"]);

        view()->share('list_category', $items);
    }
    public function top_list_category()
    {
        $mainModel =  new MainModel();
        $top_items = $mainModel->listItems(null, ['task' => "top-list-items"], null, 5);

        view()->share('top_list_category', $top_items);
    }
    
    public function add_category(CategoryRequest $request){
        try {
            $data= new CategoryModel();
            $data->cat_id=$request->cat_id;
            $data->cat_name=$request->cat_name;
            $data->description=$request->content;
            $data->save();
            $request->session()->flash('info_warning', '<div class="alert alert-success" style="text-align: center;font-size: x-large;font-family: fangsong;"> Add ' . $request->cat_name . ' Successfully !! </div>');
            return \redirect()->back();
        } catch ( Exception $e) {
            $request->session()->flash('info_warning', '<div class="alert alert-danger" style="text-align: center;font-size: x-large;font-family: fangsong;"> Add ' . $request->cat_name . 'Fail,Try Again !! </div>');
            return \redirect()->back();
        }
    }

    public function category_edit(CategoryRequest $request)
    {
        try{
            $data=MainModel::find($request->cat_id);
            $data->cat_name=$request->cat_name;
            if($request->description!=$request->content && $request->content !=null){
                $data->description=$request->content;
            }
            $data->save();
            $request->session()->flash('info_warning', '<div class="alert alert-success" style="text-align: center;font-size: x-large;font-family: fangsong;"> Edit ' . $request->cat_name . ' Successfully !! </div>');
            return \redirect()->route('admin.category_view');
        }
        catch(Exception $e){
            $request->session()->flash('info_warning', '<div class="alert alert-danger" style="text-align: center;font-size: x-large;font-family: fangsong;"> Edit ' . $request->cat_name . 'Fail,Try Again !! </div>');
            return \redirect()->back();
        }
    }
    public function category_delete(Request $request)
    {
        try {
            MainModel::destroy($request->cat_id);
            $request->session()->flash('info_warning', '<div class="alert alert-success" style="text-align: center;font-size: x-large;font-family: fangsong;">  Delete :' . $request->cat_name . 'Successfully !! </div>');
            return \redirect()->back();

        } catch (Exception $e) {
            $request->session()->flash('info_warning', '<div class="alert alert-danger" style="text-align: center;font-size: x-large;font-family: fangsong;"> Delete ' . $request->cat_name . 'Failed, Cannot Be Deleted If It Has Been Used By A Book !! </div>');
            return \redirect()->back();
        }
    }
}
