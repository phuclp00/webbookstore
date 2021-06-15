<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\Category_Update;
use App\Http\Requests\Category\CategoryRequest;
use Illuminate\Http\Request;
use App\Models\CategoryModel as MainModel;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    private $subpatchViewController = '.page';
    private $pathViewController = 'public.';
    public function list_category()
    {
        $items = MainModel::all();
        view()->share('list_category', $items);
    }
    public function top_list_category()
    {
        $top_items =  MainModel::all();

        view()->share('top_list_category', $top_items);
    }
    public function show(Request $request)
    {
        $data = MainModel::where('cat_id', $request->id)->with('childrent.books')->with('books')->get();
        $items = [];
        foreach ($data as $key => $value) {
            foreach ($value->books as $key => $value) {
                $items[] = $value;
            }
        }
        if (count($items) > 0) {
            return  response()->json($items, 200, ["Content-type: application/json", "charset=utf-8"]);
        } else {
            return  response()->json("NOT FOUND", 404, ["Content-type: application/json", "charset=utf-8"]);
        }
    }
    public function add_category(CategoryRequest $request)
    {
        try {
            DB::beginTransaction();
            $data = new MainModel();
            $data->cat_id = $request->cat_id;
            $data->cat_name = $request->cat_name;
            $data->type_id = $request->type == null ? $request->new_type : $request->type;
            $data->description  = $request->content;
            $data->created_by = Auth::user()->user_name;
            $data->save();
            DB::commit();
            $request->session()->flash('infor_success', '<div class="alert alert-success" style="text-align: center;font-size: x-large;font-family: fangsong;"> Add ' . $request->cat_name . ' Successfully !! </div>');
            return \redirect()->back();
        } catch (Exception $e) {
            DB::rollBack();
            $request->session()->flash('infor_warning', '<div class="alert alert-danger" style="text-align: center;font-size: x-large;font-family: fangsong;"> Add ' . $request->cat_name . 'failed with error ' . $e->getMessage() . ' Try Again !!</div>');
            return \redirect()->back();
        }
    }
    public function category_edit(Category_Update $request)
    {
        try {
            DB::beginTransaction();
            $data = MainModel::withTrashed()->where('cat_id', $request->cat_id)->first();
            $data->cat_name = $request->cat_name;
            $data->description = $request->content;
            $data->type_id = $request->type == null ? $request->new_type : $request->type;
            $data->modified_by = Auth::user()->user_name;
            if ($data->isDirty() == false) {
                $request->session()->flash(
                    'infor_mess',
                    '<div class="alert alert-primary" style="text-align: center;font-size: x-large;font-family: fangsong;"> 
                        You have yet to update the information for "' . $data->getOriginal('cat_name') . '"! 
                        </br>
                        Please check it or return back if you dont want to update this category ! 
                    </div>'
                );
                return redirect()->back();
            }
            $data->save();
            DB::commit();
            $request->session()->flash('infor_success', '<div class="alert alert-success" style="text-align: center;font-size: x-large;font-family: fangsong;"> Edit ' . $request->cat_name . ' Successfully !! </div>');
            return \redirect()->route('admin.category');
        } catch (Exception $e) {
            DB::rollBack();
            $request->session()->flash('infor_warning', '<div class="alert alert-danger" style="text-align: center;font-size: x-large;font-family: fangsong;"> Edit ' . $request->cat_name . 'Fail,Try Again !! </div>');
            return \redirect()->back();
        }
    }
    public function category_delete(Request $request)
    {
        try {
            DB::beginTransaction();
            $data = MainModel::withTrashed()->where('cat_id', $request->cat_id)->first();
            if ($data->books()->exists() == false) {
                $data->forceDelete();
                $request->session()->flash('infor_success', '<div class="alert alert-success" style="text-align: center;font-size: x-large;font-family: fangsong;"> Delete  category ' . $request->cat_name . ' Successfully !! </div>');
            } else {
                $data->deleted_by = Auth::user()->user_name;
                $data->save();
                $data->delete();
                $request->session()->flash('infor_mess', '<div class="alert alert-success" style="text-align: center;font-size: x-large;font-family: fangsong;"> The category ' . $request->cat_name . ' has been moved to the "Restore List" category!! </div>');
            }
            DB::commit();
            return redirect()->back();
        } catch (Exception $e) {
            $request->session()->flash('info_warning', '<div class="alert alert-danger" style="text-align: center;font-size: x-large;font-family: fangsong;"> Delete  category ' . $request->cat_name . 'Failed with error ' . $e->getMessage() .  '</div>');
            DB::rollBack();
            return redirect()->back();
        }
    }
    public function restore(Request $request)
    {
        try {
            DB::beginTransaction();
            $data = MainModel::withTrashed()->where('cat_id', $request->cat_id)->first();
            $data->deleted_by = null;
            $data->save();
            $data->restore();
            $request->session()->flash('infor_success', '<div class="alert alert-success" style="text-align: center;font-size: x-large;font-family: fangsong;"> Restore category ' . $data->cat_name . ' Successfully !! </div>');
            DB::commit();
            return redirect()->back();
        } catch (\Throwable $th) {
            DB::rollBack();
            $request->session()->flash('info_warning', '<div class="alert alert-danger" style="text-align: center;font-size: x-large;font-family: fangsong;"> Delete category ' . $data->pub_name . 'Failed with error ' . $th->getMessage() . '</div>');

            return redirect()->back();
        }
    }
}
