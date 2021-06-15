<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Store\FileuploadController;
use App\Http\Controllers\Store\ImagesController;
use App\Http\Requests\Publisher\Publisher_Update;
use App\Http\Requests\Publisher\PublisherRequest;
use Illuminate\Http\Request;
use App\Models\PublisherModel as MainModel;
use App\Models\PublisherModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Exception;

class PublisherController extends Controller
{
    private $subpatchViewController = '.page';
    private $pathViewController = 'public.';

    public function __construct()
    {
    }
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
    public function edit_publisher(Publisher_Update $request)
    {
        try {
            DB::beginTransaction();
            $data = PublisherModel::withTrashed()->where('id', $request->id)->first();
            $file =  new ImagesController(250, 200, $request->id);
            $data->name = $request->name;
            $data->description = $request->content == null ? "This publisher has been added by " . Auth::user()->user_name : $request->content;
            if ($request->img) {
                $data->image = $file->update($request->img, $data->image, "publisher");
            }
            $data->modified_by = Auth::user()->user_name;

            if ($data->isDirty() == false) {
                $request->session()->flash(
                    'infor_mess',
                    '<div class="alert alert-primary" style="text-align: center;font-size: x-large;font-family: fangsong;"> 
                        You have yet to update the information for "' . $data->getOriginal('name') . '" ! 
                        </br>
                        Please check it or return back if you dont want to update this category ! 
                    </div>'
                );
                return redirect()->back();
            }
            $data->save();
            $request->session()->flash('infor_success', '<div class="alert alert-success" style="text-align: center;font-size: x-large;font-family: fangsong;"> Edit ' . $request->name . ' Successfully !! </div>');
            DB::commit();
            return \redirect()->route('admin.publisher');
        } catch (\Throwable $th) {
            $request->session()->flash('infor_warning', '<div class="alert alert-danger" style="text-align: center;font-size: x-large;font-family: fangsong;"> Edit ' . $request->name . 'Fail,Try Again !! </div>');
            DB::rollBack();
            return \redirect()->back();
        }
    }
    public function add_publisher(PublisherRequest $request)
    {
        $file =  new ImagesController(250, 200, $request->id);
        try {
            DB::beginTransaction();
            PublisherModel::create([
                'id' => $request->id,
                'name' => $request->name,
                'description' => $request->content == null ? "This publisher has been added by " . Auth::user()->user_name : $request->content,
                'image' => $request->img != null ? $file->store($request->img, "publisher") : null,
                'created_by' => Auth::user()->user_name,
            ]);
            $request->session()->flash('infor_success', '<div class="alert alert-success" style="text-align: center;font-size: x-large;font-family: fangsong;"> Edit ' . $request->name . ' Successfully !! </div>');
            DB::commit();
            return \redirect()->route('admin.publisher');
        } catch (\Throwable $th) {
            $request->session()->flash('infor_warning', '<div class="alert alert-danger" style="text-align: center;font-size: x-large;font-family: fangsong;"> Edit ' . $request->name . 'Fail,Try Again !! </div>');
            DB::rollBack();
            return \redirect()->back();
        }
    }
    public function delete_publisher(Request $request)
    {
        $file =  new ImagesController(250, 200, $request->id);
        try {
            DB::beginTransaction();
            $data = MainModel::withTrashed()->where('id', $request->id)->with('books')->first();
            if ($data->books()->exists() == false) {
                $data->forceDelete();
                $file->destroy("publisher");
                $request->session()->flash('infor_success', '<div class="alert alert-success" style="text-align: center;font-size: x-large;font-family: fangsong;"> Delete ' . $request->name . ' Successfully !! </div>');
            } else {
                $data->deleted_by = Auth::user()->user_name;
                $data->save();
                $data->delete();
                $request->session()->flash('infor_mess', '<div class="alert alert-success" style="text-align: center;font-size: x-large;font-family: fangsong;"> The publisher ' . $request->name . ' has been moved to the "Restore List" category!! </div>');
            }
            DB::commit();
            return redirect()->route("admin.publisher");
        } catch (Exception $e) {
            $request->session()->flash('info_warning', '<div class="alert alert-danger" style="text-align: center;font-size: x-large;font-family: fangsong;"> Delete ' . $request->name . 'Failed, Cannot Be Deleted If It Has Been Used By A Book !! </div>');
            DB::rollBack();
            return redirect()->route("admin.publisher");
        }
    }
    public function restore(Request $request)
    {
        try {
            DB::beginTransaction();
            $data = MainModel::withTrashed()->where('id', $request->id)->first();
            $data->deleted_by = null;
            $data->save();
            $data->restore();
            $request->session()->flash('infor_success', '<div class="alert alert-success" style="text-align: center;font-size: x-large;font-family: fangsong;"> Restore ' . $data->name . ' Successfully !! </div>');
            DB::commit();
            return redirect()->back();
        } catch (\Throwable $th) {
            DB::rollBack();
            $request->session()->flash('info_warning', '<div class="alert alert-danger" style="text-align: center;font-size: x-large;font-family: fangsong;"> Delete ' . $data->name . 'Failed with error ' . $th->getMessage() . '</div>');

            return redirect()->back();
        }
    }
}
