<?php

namespace App\Http\Controllers;

use App\Models\BookSeo;
use App\Models\BookSeries;
use App\Models\CategoryModel;
use Illuminate\Http\Request;
use App\Models\ProductModel as MainModel;
use App\Models\ProductModel;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

use function PHPUnit\Framework\returnSelf;

class ShopController extends Controller
{
    private $pathViewController = 'public';
    private $controller_name    = '';
    public function hot_list_view()
    {
        $new_items =  MainModel::all();
        view()->share('list_hot_items', $new_items);
    }
    public function paginate_list_view()
    {
        $new_items =  MainModel::paginate(6);
        view()->share(['pagi_list_items' => $new_items, 'get_cat_items' => null]);
    }
    public function all_list_view()
    {
        $new_items =  MainModel::all();
        view()->share('list_product', $new_items);
    }
    public function related($id)
    {
        if (Cache::has('product.' . $id . '.related')) {
            $book = Cache::get('product.' . $id . '.related');
        } else {
            $book = new Collection();
            $data = ProductModel::find($id);
            if ($data == null) {
                return \response(['stauts' => 'danger', 'mess' => 'Get book related failed, can not find !']);
            }
            //Series
            if ($data->series) {
                $series = BookSeries::find($data->series);
                $book_series = $series->books->sortBy('episode')->values();
                foreach ($book_series as $value) {
                    if ($value != $data) {
                        $book[] = $value;
                    }
                }
            }
            //Author
            foreach ($data->author as $author) {
                foreach ($author->books as $item) {
                    if ($item->book_id != $data->book_id)
                        $book[] = $item;
                }
            }
            //Category 
            $categories = CategoryModel::find($data->cat_id);
            foreach ($categories->books as $item) {
                if ($item->book_id != $data->book_id)
                    $book[] = $item;
            }
            $book->filter(function ($data) {
                return $data->load('author', 'promotion');
            });
            Cache::add('product.' . $id . '.related', $book->unique('book_id')->values(), now()->addHour());
            $book = $book->unique('book_id')->values();
        }
        return $book;
    }
    public function show_product(Request $request)
    {
        if (Cache::has('shop.product.' . $request->slug)) {
            $product = Cache::get('shop.product.' . $request->slug);
        } else {
            $slug = $request->slug;
            $product = BookSeo::where('slug', $slug)->first();
            if ($product == null) {
                $product = ProductModel::where('book_name', $slug)->first();
                Cache::add('shop.product.' . $request->slug, $product, \now()->addHour(1));
            } else {
                $product = $product->book;
                Cache::add('shop.product.' . $request->slug, $product, \now()->addHour(1));
            }
        }
        $view = Redis::incr('product:' . $product->book_id . ':view');
        //Related
        $related = $this->related($product->book_id);
        return view('client.sections.shop.product-detail', ['product' => $product, 'view' => $view, 'related' => $related]);
    }

    public function form(Request $request)
    {
        $id = $request->id;

        return view($this->pathViewController . '.form', ['id' => $id,]);
    }
    public function delete(Request $request)
    {
        $id = $request->id;
        return view('public.test', ['id' => $id]);
    }
    public function status(Request $request)
    {
        $id = $request->id;
        $status = $request->status;
        return \redirect()->route('silder_view');
    }
    public function check_role_review(Request $request)
    {
        if (Auth::check()) {
            $user_address = Auth::user()->address;
            foreach ($user_address as $address) {
                foreach ($address->orders as $order) {
                    foreach ($order->books as $book) {
                        if ($book->book_id == $request->id) {
                            return response(
                                [
                                    'status' => 'success',
                                    'mess' => 'Bạn có thể đánh giá sản phẩm này'
                                ]
                            );
                        }
                    }
                }
            }
        }
        return \response(['status' => 'danger', 'mess' => 'Bạn phải đăng nhập để đánh giá sản phẩm này ']);
    }
    public function check_rating(Request $request)
    {
        if (Auth::check()) {
            $user = Auth::user();
            foreach ($user->rating as $value) {
                if ($value->book_id == $request->id) {
                    return \response(['status' => 'danger', 'mess' => 'Bạn đã đánh giá sản phẩm này rồi ']);
                }
            }
            return response(
                [
                    'status' => 'success',
                    'mess' => 'Bạn có thể đánh giá sản phẩm này'
                ]
            );
        }
        return \response(['status' => 'danger', 'mess' => 'Bạn phải đăng nhập để đánh giá sản phẩm này ']);
    }
}
