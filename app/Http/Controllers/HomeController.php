<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\SilderController;
use App\Http\Controllers\Product\CategoryController;
use App\Http\Controllers\Product\ProductController;
use App\Models\Author;
use App\Models\BookPromotions;
use App\Models\BookSeries;
use App\Models\BooksFormat;
use App\Models\CategoryModel;
use App\Models\ProductModel;
use App\Models\BookThumbnailModel;
use App\Models\BookType;
use App\Models\Guest;
use App\Models\Language;
use App\Models\Order;
use App\Models\PublisherModel;
use App\Models\Rating;
use App\Models\Series;
use App\Models\SupplierModel;
use App\Models\TagsModel;
use App\Models\Translator;
use App\Models\UserAddress;
use App\Models\UserModel;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use DatePeriod;
use Doctrine\DBAL\Schema\Index;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use ListLanguages;

class HomeController extends Controller
{

    private $subpatchViewController = '.page';
    private $pathViewController = 'public.';
    public function __construct()
    {
        (new SilderController)->slide_homepage();
        (new ShopController)->all_list_view();
        (new CategoryController)->list_category();
        (new CategoryController)->top_list_category();
        (new ShopController)->paginate_list_view();
        //$list_get_category=(new CategoryController)->get_category();

        // New client 
        (new ProductController)->features_product();
        (new CategoryController)->product_list();
        (new ProductController)->flash_sale();
    }
    // FRONT-END
    public function index()
    {
        return view('client.sections.home.index');
    }

    public function home()
    {
        return view($this->pathViewController . 'index');
    }
    public function about_view()
    {
        return view($this->pathViewController . $this->subpatchViewController . '.about');
    }
    public function faq_view()
    {
        return view('client.sections.static.faq');
    }
    public function policy_view()
    {
        return view($this->pathViewController . $this->subpatchViewController . '.privacy-policy');
    }
    public function shipping_view()
    {
        return view($this->pathViewController . $this->subpatchViewController . '.shipping');
    }
    public function terms_view()
    {
        return view($this->pathViewController . $this->subpatchViewController . '.terms-conditions');
    }
    public function shop_view()
    {
        return view('client.sections.shop.shop');
    }
    public function get_list_id(Request $request)
    {
        $items = $request->id;
        $items = ProductModel::with('category')->where("id", "=", $items);
        view()->share('get_cat_items', $items);
    }
    // Quick View chua xu ly duoc 
    public function get_info(Request $request)
    {
        $id_book = $request->id;
        $item = ProductModel::where("book_id", $id_book)->get();
        // Fetch all records
        view()->share("info_book", $item);
    }
    public function get_category(Request $request)
    {
        $id = $request->id;
        $mainModel = new CategoryModel();

        //Truy xuat theo dieu kien trong Model()

        //$items=$mainModel->listItems("id",['task'=>"special-list-items"],$id,"===");

        //Truy xuat theo relationship
        $items = ProductModel::with('category')->where("id", "=", $id)->paginate(6);

        return view($this->pathViewController . $this->subpatchViewController  . '.shop', ["get_cat_items" => $items]);
    }
    public function order_check_view()
    {
        return view('client.sections.static.order-check');
    }
    public function product_view()
    {
        return view($this->pathViewController . $this->subpatchViewController  . '.single-product');
    }
    public function error_view()
    {
        return view('errors.error404');
    }
    public function contact()
    {
        return \view('client.sections.static.contact');
    }
    public function team_view()
    {
        return view($this->pathViewController . $this->subpatchViewController  . '.team');
    }
    public function wishlist_view()
    {
        return view($this->pathViewController . $this->subpatchViewController  . '.wishlist');
    }
    public function blog_view()
    {
        return view($this->pathViewController . $this->subpatchViewController  . '.blog');
    }
    public function blogdetail_view()
    {
        return view($this->pathViewController . $this->subpatchViewController  . '.blog-details');
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////////
    // BACK-END

    public function login_view()
    {
        if (Auth::check() == true) {
            return \redirect()->back();
        } else {
            return view('admin.login.sign-in');
        }
    }
    public function register_view()
    {
        return view('admin.login.sign-up');
    }
    //Dashboard
    public function dash_view()
    {
        $book_total = Redis::get('product:book:total');
        $users = Redis::get('users:total');
        $sales = Redis::get('orders:sales:total');
        $orders = Redis::get('orders:total');
        return view('admin.layout.show.admin-dashboard', [
            'book_total' => $book_total,
            'users' => $users,
            'sales' => $sales,
            'orders' => $orders
        ]);
    }
    public function get_chart_data($date)
    {
        try {
            $date = new Carbon($date);
            $start = $date->startOfMonth()->toDateTimeString();
            $end = $date->endOfMonth()->toDateTimeString();
            $order = Order::select('*', DB::raw('DATE(created_at) as date'))
                ->where('status_id', 6)
                ->where('created_at', '>=', $start)
                ->where('created_at', '<=', $end)
                ->orderBy('date', 'ASC')
                ->get()
                ->groupBy('date');

            $listday = [];
            $data = [];

            $dayOfmoth = CarbonPeriod::create($start, $end);
            $listday = [];
            foreach ($dayOfmoth as $key => $value) {
                $listday[] = $value->format("Y-m-d");
            }
            foreach ($listday as $day) {
                $total = 0;
                foreach ($order as $key => $value) {
                    if (($key == $day)) {
                        foreach ($value as $item) {
                            if ($item->books) {
                                foreach ($item->books as $book) {
                                    $total += $book->price * $book->pivot->quantity;
                                }
                            }
                        }
                    }
                }
                $data[] = $total;
            }

            return response([
                'status' => 'success',
                'mess' => 'Load data chart successfully',
                'date' => $listday,
                'data' => $data
            ]);
        } catch (\Throwable $th) {
            return response([
                'status' => 'danger',
                'mess' => 'Load data chart failed with ' . $th->getMessage(),
            ]);
        }
    }
    public function get_top_product($type)
    {
        try {
            $data = ProductModel::all()->load('rating');
            $data->filter(function ($data) {
                $data->sales = Redis::get('product:' . $data->book_id . ':sales');
                $data->view = Redis::get('product:' . $data->book_id . ':view');
                $data->rate = $data->rating()->avg('rating') == null ? 0 : $data->rating()->avg('rating') + 0;
            });
            $top_product = $data->sortByDesc($type);
            return \response([
                'status' => 'success',
                'data' =>  $top_product->values()->take(10),
                'mess' => 'Get List Product Success'
            ]);
        } catch (\Throwable $th) {
            return \response([
                'status' => 'danger',
                'mess' => 'Get List Product Failed' . $th->getMessage()
            ]);
        }
    }

    //Category
    public function category_view()
    {
        $result = CategoryModel::all()->load([
            'books.thumb',
            'books.category',
            'books.tags',
            'books.format',
            'books.series',
            'books.publisher',
            'books.supplier',
            'books.translator',
            'books.author',
            'books.lang'

        ])->toFlatTree();
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
                'books.lang'
            );
        });
        return view('admin.layout.show.admin-category', ['cat_list' => $result]);
    }
    public function category_old_view()
    {
        $result = CategoryModel::onlyTrashed()->with([
            'books.thumb',
            'books.category',
            'books.tags',
            'books.format',
            'books.series',
            'books.publisher',
            'books.supplier',
            'books.translator',
            'books.lang',
            'books.author',
        ])->get();
        return view('admin.layout.show.old.admin-category', ['cat_list' => $result]);
    }
    public function category_add_view()
    {
        $group = CategoryModel::all()->toFlatTree();
        return view('admin.layout.add.admin-add-category', ['group' => $group]);
    }
    public function category_edit_view(Request $request)
    {
        $result = CategoryModel::withTrashed()->where('id', $request->id)->first();
        $group = CategoryModel::all()->toFlatTree();
        return view('admin.layout.edit.admin-edit-category', ['category' => $result, 'group' => $group]);
    }
    //Tags
    public function tags_view()
    {
        $result = TagsModel::all()->load([
            'books.thumb',
            'books.category',
            'books.tags',
            'books.format',
            'books.series',
            'books.publisher',
            'books.supplier',
            'books.translator',
            'books.lang',
            'books.author'
        ])->toFlatTree();
        return view('admin.layout.show.admin-tags', ['cat_list' => $result]);
    }
    public function tags_old_view()
    {
        $result = TagsModel::onlyTrashed()->with([
            'books.thumb',
            'books.category',
            'books.tags',
            'books.format',
            'books.series',
            'books.publisher',
            'books.supplier',
            'books.translator',
            'books.lang',
            'books.author'
        ])->get();
        return view('admin.layout.show.old.admin-tags', ['cat_list' => $result]);
    }
    public function tags_add_view()
    {
        $group = TagsModel::all()->toFlatTree();
        return view('admin.layout.add.admin-add-tags', ['group' => $group]);
    }
    public function tags_edit_view(Request $request)
    {
        $result = TagsModel::withTrashed()->where('id', $request->id)->first();
        $group = TagsModel::all()->toFlatTree();
        return view('admin.layout.edit.admin-edit-tags', ['tags' => $result, 'group' => $group]);
    }
    //Book
    public function book_list_view()
    {
        $result = ProductModel::all()
            ->load('thumb')
            ->load('publisher')
            ->load('author')
            ->load('translator')
            ->load('series')
            ->load('tags')
            ->load('category')
            ->load('format')
            ->load('supplier')
            ->load('lang')
            ->load('rating')
            ->load('promotion');
        $result->filter(function ($data) {
            $data->sales = Redis::get('product:' . $data->book_id . ':sales');
            $data->view = Redis::get('product:' . $data->book_id . ':view');
            $data->rate = $data->rating()->avg('rating') == null ? 0 : $data->rating()->avg('rating') + 0;
        });
        return view('admin.layout.show.admin-books', ['book' => $result]);
    }
    public function book_list_out_of_business()
    {
        $result = ProductModel::onlyTrashed()
            ->with('thumb')
            ->with('publisher')
            ->with('author')
            ->with('category')
            ->with('translator')
            ->with('tags')
            ->with('lang')
            ->with('supplier')
            ->with('series')
            ->with('format')
            ->with('promotion')
            ->with('rate')
            ->with('rating')
            ->get();
        $result->filter(function ($data) {
            $data->sales = Redis::get('product:' . $data->book_id . ':sales');
            $data->view = Redis::get('product:' . $data->book_id . ':view');
            $data->rate = $data->rating()->avg('rating') == null ? 0 : $data->rating()->avg('rating') + 0;
        });
        return view('admin.layout.show.old.admin-books', ['book' => $result]);
    }
    public function book_list_add_view()
    {
        $cat = CategoryModel::all()->toFlatTree();
        $pub = PublisherModel::all();
        $auth = Author::all();
        $format = BooksFormat::all();
        $lang = ListLanguages::lookup();
        $translator = Translator::all();
        $sup = SupplierModel::all();
        $series = BookSeries::all();
        $promotions = BookPromotions::all();
        return view(
            'admin.layout.add.admin-add-book',
            [
                'cat' => $cat,
                'pub' => $pub,
                'auth' => $auth,
                'sup' => $sup,
                'format' => $format,
                'language' => $lang,
                'translator' => $translator,
                'series' => $series,
                'promotion' => $promotions
            ]
        );
    }
    public function book_edit_view(Request $request)
    {
        $cat = CategoryModel::all()->toFlatTree();
        $pub = PublisherModel::all();
        $auth = Author::all();
        $format = BooksFormat::all();
        $lang = ListLanguages::lookup();
        $translator = Translator::all();
        $sup = SupplierModel::all();
        $series = BookSeries::all();
        $promotions = BookPromotions::all();
        $result = ProductModel::withTrashed()
            ->where('book_id', $request->book_id)
            ->with('thumb')
            ->with('publisher')
            ->with('author')
            ->with('category')
            ->with('translator')
            ->with('tags')
            ->with('lang')
            ->with('supplier')
            ->with('series')
            ->with('format')
            ->first();
        preg_match_all('/\d+/', $result->size, $size);
        $height = $size[0][0];
        $width = $size[0][1];
        return view(
            'admin.layout.edit.admin-edit-book',
            [
                'book' => $result,
                'cat' => $cat,
                'pub' => $pub,
                'auth' => $auth,
                'sup' => $sup,
                'format' => $format,
                'language' => $lang,
                'translator' => $translator,
                'height' => $height,
                'width' => $width,
                'series' => $series,
                'promotion' => $promotions
            ]
        );
    }
    //Publisher 
    public function publisher_view(Request $request)
    {
        $result = PublisherModel::all()->load([
            'books.thumb',
            'books.category',
            'books.tags',
            'books.format',
            'books.series',
            'books.publisher',
            'books.supplier',
            'books.translator',
            'books.lang',
            'books.author'
        ]);
        return view('admin.layout.show.admin-publisher', ['pub_list' => $result]);
    }
    public function publisher_old_view(Request $request)
    {
        $result = PublisherModel::onlyTrashed()->with([
            'books.thumb',
            'books.category',
            'books.tags',
            'books.format',
            'books.series',
            'books.publisher',
            'books.supplier',
            'books.translator',
            'books.lang',
            'books.author'
        ])->get();
        return view('admin.layout.show.old.admin-publisher', ['pub_list' => $result]);
    }
    public function add_publisher_view()
    {
        return view('admin.layout.add.admin-add-publisher');
    }
    public function edit_publisher_view(Request $request)
    {
        $result = PublisherModel::withTrashed()->where('id', $request->id)->first();
        return view('admin.layout.edit.admin-edit-publisher', ['publisher' => $result]);
    }
    //Supplier 
    public function supplier_view(Request $request)
    {
        $result = SupplierModel::all()->load([
            'books.thumb',
            'books.category',
            'books.tags',
            'books.format',
            'books.series',
            'books.publisher',
            'books.supplier',
            'books.translator',
            'books.lang',
            'books.author'
        ]);
        return view('admin.layout.show.admin-supplier', ['sub_list' => $result]);
    }
    public function supplier_old_view(Request $request)
    {
        $result = SupplierModel::onlyTrashed()->with([
            'books.thumb',
            'books.category',
            'books.tags',
            'books.format',
            'books.series',
            'books.publisher',
            'books.supplier',
            'books.translator',
            'books.lang',
            'books.author'
        ])->get();
        return view('admin.layout.show.old.admin-supplier', ['sub_list' => $result]);
    }
    public function add_supplier_view()
    {
        return view('admin.layout.add.admin-add-supplier');
    }
    public function edit_supplier_view(Request $request)
    {
        $result = SupplierModel::withTrashed()->where('id', $request->id)->first();
        return view('admin.layout.edit.admin-edit-supplier', ['supplier' => $result]);
    }
    //Author 
    public function author_view()
    {
        $data = Author::all()->load([
            'books.thumb',
            'books.category',
            'books.tags',
            'books.format',
            'books.series',
            'books.publisher',
            'books.supplier',
            'books.translator',
            'books.lang',
            'books.author'
        ]);
        return view('admin.layout.show.admin-author', ['data' => $data]);
    }
    public function author_old_view()
    {
        $data = Author::onlyTrashed()->with([
            'books.thumb',
            'books.category',
            'books.tags',
            'books.format',
            'books.series',
            'books.publisher',
            'books.supplier',
            'books.translator',
            'books.lang',
            'books.author'
        ])->get();
        return view('admin.layout.show.old.admin-author', ['data' => $data]);
    }
    public function author_add_view()
    {
        return view('admin.layout.add.admin-add-author');
    }
    public function author_edit_view(Request $request)
    {
        $data = Author::withTrashed()->where('id', $request->id)->first();
        return view('admin.layout.edit.admin-edit-author', ['data' => $data]);
    }
    //Series 
    public function series_view()
    {
        $data = BookSeries::all()->load([
            'books.thumb',
            'books.category',
            'books.tags',
            'books.format',
            'books.series',
            'books.publisher',
            'books.supplier',
            'books.translator',
            'books.lang',
            'books.author'
        ]);
        return view('admin.layout.show.admin-series', ['data' => $data]);
    }
    public function series_old_view()
    {
        $data = BookSeries::onlyTrashed()->with([
            'books.thumb',
            'books.category',
            'books.tags',
            'books.format',
            'books.series',
            'books.publisher',
            'books.supplier',
            'books.translator',
            'books.lang',
            'books.author'
        ])->get();
        return view('admin.layout.show.old.admin-series', ['data' => $data]);
    }
    public function series_add_view()
    {
        return view('admin.layout.add.admin-add-series');
    }
    public function series_edit_view(Request $request)
    {
        $data = BookSeries::withTrashed()->where('id', $request->id)->first();
        return view('admin.layout.edit.admin-edit-series', ['data' => $data]);
    }
    //Promotions 
    public function promotions_view()
    {
        $data = BookPromotions::all()->load([
            'books.thumb',
            'books.category',
            'books.tags',
            'books.format',
            'books.series',
            'books.publisher',
            'books.supplier',
            'books.translator',
            'books.lang',
            'books.author'
        ]);
        return view('admin.layout.show.admin-promotions', ['data' => $data]);
    }
    public function promotions_old_view()
    {
        $data = BookPromotions::onlyTrashed()->with([
            'books.thumb',
            'books.category',
            'books.tags',
            'books.format',
            'books.series',
            'books.publisher',
            'books.supplier',
            'books.translator',
            'books.lang',
            'books.author'
        ])->get();
        return view('admin.layout.show.old.admin-promotions', ['data' => $data]);
    }
    public function promotions_add_view()
    {
        return view('admin.layout.add.admin-add-promotions');
    }
    public function promotions_edit_view(Request $request)
    {
        $data = BookPromotions::withTrashed()->where('id', $request->id)->first();
        return view('admin.layout.edit.admin-edit-promotions', ['data' => $data]);
    }
    //Format 
    public function format_view()
    {
        $data = BooksFormat::all()->load([
            'books.thumb',
            'books.category',
            'books.tags',
            'books.format',
            'books.series',
            'books.publisher',
            'books.supplier',
            'books.translator',
            'books.lang',
            'books.author'
        ]);
        return view('admin.layout.show.admin-format', ['data' => $data]);
    }
    public function format_old_view()
    {
        $data = BooksFormat::onlyTrashed()->with([
            'books.thumb',
            'books.category',
            'books.tags',
            'books.format',
            'books.series',
            'books.publisher',
            'books.supplier',
            'books.translator',
            'books.lang',
            'books.author'
        ])->get();
        return view('admin.layout.show.old.admin-format', ['data' => $data]);
    }
    public function format_add_view()
    {
        return view('admin.layout.add.admin-add-format');
    }
    public function format_edit_view(Request $request)
    {
        $data = BooksFormat::withTrashed()->where('id', $request->id)->first();
        return view('admin.layout.edit.admin-edit-format', ['data' => $data]);
    }
    //Translator 
    public function translator_view()
    {
        $data = Translator::all()->load([
            'books.thumb',
            'books.category',
            'books.tags',
            'books.format',
            'books.series',
            'books.publisher',
            'books.supplier',
            'books.translator',
            'books.lang',
            'books.author'
        ]);
        return view('admin.layout.show.admin-translator', ['data' => $data]);
    }
    public function translator_old_view()
    {
        $data = Translator::onlyTrashed()->with([
            'books.thumb',
            'books.category',
            'books.tags',
            'books.format',
            'books.series',
            'books.publisher',
            'books.supplier',
            'books.translator',
            'books.lang',
            'books.author'
        ])->get();
        return view('admin.layout.show.old.admin-translator', ['data' => $data]);
    }
    public function translator_add_view()
    {
        return view('admin.layout.add.admin-add-translator');
    }
    public function translator_edit_view(Request $request)
    {
        $data = Translator::withTrashed()->where('id', $request->id)->first();
        return view('admin.layout.edit.admin-edit-translator', ['data' => $data]);
    }
    //Orders
    public function orders_ongoing_show()
    {
        return view('admin.layout.show.admin-order-ongoing');
    }
    public function orders_complete_show()
    {
        return view('admin.layout.show.admin-order-complete');
    }
    public function orders_old_view()
    {
        return view('admin.layout.show.old.admin-order');
    }
    //User
    public function user_list_view()
    {
        $user = UserModel::where('level', 'user')->get()->load('address.get_city', 'address.get_wards', 'address.get_districts', 'phone');
        $guest = Guest::all()->load('address.get_city', 'address.get_wards', 'address.get_districts');
        return view('admin.layout.show.admin-user-list', ['users' => $user, 'guest' => $guest]);
    }
    public function add_user()
    {
        return view('admin.layout.add.add-user');
    }

    public function account_old_view()
    {
        $user = UserModel::onlyTrashed()->where('level', 'user')->get()->load('address.get_city', 'address.get_wards', 'address.get_districts', 'phone');
        $guest = Guest::onlyTrashed()->with('address.get_city', 'address.get_wards', 'address.get_districts')->get();
        return view('admin.layout.show.old.admin-user-list', ['guest' => $guest, 'users' => $user]);
    }
    public function show_admin()
    {
        $admin = UserModel::where('level', 'admin')->with('address.get_city', 'address.get_wards', 'address.get_districts', 'phone')->get();
        return view('admin.layout.show.admin-list', ['users' => $admin]);
    }
    public function show_old_admin()
    {
        $admin = UserModel::onlyTrashed()->where('level', 'admin')->with('address.get_city', 'address.get_wards', 'address.get_districts', 'phone')->get();
        return view('admin.layout.show.old.admin-list', ['users' => $admin]);
    }
    //Rating
    public function show_list_rating()
    {
        $data = Rating::all()->load('book', 'user');
        return \view('admin.layout.show.admin-user-rating', ['data' => $data]);
    }
}
