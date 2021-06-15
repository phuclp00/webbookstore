<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Store\ImagesController;
use App\Http\Requests\Author\Author_Update;
use App\Http\Requests\Author\AuthorRequest;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Exception;

class AuthorController extends Controller
{
    public function edit(Author_Update $request)
    {
        try {
            DB::beginTransaction();
            $data = Author::withTrashed()->where('id', $request->id)->first();
            $file =  new ImagesController(250, 200, $request->id);
            $data->name = $request->name;
            $data->description = $request->content;
            if ($request->img) {
                $data->image = $file->update($request->img, $data->image, "author");
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
            return \redirect()->route('admin.author');
        } catch (\Throwable $th) {
            $request->session()->flash('infor_warning', '<div class="alert alert-danger" style="text-align: center;font-size: x-large;font-family: fangsong;"> Edit ' . $request->name . 'Fail,with error ' . $th->getMessage() . 'Try Again !! </div>');
            DB::rollBack();
            return \redirect()->back();
        }
    }
    public function add(AuthorRequest $request)
    {
        $file =  new ImagesController(250, 200, $request->id);
        try {
            DB::beginTransaction();
            $product = Author::create([
                'name' => $request->name,
                'description' => $request->content,
                'img' => $request->image != null ? $file->store($request->image, "author") : null,
                'created_by' => Auth::user()->user_name,
            ]);
            $request->session()->flash('infor_success', '<div class="alert alert-success" style="text-align: center;font-size: x-large;font-family: fangsong;"> Edit ' . $request->name . ' Successfully !! </div>');
            DB::commit();
            return \redirect()->route('admin.author');
        } catch (\Throwable $th) {
            $request->session()->flash('infor_warning', '<div class="alert alert-danger" style="text-align: center;font-size: x-large;font-family: fangsong;"> Edit ' . $request->name . ' failed with error' . $th->getMessage() . 'Try Again !! </div>');
            DB::rollBack();
            return \redirect()->back();
        }
    }
    public function delete(Request $request)
    {
        $file =  new ImagesController(250, 200, $request->id);
        try {
            DB::beginTransaction();
            $data = Author::withTrashed()->where('id', $request->id)->first();
            if ($data->books()->exists() == false) {
                $data->forceDelete();
                $file->destroy("author");
                $request->session()->flash('infor_success', '<div class="alert alert-success" style="text-align: center;font-size: x-large;font-family: fangsong;"> Delete ' . $request->name . ' Successfully !! </div>');
            } else {
                $data->deleted_by = Auth::user()->user_name;
                $data->save();
                $data->delete();
                $request->session()->flash('infor_mess', '<div class="alert alert-success" style="text-align: center;font-size: x-large;font-family: fangsong;"> The author ' . $request->name . ' has been moved to the "Restore List" category!! </div>');
            }
            DB::commit();
            return redirect()->route("admin.author");
        } catch (Exception $e) {
            $request->session()->flash('info_warning', '<div class="alert alert-danger" style="text-align: center;font-size: x-large;font-family: fangsong;"> Delete ' . $request->name . 'Failed, Cannot Be Deleted If It Has Been Used By A Book !! </div>');
            DB::rollBack();
            return redirect()->route("admin.author");
        }
    }
    public function restore(Request $request)
    {
        try {
            DB::beginTransaction();
            $data = Author::withTrashed()->where('id', $request->id)->first();
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
