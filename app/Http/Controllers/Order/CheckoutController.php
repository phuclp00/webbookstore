<?php

namespace App\Http\Controllers\Order;

use App\Models\ProductModel;
use App\Models\Shipping;
use App\Models\UserModel;
use BeyondCode\Vouchers\Events\VoucherRedeemed;
use BeyondCode\Vouchers\Exceptions\VoucherExpired;
use BeyondCode\Vouchers\Facades\Vouchers as FacadesVouchers;
use BeyondCode\Vouchers\Models\Voucher;
use BeyondCode\Vouchers\Vouchers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Vanthao03596\HCVN\Models\Province;
use Vanthao03596\HCVN\Models\District;
use Vanthao03596\HCVN\Models\Ward;
use App\Http\Controllers\Controller;
use App\Observers\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class CheckoutController extends Controller
{
    private $pathViewController = 'public.page.checkout';


    public function checkout_view()
    {
        if (Auth::check()) {
            $user = UserModel::find(Auth::user()->user_id)->with('user_detail')->first();
            return view($this->pathViewController, ['user' => $user]);
        }
    }
    public function apply_voucher(Request $request)
    {
        $code = $request->code;
        $cart = $request->cart;
        $total = 0;
        $shipping_fee = $request->shipping_fee;
        $old = 0;
        foreach ($cart as  $value) {
            $old += $value["price"] * $value["quantity"];
        }
        try {
            $check_code = FacadesVouchers::check($code);
            if ($check_code) {
                if ($check_code->number_of_uses == 0) {
                    return response([
                        'status' => 'danger',
                        'mess' => 'Mã giảm giá đã hết lượt sử dụng !',
                    ]);
                }
                if ($check_code->model_type == "App\Models\Shipping") {
                    if ($shipping_fee == 0) {
                        return response([
                            'status' => 'danger',
                            'mess' => 'Mã giảm giá vận chuyển không áp dụng cho hình thức lấy tại cửa hàng !',
                        ]);
                    } else {
                        $price_ship = $check_code->model_type::find($check_code->model_id)->price;
                        if ($price_ship == $shipping_fee) {
                            $ship_discount = ($shipping_fee * $check_code->data->get('percent') / 100);
                            return response([
                                'status' => 'success',
                                'mess' => 'Bạn vừa được giảm: ' . $check_code->data->get('percent') . '% phí vận chuyển',
                                'data' => ['price_discount' => $ship_discount]
                            ]);
                        }
                        return response([
                            'status' => 'danger',
                            'mess' => 'Mã giảm giá vận chuyển không áp dụng cho hình thức vận chuyển này !',
                        ]);
                    }
                }
                if ($check_code->model_type == "App\Models\ProductModel") {
                    $product = $check_code->model_type::find($check_code->model_id)->load('promotion');
                    foreach ($cart as $value) {
                        if ($value["book_id"] == $product->book_id) {
                            $total = ($value["price"] * $check_code->data->get('percent') / 100);
                        }
                    }
                    if ($total == $old) {
                        return response([
                            'status' => 'danger',
                            'mess' => 'Mã khuyến mãi không áp dụng cho các sản phẩm này !',
                        ]);
                    }
                    return response([
                        'status' => 'success',
                        'mess' => 'Bạn vừa được giảm ' . $check_code->data->get('percent') . '% từ sản phẩm: ' . $product->book_name,
                        'data' => ["price_discount" => $total]
                    ]);
                }
                if ($check_code->model_type == "App\Models\Order") {
                    if ($old < $check_code->data->get('minium_total')) {
                        return response([
                            'status' => 'danger',
                            'mess' => 'Đơn hàng chưa đạt đủ yêu cầu , vui lòng kiểm tra lại điều kiện sử dụng mã khuyến mãi!',
                        ]);
                    }
                    $total = ($old * 5 / 100);
                    return response([
                        'status' => 'success',
                        'mess' => 'Bạn vừa được giảm ' . $check_code->data->get('percent') . '% tổng đơn hàng từ voucher: ' . $check_code->code,
                        'data' => ["price_discount" => $total]
                    ]);
                }
                if ($check_code->model_type == "App\Models\CategoryModel") {
                    $cat = $check_code->model_type::find($check_code->model_id)->load('descendants');
                    $max_price = null;
                    foreach ($cart as $value) {
                        $product = ProductModel::find($value["book_id"])->load('promotion');
                        if ($product->cat_id == $cat->id) {
                            $max_price[] = $value["price"];
                        } elseif ($cat->descendants) {
                            foreach ($cat->descendants as $value) {
                                if ($product->cat_id == $value->id) {
                                    $max_price[] = $value["price"];
                                }
                            }
                        }
                    }
                    if ($max_price != null) {
                        $price = max($max_price);
                        $total = ($price * $check_code->data->get('percent') / 100);
                        return response([
                            'status' => 'success',
                            'mess' => 'Bạn vừa được giảm ' . $check_code->data->get('percent') . '% cho sản phẩm từ danh mục: ' . $cat->name,
                            'data' => ["price_discount" => $total]
                        ]);
                    }
                    return response([
                        'status' => 'danger',
                        'mess' => 'Mã khuyến mãi không áp dụng cho các sản phẩm này !',
                    ]);
                }
                if ($check_code->model_type == "App\Models\UserModel") {
                    $user = $check_code->model_type::find($check_code->model_id);
                    if ($user) {
                        $total = ($old * $check_code->data->get('percent') / 100);
                        return response([
                            'status' => 'success',
                            'mess' => 'Bạn vừa được giảm ' . $check_code->data->get('percent') . '% tổng đơn hàng từ voucher: ' . $check_code->code,
                            'data' => ["price_discount" => $total]
                        ]);
                    }
                }
            }
        } catch (VoucherExpired $th) {
            return response([
                'status' => 'danger',
                'mess' => 'Mã bạn vừa nhập đã hết hạn sử dụng ! Vui lòng thử mã khác !',
            ]);
        } catch (\Throwable $th) {
            return response([
                'status' => 'danger',
                'mess' => 'Mã bạn vừa nhập không đúng hoặc đã sử dụng !Vui lòng kiểm tra lại' . $th->getMessage(),
            ]);
        }
    }
    public function check_quantity(Request $request)
    {
        $cart = $request->cart;
        foreach ($cart as $value) {
            $book = ProductModel::find($value["book_id"]);
            if ($book->total < $value["quantity"]) {
                return \response([
                    'status' => 'danger',
                    'mess' => "Sản phẩm '" . $book->book_name . "' hiện không đủ số lượng để tiến hành thành toán, số lượng khả dụng hiện tài là :" . $book->total . ".Vui lòng liên hệ bộ phận CSKH để được trợ giúp !"
                ]);
            }
        }
        return \response(['status' => 'success', 'mess' => 'Số lượng sản phẩm hợp lệ ']);
    }
    public function city_list()
    {
        return Cache::remember('province', \now()->addDay(1), function () {
            return Province::all();
        });
    }
    public function district_list()
    {
        return Cache::remember('district', now()->addDay(1), function () {
            return District::all();
        });
    }
    public function wards_list()
    {
        return Cache::remember('ward', now()->addDay(1), function () {
            return Ward::all();
        });
    }
    public function wards(Request $request)
    {
        $check = Cache::has('wards.' . $request->district_code);
        if ($check) {
            return Cache::get('wards.' . $request->district_code);
        }
        $wards = Ward::where('parent_code', $request->district_code)->get();
        Cache::add('wards.' . $request->district_code, $wards, \now()->addDay(1));
        return $wards;
    }
    public function district(Request $request)
    {
        $check = Cache::has('district.' . $request->city_code);
        if ($check) {
            return Cache::get('district.' . $request->city_code);
        }
        $district = District::where('parent_code', $request->city_code)->get();
        Cache::add('district.' . $request->city_code, $district, \now()->addDay(1));
        return $district;
    }
    public function add_order_detail(Request $var = null)
    {
        # code...
    }
    public function add_order_cart(Request $var = null)
    {
        # code...
    }
    public function get_cart_item(Request $request)
    {
        try {
            $cart = $request->cart;
            $books = new Collection();
            foreach ($cart as $key => $item) {
                $books[$key] = ProductModel::find($item["book_id"])->load('promotion');
                $books[$key]["quantity"] = $item["quantity"];
                //Define promotion
                $promotion = $books[$key]->promotion;
                if ($promotion) {
                    if ($promotion->date_expired > now()) {
                        $old_price = $books[$key]["price"];
                        $promotion_price = $old_price - (($old_price * $promotion->percent) / 100);
                        //Add new pirce 
                        $books[$key]["price"] = $promotion_price;
                    }
                }
            }
            return \response([
                'status' => 'success',
                'data' => $books,
                'mess' => 'Tải danh sách sản phẩm trong giỏ hàng thành công ! '
            ]);
        } catch (\Throwable $th) {
            return \response([
                'status' => 'danger',
                'mess' => 'Danh sách sản phẩm bị lỗi vui lòng kiểm tra lại !' . $th->getMessage()
            ]);
        }
    }
}
