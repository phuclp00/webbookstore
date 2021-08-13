<?php

namespace App\Http\Controllers;

use App\Events\Order\OrderCancel;
use App\Events\Order\OrderComplete;
use App\Events\Order\OrderRestore;
use App\Models\Order;
use App\Events\Order\OrderSuccess;
use App\Events\Order\StatusUpdate;
use App\Events\Promotion\PromotionStart;
use App\Events\RatingProduct;
use App\Events\SendEmailContact;
use App\Events\User\VoucherCreate;
use App\Http\Controllers\Order\OrderController;
use App\Models\Author;
use App\Models\BookPromotions;
use App\Models\BookSeries;
use App\Models\CategoryModel;
use App\Models\Guest;
use App\Models\OrderStatus;
use App\Models\ProductModel;
use App\Models\SupplierModel;
use App\Models\TagsModel;
use App\Models\Translator;
use App\Models\UserAddress;
use App\Models\UserModel;
use App\Observers\Product;
use App\Observers\Promotion;
use BeyondCode\Vouchers\Facades\Vouchers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Vanthao03596\HCVN\Models\Ward;

class TestController extends Controller
{
    public function text(Request $request)
    {

        #ORder finding

        $order = Order::find('28973353MN302304X');

        #Promotion
        $promotion = BookPromotions::all()->first();
        \event(new PromotionStart($promotion,));


        #time difff

        $date =  Carbon::create($promotion->date_started)->diff(\now());
        $second = \now()->diffInSeconds($promotion->date_started);
        dd($second);
        #Update sales for each book

        // $orders = Order::all();
        // $book = new Collection();
        // foreach ($orders as $order) {
        //     foreach ($order->books as $item) {
        //         $book[] = $item;
        //     }
        // }
        // $group = $book->groupBy('book_id');
        // $books = [];
        // foreach ($group as $key => $value) {
        //     $total = 0;

        //     foreach ($value as $book) {
        //         $total += $book->pivot->quantity;
        //     }
        //     Redis::set('product:' . $key . ':sales', $total);
        // }
        // dd($books);

        #


        //$order = Order::find('9KX11823GB856462J');
        // event(new UserRegisted($data));
        //event(new OrderComplete($order));
        // $categories = CategoryModel::defaultOrder()->ancestorsAndSelf(58)->map(function ($data, $key) {
        //     if ($data->getSiblings()->count() > 0) {
        //         foreach ($data->getSiblings() as $value) {
        //             $test[] = $value->name;
        //         }
        //         return $test;
        //     } else {
        //         return $data->name;
        //     }
        // $order = Order::all();
        // $guest = Guest::all();
        // $data = UserAddress::all()->load('get_wards', 'get_city', 'get_districts');
        // $new = $data->replicate();
        // $new->address_line_1 = $request->address_line_1;
        // $new->address_line_2 = $request->address_line_2;
        // $new->wards = $request->wards;
        // $new->district = $request->district;
        // $new->city = $request->city;
        // $new->modiffed_by = "User " . $old->user->user_name;
        // $new->save();
        // $product = ProductModel::all()->first();
        // $user = UserModel::all()->first();
        // event(new RatingProduct($product, $user));
        // $data = BookPromotions::all();
        // foreach ($data as $value) {
        //     if ($value->date_expired <= now()) {
        //         $value->books()->update(['promotion_id' => null]);
        //         $value->save();
        //     }
        // }
        //$view = Cache::increment('product:sale:1', 2);
        //$item = Cache::get('product:sale:1');
        //dd(Cache::delete('product:sale:1'));
        //dd($view);
        $b = 1;
        while ($b < 50) {
            $order = new Order();
            $order->id = "1" + $b;
            $order->status_id = 6;
            $order->payment_id = 1;
            $order->created_at = Carbon::now()->subDays(\rand(1, 365));
            $order->save();
            $b++;
        }
        dd("OK", $b);


        $order = Order::select('*', DB::raw('DATE(created_at) as date'))->where('status_id', 6)->get()->groupBy('date');
        dd($order);



        // $orders = Redis::get('orders:total');
        // dd(Cache::store('redis')->get('product.book.total'));
        // $total = 0;
        // $order=Order::all();
        // foreach ($order as $key => $value) {

        // }


        // Redis::set('orders:sales:total', $users);
        // dd($total);

        $order = Order::all();
        $total = 0;
        $data = new Collection();
        foreach ($order as $value) {
            foreach ($value->books as $item) {
                $data[] = $item;
            }
        }
        $count = $data->groupBy('book_id');
        foreach ($count as $key => $value) {
            //$total = 0;
            foreach ($value as $book) {
                $total += $book->pivot->quantity;
            }
            //::set('product:' . $key . ':sales', $total);
        }
        // $data = ProductModel::all();
        // foreach ($data as  $value) {
        //     Redis::set('product:' . $value->book_id . ':view', \rand(100, 1000));
        // }
        $oder = Order::all()->count();
        Redis::set('orders:total', $oder);
        dd($total);

        // $result = CategoryModel::get()->toTree();
        // $user = Guest::all()->first();
        //return view('auth.forgot-password');
        // });
        // dd($categories);
        // $book = ProductModel::find('CN97')->category->ancestors;
        // $data = ProductModel::all();
        // foreach ($data as $value) {
        //     $value->searchable();
        // }
        //  new SendEmailContact('1313', '131@1231', 'OK', 123131313);
        $book = new Collection();
        $result = CategoryModel::whereIsRoot()->with('descendants')->with([
            'books.thumb',
            'books.category',
            'books.tags',
            'books.format',
            'books.series',
            'books.publisher',
            'books.supplier',
            'books.translator',
            'books.author',
            'books.lang',
            'books.promotion'
        ])->get();
        $result->filter(function ($value) {
            return $value->descendants->load(
                'books.thumb',
                'books.category',
                'books.tags',
                'books.format',
                'books.series',
                'books.publisher',
                'books.supplier',
                'books.translator',
                'books.author',
                'books.lang',
                'books.promotion'
            );
        });
        $result->filter(function ($value) {
            foreach ($value->descendants as $child) {
                $value->books[] = $child->books()->orderBy('created_at', 'DESC')->get()->take(7);
            }
        });
        Cache::flush();
        return $result;
        // ProductModel::create([
        //     'book_id' => 'test',
        //     'book_name' => 'test',
        //     'description' => 'test',
        //     'size' => 1,
        //     'img' => null,
        //     'pub_id' => 'fn',
        //     'cat_id' => 86,
        //     'sup_id' => 3,
        //     'weight' => 1,
        //     'series' => null,
        //     'episode' => null,
        //     'price' => 1,
        //     'promotion_id' => 2,
        //     'out_of_business' => 0,
        //     'datePublished' => \now(),
        //     'copyrightYear' => 2019,
        //     'bookFormat' => 1,
        //     'serialNumber' => 1,
        //     'numberOfPages' => 1,
        //     'language' => 'vi',
        //     'total' => 1,
        //     'created_by' => 'Loc',
        //     'deleted_by' => null,
        //     'modified_by' => null,
        // ]);
        // $token = $request->user()->createToken($request->token_name);
        //return $request->user()->createToken('token-name', ['server:update'])->plainTextToken;

        //$user = UserModel::where('email', 'locdo255@gmail.com')->first();
        return "test";
    }
}
