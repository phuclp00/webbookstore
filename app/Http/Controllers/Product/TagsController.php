<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tags\Tags_Update;
use App\Http\Requests\Tags\TagsRequest;
use App\Models\ProductModel;
use Illuminate\Http\Request;
use App\Models\TagsModel as MainModel;
use App\Models\TagsModel;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TagsController extends Controller
{
    private $subpatchViewController = '.page';
    private $pathViewController = 'public.';

    public function index()
    {
        $tags = MainModel::whereisLeaf()->get();
        foreach ($tags as $value) {
            $result[] = $value->name;
        }
        return $result;
    }
    public function show(Request $request)
    {
        return MainModel::find($request->id);
    }
    public function add_tags(TagsRequest $request)
    {
        try {
            DB::beginTransaction();
            $data = MainModel::create([
                'name' => $request->name,
                'parent_id' => $request->cat_group ==  null ? null : $request->cat_group,
                'description' => $request->content == null ? "This tags has been added by" . Auth::user()->user_name : $request->content,
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
    public function tags_edit(Tags_Update $request)
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
                        Please check it or return back if you dont want to update this tags ! 
                    </div>'
                );
                return redirect()->back();
            }
            $data->save();
            $check_tree = MainModel::isBroken();
            if ($check_tree == true) {
                $request->session()->flash('infor_warning', '<div class="alert alert-danger" style="text-align: center;font-size: x-large;font-family: fangsong;"> The Tree Tags will be broken ! Check it and try Again !! </div>');
                DB::rollBack();
                return \redirect()->back();
            }
            DB::commit();
            $request->session()->flash('infor_success', '<div class="alert alert-success" style="text-align: center;font-size: x-large;font-family: fangsong;"> Edit ' . $request->name . ' Successfully !! </div>');
            return \redirect()->route('admin.tags');
        } catch (Exception $e) {
            DB::rollBack();
            $request->session()->flash('infor_warning', '<div class="alert alert-danger" style="text-align: center;font-size: x-large;font-family: fangsong;"> Edit ' . $request->name . 'Fail,Try Again !! </div>');
            return \redirect()->back();
        }
    }
    public function tags_delete(Request $request)
    {
        try {
            DB::beginTransaction();
            $data = MainModel::withTrashed()->where('id', $request->id)->first();
            if ($data->books()->exists() == false && $data->isLeaf()) {
                $data->forceDelete();
                $request->session()->flash('infor_success', '<div class="alert alert-success" style="text-align: center;font-size: x-large;font-family: fangsong;"> Delete  tags ' . $request->name . ' Successfully !! </div>');
            } else {
                $data->deleted_by = Auth::user()->user_name;
                $data->save();
                $data->delete();
                $request->session()->flash('infor_mess', '<div class="alert alert-success" style="text-align: center;font-size: x-large;font-family: fangsong;"> The tags ' . $request->name . ' has been moved to the "Restore List" tags!! </div>');
            }
            $check_tree = MainModel::isBroken();
            if ($check_tree == true) {
                $request->session()->flash('infor_warning', '<div class="alert alert-danger" style="text-align: center;font-size: x-large;font-family: fangsong;"> The Tree Tags will be broken ! Check it and try Again !! </div>');
                DB::rollBack();
                return \redirect()->back();
            }
            DB::commit();
            return redirect()->back();
        } catch (Exception $e) {
            $request->session()->flash('info_warning', '<div class="alert alert-danger" style="text-align: center;font-size: x-large;font-family: fangsong;"> Delete  tags ' . $request->name . 'Failed with error ' . $e->getMessage() .  '</div>');
            DB::rollBack();
            return redirect()->back();
        }
    }
    public function restore(Request $request)
    {
        try {
            DB::beginTransaction();
            $tags = MainModel::onlyTrashed()->get();
            $data = MainModel::withTrashed()->where('id', $request->id)->first();
            foreach ($tags as $key => $value) {
                if ($data->isChildOf($value)) {
                    $request->session()->flash('infor_warning', '<div class="alert alert-danger" style="text-align: center;font-size: x-large;font-family: fangsong;"> Please restore the parent tags of this tags first and try again !! The parent of this tags is </br> "' . $value->name . '"</div>');
                    DB::rollBack();
                    return \redirect()->back();
                }
            }
            $data->deleted_by = null;
            $data->save();
            $data->restore();
            $request->session()->flash('infor_success', '<div class="alert alert-success" style="text-align: center;font-size: x-large;font-family: fangsong;"> Restore tags ' . $data->name . ' Successfully !! </div>');
            DB::commit();
            return redirect()->back();
        } catch (\Throwable $th) {
            DB::rollBack();
            $request->session()->flash('info_warning', '<div class="alert alert-danger" style="text-align: center;font-size: x-large;font-family: fangsong;"> Delete tags ' . $data->pub_name . 'Failed with error ' . $th->getMessage() . '</div>');

            return redirect()->back();
        }
    }
    public function add_multi_book(Request $request)
    {

        try {
            DB::beginTransaction();
            $tags = [];

            foreach ($request->tags as $tag) {
                $tags[] = TagsModel::where('name', $tag)->first()->id;
            }
            foreach ($request->books as $book) {
                \preg_match('/(?<id>.*):(?<name>.*)/', $book, $result);
                $book_result = ProductModel::where('book_id', $result['id'])->first();
                $book_result->tags()->sync($tags);
            }
            DB::commit();
            return \response()->json([
                "result" => TagsModel::all()->load('books'),
                "mess" => "Tags added to the book was successfull !!",
                "status" => "success"
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return \response()->json([
                "result" => TagsModel::all()->load('books'),
                "mess" => "Tags added to the book was failed with error : " . $th->getMessage() . "!!",
                "status" => "danger"
            ]);
        }
    }
}
