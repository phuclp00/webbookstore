<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Detail;
use App\Http\Controllers\SilderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Models\CategoryModel;
use App\Models\ProductModel;
use App\Cart;
use App\Models\Book_list_view;
use App\Models\BookThumbnailModel;
use App\Models\PublisherModel;
use App\Models\Show_info_user;
use App\Models\UserModel;
use Illuminate\Support\Facades\Session as FacadesSession;
use Session;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */


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
    public function get_items(Request $request)
    {
        $id = $request->id;
        $cat_id = $request->cat_id;
        $result = Book_list_view::where('book_id', $id)->first();
        $arr_thumb = array();
        $i = 1;
        while ($i < 8) {
            $arr_thumb[] = $result["thumb$i"] == null ? null : $result["thumb$i"];
            $i++;
        }
        return view('public.page.single-product', [
            "get_singel_product" => $result,
            "thumb" => $arr_thumb,
        ]);
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
    public function checkout_view()
    {
        if (session()->has('user_info')) {
            return view($this->pathViewController . $this->subpatchViewController  . '.checkout');
        } else {
            return view('public.page.my-account');
        }
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
        if(Auth::check()==true){
            return \redirect()->back();
        }
        else{
            return view('admin.login.sign-in');

        }
    }
    public function register_view()
    {
        return view('admin.login.sign-up');
    }
    public function dash_view()
    {
        return view('admin.layout.admin-dashboard');
    }
    //Category
    public function category_view()
    {
        $result = CategoryModel::paginate(6);
        return view('admin.layout.admin-category', ['cat_list' => $result]);
    }
    public function category_add_view(Request $request)
    {
        return view('admin.layout.add.admin-add-category');
    }
    public function category_edit_view(Request $request)
    {
        $result = CategoryModel::find($request->cat_id);

        return view('admin.layout.edit.admin-edit-category', ['category' => $result]);
    }
    //Book
    public function book_list_view()
    {
        $result = Book_list_view::paginate(5);
        return view('admin.layout.admin-books', ['book' => $result]);
    }
    public function book_list_add_view(Request $request)
    {
        $cat = CategoryModel::all();
        $pub = PublisherModel::all();
        return view('admin.layout.add.admin-add-book', ['cat' => $cat, 'pub' => $pub]);
    }
    public function book_edit_view(Request $request)
    {
        $cat = CategoryModel::all();
        $pub = PublisherModel::all();
        $result = ProductModel::find($request->book_id);
        $thumb = BookThumbnailModel::find($request->book_id);
        $old_thumb = null;
        if ($thumb != null) {
            $i = 1;
            while ($i <= 7) {
                $old_thumb[] = $thumb["thumbnail_$i"] == null ? null : $thumb["thumbnail_$i"];
                $i++;
            }
        }
        return view('admin.layout.edit.admin-edit-book', ['book' => $result, 'cat' => $cat, 'pub' => $pub, 'old_thumb' => $old_thumb]);
    }
    //Publisher 
    public function publisher_view()
    {
        $result = PublisherModel::paginate(6);
        return view('admin.layout.admin-publisher', ['pub_list' => $result]);
    }
    public function add_publisher_view()
    {
        return view('admin.layout.add.admin-add-publisher');
    }
    public function edit_publisher_view(Request $request)
    {
        $result = PublisherModel::find($request->pub_id);
        return view('admin.layout.edit.admin-edit-publisher', ['publisher' => $result]);
    }
    //User
    public function user_list_view()
    {
        $result= UserModel::with('user_detail')->get();
        return view('admin.layout.admin-user-list',['users'=>$result]);
    }
    public function add_user()
    {
        return view('admin.layout.add.add-user');
    }
}
