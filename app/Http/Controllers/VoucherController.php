<?php

namespace App\Http\Controllers;

use App\Events\User\VoucherCreate;
use App\Models\UserModel;
use BeyondCode\Vouchers\Facades\Vouchers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class VoucherController extends Controller
{
    public function create_voucher_user(Request $request)
    {
        try {
            $user = UserModel::find($request->user[0]["user_id"]);
            $data = Vouchers::create(
                $user,
                1,
                [
                    "from" => "Admin " . Auth::user()->user_name,
                    "to" => $user->user_name,
                    "percent" => $request->percent,
                    'minium_total' => $request->amount,
                    "type" => "user"
                ],
                $request->expired == null ? \now()->addDay(1) : $request->expired,
                $request->number_of_uses == null ? 1 : $request->number_of_uses
            );
            \event(new VoucherCreate($user, $data));
            return \response(['status' => 'success', 'mess' => 'Voucher has been successfully generated and successfully sent to user email.']);
        } catch (\Throwable $th) {
            return \response(['status' => 'danger', 'mess' => 'Create Voucher failed with error' . $th->getMessage()]);
        }
    }
}
