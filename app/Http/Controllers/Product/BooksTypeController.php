<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\BooksType\BooksType_Update;
use App\Http\Requests\BooksType\BooksTypeRequest;
use App\Models\BookType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Exception;

class BooksTypeController extends Controller
{
    public function edit(BooksType_Update $request)
    {
        try {
            DB::beginTransaction();
            $data = BookType::withTrashed()->where('id', $request->id)->first();
            $data->name = $request->name;
            $data->description = $request->content;
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
            return \redirect()->route('admin.type');
        } catch (\Throwable $th) {
            $request->session()->flash('infor_warning', '<div class="alert alert-danger" style="text-align: center;font-size: x-large;font-family: fangsong;"> Edit ' . $request->name . 'Fail,with error ' . $th->getMessage() . 'Try Again !! </div>');
            DB::rollBack();
            return \redirect()->back();
        }
    }
    public function add(Request $request)
    {
        try {
            DB::beginTransaction();
            $product = BookType::create([
                'id' => $request->id,
                'name' => $request->name,
                'description' => $request->content,
                'created_by' => Auth::user()->user_name,
            ]);
            $request->session()->flash('infor_success', '<div class="alert alert-success" style="text-align: center;font-size: x-large;font-family: fangsong;"> Edit ' . $request->name . ' Successfully !! </div>');
            DB::commit();
            return \redirect()->route('admin.type');
        } catch (\Throwable $th) {
            $request->session()->flash('infor_warning', '<div class="alert alert-danger" style="text-align: center;font-size: x-large;font-family: fangsong;"> Edit ' . $request->name . 'Fail,Try Again !! </div>');
            DB::rollBack();
            return \redirect()->back();
        }
    }
    public function delete(Request $request)
    {
        try {
            DB::beginTransaction();
            $data = BookType::where('id', $request->id)->with('books')->first();
            if ($data->books()->exists() == false) {
                $data->forceDelete();
                $request->session()->flash('infor_success', '<div class="alert alert-success" style="text-align: center;font-size: x-large;font-family: fangsong;"> Delete ' . $request->name . ' Successfully !! </div>');
            } else {
                $data->deleted_by = Auth::user()->user_name;
                $data->save();
                $data->delete();
                $request->session()->flash('infor_mess', '<div class="alert alert-success" style="text-align: center;font-size: x-large;font-family: fangsong;"> The format ' . $request->name . ' has been moved to the "Restore List" category!! </div>');
            }
            DB::commit();
            return redirect()->route("admin.type");
        } catch (Exception $e) {
            $request->session()->flash('info_warning', '<div class="alert alert-danger" style="text-align: center;font-size: x-large;font-family: fangsong;"> Delete ' . $request->name . 'Failed, Cannot Be Deleted If It Has Been Used By A Book !! </div>');
            DB::rollBack();
            return redirect()->route("admin.type");
        }
    }
    public function restore(Request $request)
    {
        try {
            DB::beginTransaction();
            $data = BookType::withTrashed()->where('id', $request->id)->first();
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
