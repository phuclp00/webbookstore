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

    public function user_delete_rating($id)
    {
        try {
            DB::beginTransaction();
            $rate = Rating::find($id);
            $user = Auth::user();
            if ($rate->user->refresh_token == $user->refresh_token) {
                $rate->forceDelete();
                DB::commit();
                return \response(['status' => 'success', 'data' => $this->index(), 'mess' => 'Bạn đã xóa đánh giá cho sản phẩm này! Hãy đánh giá lại nếu bạn yêu thích sản phẩm này nhé !']);
            } else {
                return \response(['status' => 'danger', 'mess' => 'Bạn không thể xóa đánh giá này !']);
            }
        } catch (\Throwable $th) {
            DB::rollback();
            return \response(['status' => 'danger', 'mess' => 'Xóa đánh giá cho sản phẩm này không thành công !']);
        }
    }
    //Admin
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
