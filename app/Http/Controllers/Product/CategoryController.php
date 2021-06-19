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
    public function index()
    {
        $category = MainModel::all()->toFlatTree()->pluck('name');
        return $category;
    }
    public function show(Request $request)
    {
        $data = MainModel::where('id', $request->id)->get();
        $items = [];
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
            $data = MainModel::create([
                'name' => $request->name,
                'parent_id' => $request->cat_group ==  null ? null : $request->cat_group,
                'description' => $request->content == null ? "This category has been added by" . Auth::user()->user_name : $request->content,
                'created_by' => Auth::user()->user_name
            ]);
            DB::commit();
            $request->session()->flash('infor_success', '<div class="alert alert-success" style="text-align: center;font-size: x-large;font-family: fangsong;"> Add ' . $request->name . ' Successfully !! </div>');
            return \redirect()->back();
        } catch (Exception $e) {
            DB::rollBack();
            $request->session()->flash('infor_warning', '<div class="alert alert-danger" style="text-align: center;font-size: x-large;font-family: fangsong;"> Add ' . $request->name . 'failed with error ' . $e->getMessage() . ' Try Again !!</div>');
            return \redirect()->back();
        }
    }
    public function category_edit(Category_Update $request)
    {
        try {
            DB::beginTransaction();
            $data = MainModel::withTrashed()->where('id', $request->id)->first();
            $data->name = $request->name;
            $data->description = $request->content;
            $data->parent_id = $request->cat_group == null ? null : $request->cat_group;
            $data->modified_by = Auth::user()->user_name;
            if ($data->isDirty() == false) {
                $request->session()->flash(
                    'infor_mess',
                    '<div class="alert alert-primary" style="text-align: center;font-size: x-large;font-family: fangsong;"> 
                        You have yet to update the information for "' . $data->getOriginal('name') . '"! 
                        </br>
                        Please check it or return back if you dont want to update this category ! 
                    </div>'
                );
                return redirect()->back();
            }
            $data->save();
            $check_tree = MainModel::isBroken();
            if ($check_tree == true) {
                $request->session()->flash('infor_warning', '<div class="alert alert-danger" style="text-align: center;font-size: x-large;font-family: fangsong;"> The Tree Category will be broken ! Check it and try Again !! </div>');
                DB::rollBack();
                return \redirect()->back();
            }
            DB::commit();
            $request->session()->flash('infor_success', '<div class="alert alert-success" style="text-align: center;font-size: x-large;font-family: fangsong;"> Edit ' . $request->name . ' Successfully !! </div>');
            return \redirect()->route('admin.category');
        } catch (Exception $e) {
            DB::rollBack();
            $request->session()->flash('infor_warning', '<div class="alert alert-danger" style="text-align: center;font-size: x-large;font-family: fangsong;"> Edit ' . $request->name . 'Fail,Try Again !! </div>');
            return \redirect()->back();
        }
    }
    public function category_delete(Request $request)
    {
        try {
            DB::beginTransaction();
            $data = MainModel::withTrashed()->where('id', $request->id)->first();
            if ($data->books()->exists() == false && $data->isLeaf()) {
                $data->forceDelete();
                $request->session()->flash('infor_success', '<div class="alert alert-success" style="text-align: center;font-size: x-large;font-family: fangsong;"> Delete  category ' . $request->name . ' Successfully !! </div>');
            } else {
                $data->deleted_by = Auth::user()->user_name;
                $data->save();
                $data->delete();
                $request->session()->flash('infor_mess', '<div class="alert alert-success" style="text-align: center;font-size: x-large;font-family: fangsong;"> The category ' . $request->name . ' has been moved to the "Restore List" category!! </div>');
            }
            $check_tree = MainModel::isBroken();
            if ($check_tree == true) {
                $request->session()->flash('infor_warning', '<div class="alert alert-danger" style="text-align: center;font-size: x-large;font-family: fangsong;"> The Tree Category will be broken ! Check it and try Again !! </div>');
                DB::rollBack();
                return \redirect()->back();
            }
            DB::commit();
            return redirect()->back();
        } catch (Exception $e) {
            $request->session()->flash('info_warning', '<div class="alert alert-danger" style="text-align: center;font-size: x-large;font-family: fangsong;"> Delete  category ' . $request->name . 'Failed with error ' . $e->getMessage() .  '</div>');
            DB::rollBack();
            return redirect()->back();
        }
    }
    public function restore(Request $request)
    {
        try {
            DB::beginTransaction();
            $category = MainModel::onlyTrashed()->get();
            $data = MainModel::withTrashed()->where('id', $request->id)->first();
            foreach ($category as $key => $value) {
                if ($data->isChildOf($value)) {
                    $request->session()->flash('infor_warning', '<div class="alert alert-danger" style="text-align: center;font-size: x-large;font-family: fangsong;"> Please restore the parent category of this category first and try again !! The parent of this category is </br> "' . $value->name . '"</div>');
                    DB::rollBack();
                    return \redirect()->back();
                }
            }
            $data->deleted_by = null;
            $data->save();
            $data->restore();
            $request->session()->flash('infor_success', '<div class="alert alert-success" style="text-align: center;font-size: x-large;font-family: fangsong;"> Restore category ' . $data->name . ' Successfully !! </div>');
            DB::commit();
            return redirect()->back();
        } catch (\Throwable $th) {
            DB::rollBack();
            $request->session()->flash('info_warning', '<div class="alert alert-danger" style="text-align: center;font-size: x-large;font-family: fangsong;"> Delete category ' . $data->pub_name . 'Failed with error ' . $th->getMessage() . '</div>');

            return redirect()->back();
        }
    }
}
