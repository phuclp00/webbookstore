<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Store\ImagesController;
use App\Http\Requests\Promotions\Promotions_Update;
use App\Http\Requests\Promotions\PromotionsRequest;
use App\Models\Author;
use App\Models\BookPromotions as Promotions;
use App\Models\CategoryModel;
use App\Models\ProductModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Exception;
use PhpOffice\PhpSpreadsheet\Calculation\Category;
use PhpParser\Node\Stmt\Break_;

use function React\Promise\Stream\first;

class PromotionsController extends Controller
{
    public function index()
    {
        $data = Promotions::all();
        return  $data->pluck('name');
    }
    public function show(Request $request)
    {
        return  Promotions::find($request->id);
    }

    public function edit(Promotions_Update $request)
    {
        try {
            DB::beginTransaction();
            $data = Promotions::withTrashed()->where('id', $request->id)->first();
            $data->name = $request->name;
            $data->content = $request->content;
            $data->date_expired = $request->date_expired;
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
            return \redirect()->route('admin.promotions');
        } catch (\Throwable $th) {
            $request->session()->flash('infor_warning', '<div class="alert alert-danger" style="text-align: center;font-size: x-large;font-family: fangsong;"> Edit ' . $request->name . 'Fail,with error ' . $th->getMessage() . 'Try Again !! </div>');
            DB::rollBack();
            return \redirect()->back();
        }
    }
    public function add(PromotionsRequest $request)
    {
        try {
            DB::beginTransaction();
            $product = Promotions::create([
                'name' => $request->name,
                'content' => $request->content,
                'percent' => $request->percent,
                'date_expired' => $request->date_expired,
                'created_by' => Auth::user()->user_name,
            ]);
            $request->session()->flash('infor_success', '<div class="alert alert-success" style="text-align: center;font-size: x-large;font-family: fangsong;"> Edit ' . $request->name . ' Successfully !! </div>');
            DB::commit();
            return \redirect()->route('admin.promotions');
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
            $data = Promotions::where('id', $request->id)->with('books')->first();
            if ($data->books()->exists() == false) {
                $data->forceDelete();
                $request->session()->flash('infor_success', '<div class="alert alert-success" style="text-align: center;font-size: x-large;font-family: fangsong;"> Delete ' . $request->name . ' Successfully !! </div>');
            } else {
                $data->deleted_by = Auth::user()->user_name;
                $data->save();
                $data->delete();
                $request->session()->flash('infor_mess', '<div class="alert alert-success" style="text-align: center;font-size: x-large;font-family: fangsong;"> The promotions ' . $request->name . ' has been moved to the "Restore List" category!! </div>');
            }
            DB::commit();
            return redirect()->route("admin.promotions");
        } catch (Exception $e) {
            $request->session()->flash('info_warning', '<div class="alert alert-danger" style="text-align: center;font-size: x-large;font-family: fangsong;"> Delete ' . $request->name . 'Failed, Cannot Be Deleted If It Has Been Used By A Book !! </div>');
            DB::rollBack();
            return redirect()->route("admin.promotions");
        }
    }
    public function restore(Request $request)
    {
        try {
            DB::beginTransaction();
            $data = Promotions::withTrashed()->where('id', $request->id)->first();
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
    public function promotions(Request $request)
    {
        try {
            DB::beginTransaction();
            $pre_result = null;
            $promotion_id = Promotions::where('name', $request->promotions)->first();
            \preg_match('/(?<type>\w*):(?<data>.*)/', $request->type, $result);
            switch ($result['type']) {
                case 'books':
                    $data = explode(',', $result['data']);
                    foreach ($data as $key => $value) {
                        $id = explode(':', $value);
                        $pre_result[] = trim($id[0]);
                    }
                    foreach ($pre_result as $value) {
                        $book = ProductModel::find($value);
                        $book->promotion_id = $promotion_id->id;
                        $book->modified_by = Auth::user()->user_name;
                        $book->save();
                        DB::commit();
                    }
                    break;
                case 'category':
                    $data = explode(',', $result['data']);
                    foreach ($data as $value) {
                        $cat_id = CategoryModel::where('name', trim($value))->first()->id;
                        $books = ProductModel::where('cat_id', $cat_id)->get();
                        foreach ($books as $book) {
                            $book->promotion_id = $promotion_id->id;
                            $book->modified_by = Auth::user()->user_name;
                            $book->save();
                        }
                    }
                    DB::commit();
                    break;
                case 'author':
                    $data = explode(',', $result['data']);
                    foreach ($data as $value) {
                        $author = Author::where('name', trim($value))->with('books')->first();
                        foreach ($author->books as $book) {
                            $book->promotion_id = $promotion_id->id;
                            $book->modified_by = Auth::user()->user_name;
                            $book->save();
                        }
                    }
                    DB::commit();
                    break;

                default:
                    break;
            }
            return \response()->json([
                "result" => Promotions::all(),
                "mess" => "Promotions added to the book was successfull !!",
                "status" => "success"
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return \response()->json([
                "result" => ProductModel::all(),
                "mess" => "Promotions added to the book was failed with error : " . $th->getMessage() . "!!",
                "status" => "danger"
            ]);
        }
    }
}
