<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RatingController extends Controller
{
    public function index()
    {
        return Rating::all()->load('book', 'user');
    }
    public function delete($id, $mess)
    {
        try {
            DB::beginTransaction();
            $rate = Rating::find($id);
            $rate->title = "Bình luận đã bị xóa";
            $rate->comment = "Bình luận này đã bị xóa vì vi phạm tiêu chuẩn cộng đồng của chúng tôi. Lý do cụ thể: " . $mess;
            $rate->modified_by = Auth::user()->user_name;
            $rate->save();
            DB::commit();
            return \response(['status' => 'success', 'data' => $this->index(), 'mess' => 'Filter rating success !']);
        } catch (\Throwable $th) {
            DB::rollback();
            return \response(['status' => 'falied', 'mess' => 'Filter rating failed !' . $th->getMessage()]);
        }
    }
}
