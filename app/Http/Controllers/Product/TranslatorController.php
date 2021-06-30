<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Store\ImagesController;
use App\Http\Requests\Translator\Translator_Update;
use App\Http\Requests\Translator\TranslatorRequest;
use App\Models\ProductModel;
use App\Models\Translator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Exception;

class TranslatorController extends Controller
{
    public function index()
    {
        return  Translator::all()->pluck('name');
    }
    public function show(Request $request)
    {
        return Translator::find($request);
    }
    public function get_related(Request $request)
    {
        $book = ProductModel::find($request->book_id);
        return $book->translator;
    }
    public function edit(Translator_Update $request)
    {
        try {
            DB::beginTransaction();
            $data = Translator::withTrashed()->where('id', $request->id)->first();
            $file =  new ImagesController(250, 200, $request->id);
            $data->name = $request->name;
            $data->description = $request->content;
            if ($request->img) {
                $data->image = $file->update($request->img, $data->image, "translator");
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
            return \redirect()->route('admin.translator');
        } catch (\Throwable $th) {
            $request->session()->flash('infor_warning', '<div class="alert alert-danger" style="text-align: center;font-size: x-large;font-family: fangsong;"> Edit ' . $request->name . 'Fail,with error ' . $th->getMessage() . 'Try Again !! </div>');
            DB::rollBack();
            return \redirect()->back();
        }
    }
    public function add(TranslatorRequest $request)
    {
        $file =  new ImagesController(250, 200, $request->id);
        try {
            DB::beginTransaction();
            $product = Translator::create([
                'name' => $request->name,
                'description' => $request->content,
                'image' => $request->img != null ? $file->store($request->img, "translator") : null,
                'created_by' => Auth::user()->user_name,
            ]);
            $request->session()->flash('infor_success', '<div class="alert alert-success" style="text-align: center;font-size: x-large;font-family: fangsong;"> Edit ' . $request->name . ' Successfully !! </div>');
            DB::commit();
            return \redirect()->route('admin.translator');
        } catch (\Throwable $th) {
            $request->session()->flash('infor_warning', '<div class="alert alert-danger" style="text-align: center;font-size: x-large;font-family: fangsong;"> Edit ' . $request->name . 'Fail,Try Again !! </div>');
            DB::rollBack();
            return \redirect()->back();
        }
    }
    public function delete(Request $request)
    {
        $file =  new ImagesController(250, 200, $request->id);
        try {
            DB::beginTransaction();
            $data = Translator::where('id', $request->id)->with('books')->first();
            if ($data->books()->exists() == false) {
                $data->forceDelete();
                $file->destroy("translator");
                $request->session()->flash('infor_success', '<div class="alert alert-success" style="text-align: center;font-size: x-large;font-family: fangsong;"> Delete ' . $request->name . ' Successfully !! </div>');
            } else {
                $data->deleted_by = Auth::user()->user_name;
                $data->save();
                $data->delete();
                $request->session()->flash('infor_mess', '<div class="alert alert-success" style="text-align: center;font-size: x-large;font-family: fangsong;"> The translator ' . $request->name . ' has been moved to the "Restore List" category!! </div>');
            }
            DB::commit();
            return redirect()->route("admin.translator");
        } catch (Exception $e) {
            $request->session()->flash('info_warning', '<div class="alert alert-danger" style="text-align: center;font-size: x-large;font-family: fangsong;"> Delete ' . $request->name . 'Failed, Cannot Be Deleted If It Has Been Used By A Book !! </div>');
            DB::rollBack();
            return redirect()->route("admin.translator");
        }
    }
    public function restore(Request $request)
    {
        try {
            DB::beginTransaction();
            $data = Translator::withTrashed()->where('id', $request->id)->first();
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
