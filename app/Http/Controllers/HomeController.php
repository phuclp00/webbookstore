<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\SilderController;
use App\Http\Controllers\Product\CategoryController;
use App\Models\Author;
use App\Models\BookSeries;
use App\Models\BooksFormat;
use App\Models\CategoryModel;
use App\Models\ProductModel;
use App\Models\BookThumbnailModel;
use App\Models\BookType;
use App\Models\Language;
use App\Models\PublisherModel;
use App\Models\Series;
use App\Models\SupplierModel;
use App\Models\Translator;
use App\Models\UserModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use ListLanguages;

class HomeController extends Controller
{

    private $subpatchViewController = '.page';
    private $pathViewController = 'public.';
    public function __construct()
    {
        $slide_items = (new SilderController)->slide_homepage();
        $list_items_product = (new ShopController)->all_list_view();
        $list_items_categoy = (new CategoryController)->list_category();
        $top_item_category = (new CategoryController)->top_list_category();
        $pagi_list_product = (new ShopController)->paginate_list_view();
        //$list_get_category=(new CategoryController)->get_category();
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
        return view($this->pathViewController . $this->subpatchViewController . '.faq');
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
        return view($this->pathViewController . $this->subpatchViewController  . '.shop');
    }
    public function get_list_id(Request $request)
    {
        $items = $request->id;
        $items = ProductModel::with('category')->where("cat_id", "=", $items);
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
        $id = $request->cat_id;
        $mainModel = new CategoryModel();

        //Truy xuat theo dieu kien trong Model()

        //$items=$mainModel->listItems("cat_id",['task'=>"special-list-items"],$id,"===");

        //Truy xuat theo relationship
        $items = ProductModel::with('category')->where("cat_id", "=", $id)->paginate(6);

        return view($this->pathViewController . $this->subpatchViewController  . '.shop', ["get_cat_items" => $items]);
    }

    public function product_view()
    {
        return view($this->pathViewController . $this->subpatchViewController  . '.single-product');
    }
    public function error_view()
    {
        return view('errors.error404');
    }
    public function contact_view()
    {
        return view($this->pathViewController . $this->subpatchViewController  . '.contact');
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
    public function dash_view()
    {
        return view('admin.layout.show.admin-dashboard');
    }
    //Category
    public function category_view()
    {
        $result = CategoryModel::all()->load('childrent');
        return view('admin.layout.show.admin-category', ['cat_list' => $result]);
    }
    public function category_old_view()
    {
        $result = CategoryModel::where('parent_id', null)->onlyTrashed()->with('books')->with('types')->get();
        return view('admin.layout.show.old.admin-category', ['cat_list' => $result]);
    }
    public function category_add_view(Request $request)
    {
        $type = BookType::all();
        return view('admin.layout.add.admin-add-category', ['type' => $type]);
    }
    public function category_edit_view(Request $request)
    {
        $result = CategoryModel::withTrashed()->where('cat_id', $request->cat_id)->first();
        $type = BookType::all();
        return view('admin.layout.edit.admin-edit-category', ['category' => $result, 'type' => $type]);
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
            ->load('format')
            ->load('lang');
        dd($result[0]->category);
        return view('admin.layout.show.admin-books', ['book' => $result]);
    }
    public function book_list_out_of_business()
    {
        $result = ProductModel::onlyTrashed()
            ->with('thumb')
            ->with('publisher')
            ->with('author')
            ->with('translator')
            ->with('lang')
            ->with('series')
            ->with('format')
            ->get();

        return view('admin.layout.show.old.admin-books', ['book' => $result]);
    }
    public function book_list_add_view()
    {
        $cat = CategoryModel::all();
        $pub = PublisherModel::all();
        $auth = Author::all();
        $format = BooksFormat::all();
        $lang = ListLanguages::lookup();
        $translator = Translator::all();
        $series = BookSeries::all();
        return view(
            'admin.layout.add.admin-add-book',
            [
                'cat' => $cat,
                'pub' => $pub,
                'auth' => $auth,
                'format' => $format,
                'language' => $lang,
                'translator' => $translator,
                'series' => $series,
            ]
        );
    }
    public function book_edit_view(Request $request)
    {
        $cat = CategoryModel::all();
        $pub = PublisherModel::all();
        $auth = Author::all();
        $format = BooksFormat::all();
        $lang = ListLanguages::lookup();
        $translator = Translator::all();
        $series = BookSeries::all();
        $result = ProductModel::withTrashed()->where('book_id', $request->book_id)->first();
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
                'format' => $format,
                'language' => $lang,
                'translator' => $translator,
                'height' => $height,
                'width' => $width,
                'series' => $series,
            ]
        );
    }
    //Publisher 
    public function publisher_view(Request $request)
    {
        $result = PublisherModel::all()->load('books.thumb');
        return view('admin.layout.show.admin-publisher', ['pub_list' => $result]);
    }
    public function publisher_old_view(Request $request)
    {
        $result = PublisherModel::onlyTrashed()->with('books')->get();
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
        $result = SupplierModel::all()->load('books.thumb');
        return view('admin.layout.show.admin-supplier', ['sub_list' => $result]);
    }
    public function supplier_old_view(Request $request)
    {
        $result = SupplierModel::onlyTrashed()->with('books')->get();
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
        $data = Author::all()->load('books');
        return view('admin.layout.show.admin-author', ['data' => $data]);
    }
    public function author_old_view()
    {
        $data = Author::onlyTrashed()->with('books')->get();
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
        $data = BookSeries::all()->load('books');
        return view('admin.layout.show.admin-series', ['data' => $data]);
    }
    public function series_old_view()
    {
        $data = BookSeries::onlyTrashed()->with('books')->get();
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
    //Format 
    public function format_view()
    {
        $data = BooksFormat::all()->load('books');
        return view('admin.layout.show.admin-format', ['data' => $data]);
    }
    public function format_old_view()
    {
        $data = BooksFormat::onlyTrashed()->with('books')->get();
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
    }  //Book Type 
    public function type_view()
    {
        $data = BookType::all()->load('category');
        return view('admin.layout.show.admin-type', ['data' => $data]);
    }
    public function type_old_view()
    {
        $data = BookType::onlyTrashed()->with('category')->get();
        return view('admin.layout.show.old.admin-type', ['data' => $data]);
    }
    public function type_add_view()
    {
        return view('admin.layout.add.admin-add-type');
    }
    public function type_edit_view(Request $request)
    {
        $data = BookType::withTrashed()->where('id', $request->id)->first();
        return view('admin.layout.edit.admin-edit-type', ['data' => $data]);
    }
    //Translator 
    public function translator_view()
    {
        $data = Translator::all()->load('books');
        return view('admin.layout.show.admin-translator', ['data' => $data]);
    }
    public function translator_old_view()
    {
        $data = Translator::onlyTrashed()->with('books')->get();
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
    //User
    public function user_list_view()
    {
        $result = UserModel::with('user_detail')->get();
        return view('admin.layout.show.admin-user-list', ['users' => $result]);
    }
    public function add_user()
    {
        return view('admin.layout.add.add-user');
    }
}
