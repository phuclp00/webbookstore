<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Store\FileuploadController;
use App\Http\Controllers\Store\ImagesController;
use App\Http\Requests\Product\Product_Update;
use App\Http\Requests\Product\ProductRequest;
use App\Models\Author;
use App\Models\BookSeries;
use App\Models\BooksFormat;
use App\Models\BookType;
use App\Models\BookThumbnailModel;
use Illuminate\Http\Request;
use App\Models\ProductModel;
use App\Models\PublisherModel;
use App\Models\Translator;
use Carbon\Carbon;
use Cart;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use  Illuminate\Support\Facades\Storage;
use Image;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{

    public function index()
    {
        $data = ProductModel::all();
        $result_filter = $data->filter(function ($key, $value) {
            if ($key->series()->exists()) {
                return $key->book_name = $key->book_id . ': ' . $key->book_name . ' - Episode ' . $key->episode;
            } else {
                return $key->book_name = $key->book_id . ': ' . $key->book_name;
            }
        });
        return  $result_filter->pluck('book_name');
    }
    public function show(Request $request)
    {
        return  ProductModel::find($request->id);
    }
    public function add_to_cart(Request $request)
    {

        $id_item = $request->id;
        $item = ProductModel::find($id_item);
        $data['id'] = $item->book_id;
        $data['qty'] = 1;
        $data['name'] = $item->book_name;
        $data['price'] = $item->price;
        $data['options']['image'] = $item->img;
        $data['id'] = $item->book_id;
        $data['weight'] = 25;
        Cart::add($data);
        return \redirect()->back();
    }
    public function add_cart_ajax(Request $request)
    {
        $id_item = $request->book_id;
        $qty_item = $request->qty;
        try {
            $item = ProductModel::find($id_item);
            $data['id'] = $item->book_id;
            $data['qty'] = $qty_item;
            $data['name'] = $item->book_name;
            $data['price'] = $item->price;
            $data['options']['image'] = $item->img;
            $data['id'] = $item->book_id;
            $data['weight'] = 25;
            Cart::add($data);
        } catch (Exception $e) {
            return view('error');
        }
    }
    //UPDATE AND DESTROY
    public function update_cart(Request $request)
    {
        $rowId = $request->cart_rowId;
        $qty   = $request->cart_quantity;
        if (isset($request->remove_cart)) {
            Cart::update($rowId, 0);

            return redirect()->back();
        }
        if (isset($request->update_cart)) {

            Cart::update($rowId, $qty);
            return redirect('/cart/show-cart');
        }
    }
    public function cart_view()
    {
        return view('public.page.cart');
    }
    public function find_product(Request $request)
    {
        $key_find = $request->key_word;
        $list_search = ProductModel::with('category')->with('publisher')->where('book_name', '=', $key_find)
            ->orwhere('cate', 'like', '%' . $key_find . '%')
            ->orWhere('description', 'like', '%' . $key_find . '%')
            ->paginate(6);

        if ($list_search != "") {
            return view($this->pathViewController . $this->subpatchViewController . '.shop', [
                "list_search" => $list_search,
                "get_cat_items" => $get_cat_items = null,
                "pagi_list_items" => $pagi_list_items = null
            ]);
        } else {
            return view('errors.error404');
        }
    }
    //================================================================ ADMIN  =================================================================//

    public function add(ProductRequest  $request)
    {
        $author = null;
        $format = null;
        $translator = null;
        $series = null;
        try {
            DB::beginTransaction();
            // declare parameters
            $file =  new ImagesController(450, 565, $request->book_id);
            $thumb = new ImagesController(450, 565, "$request->book_id/thumb");
            //Check author from requet 
            if ($request->author == null) {
                $author = Author::create([
                    'name' => $request->new_author,
                    'description' => "New author has been created by " . Auth::user()->user_name,
                    'created_by' => Auth::user()->user_name
                ])->id;
            } else {
                $author = $request->author;
            }
            //Check format from requet 
            if ($request->format == null) {
                $format = BooksFormat::create([
                    'name' => $request->new_format,
                    'description' => " New format has been created by " . Auth::user()->user_name,
                    'created_by' => Auth::user()->user_name
                ])->id;
            } else {
                $format = $request->format;
            }
            //Check translator from requet 
            if ($request->translator == null && $request->new_translator != null) {
                $translator = Translator::create([
                    'name' => $request->new_translator,
                    'about' => "New translator has been created by " . Auth::user()->user_name,
                    'created_by' => Auth::user()->user_name
                ])->id;
            } else {
                $translator = $request->translator;
            }
            //Check series from requet 
            if ($request->series == null && $request->new_series != null) {
                $series = BookSeries::create([
                    'name' => $request->new_series,
                    'about' => "New translator has been created by " . Auth::user()->user_name,
                    'created_by' => Auth::user()->user_name
                ])->id;
            } else {
                $series = $request->series;
            }
            if ($series && $request->episode != null) {
                $data = ProductModel::where(['series' => $series, 'episode' => $request->episode])->first();
                if ($data != null) {
                    return \redirect()->back()->withInput($request->all())->withErrors('Already have this episode in book store !');
                }
            }
            if (date('Y', \strtotime($request->date_published)) < $request->copyright) {
                return \redirect()->back()->withInput($request->all())->withErrors('Date published cannot be less than the CopyrightYear !');
            }

            //Book insert
            $product = ProductModel::create([
                'book_id' => $request->book_id,
                'book_name' => $request->book_name,
                'cat_id' => $request->cat_id,
                'pub_id' => $request->pub_id,
                'series' => $series,
                'episode' => $request->episode,
                'size' => $request->size_height . ' x ' . $request->size_width . ' cm',
                'weight' => $request->weight,
                'datePublished' => $request->date_published,
                'copyrightYear' => $request->copyright,
                'bookFormat' => $format,
                'translator' => $translator,
                'serialNumber' => $request->code,
                'out_of_business' => 0,
                'numberOfPages' => $request->page_number,
                'language' => $request->language,
                'price' => $request->price,
                'sup_id' => $request->sup_id,
                'promotion_id' => $request->promotion,
                'total' => $request->total,
                'description' => $request->content,
                //Upload images
                'img' => $request->img != null ? $file->store($request->img) : null,
                'created_by' => Auth::user()->user_name,
            ]);
            //Insert related author
            foreach ($request->author as $value) {
                $result = Author::where('name', $value)->first()->id;
                $product->author()->attach($result);
            }
            //Thumb insert 
            if ($request->thumb != null) {
                foreach ($request->thumb as $key => $value) {
                    BookThumbnailModel::create(
                        [
                            'book_id' => $request->book_id,
                            'image' => $thumb->store($value),
                            'description' => $product->book_name,
                            'created_by' => Auth::user()->user_name,
                            'modified_by' => Auth::user()->user_name
                        ]
                    );
                }
            }
            DB::commit();
            //Insert author related

            $request->session()->flash(
                'infor_success',
                '<div class="alert alert-primary" style="text-align: center;font-size: x-large;font-family: fangsong;"> 
                    Add ' . $request->book_name . ' Successfully !! 
                </div>'
            );
            return redirect()->back();
        } catch (QueryException $e) {
            DB::rollBack();
            $request->session()->flash(
                'info_warning',
                '<div class="alert alert-danger" style="text-align: center;font-size: x-large;font-family: fangsong;">
                    Add ' . $request->book_name . ' Failed with error : </br> ' . $e->getMessage() . '</br> Try Again !!
                   </div>'
            );
            return redirect()->back();
        }
    }
    public function update(Product_Update $request)
    {

        $page = $request->page;
        $author = null;
        $format = null;
        $translator = null;
        $series = null;
        $flag = true;

        try {
            DB::beginTransaction();
            $data = ProductModel::find($request->book_id)->load('thumb');
            $file =  new ImagesController(450, 565, $data->book_id);
            $thumb = new ImagesController(450, 565, "$data->book_id/thumb");
            //Check author from requet 
            if ($request->author == null) {
                $author = Author::create([
                    'name' => $request->new_author,
                    'description' => "New author has been created by " . Auth::user()->user_name,
                    'created_by' => Auth::user()->user_name
                ])->id;
            } else {
                $author = $request->author;
            }
            //Check format from requet 
            if ($request->format == null) {
                $format = BooksFormat::create([
                    'name' => $request->new_format,
                    'description' => " New format has been created by " . Auth::user()->user_name,
                    'created_by' => Auth::user()->user_name
                ])->id;
            } else {
                $format = $request->format;
            }
            //Check series from requet 
            if ($request->series == null && $request->new_series != null) {
                $series = BookSeries::create([
                    'name' => $request->new_series,
                    'about' => "New translator has been created by " . Auth::user()->user_name,
                    'created_by' => Auth::user()->user_name
                ])->id;
            } else {
                $series = $request->series;
            }

            //Book update
            $check_episode = ProductModel::where(['series' => $series, 'episode' => $request->episode])->first();
            if ($check_episode != null && $check_episode->episode != $data->episode) {
                return \redirect()->back()->withErrors('Already have this episode in book store !');
            }
            $data->book_name = $request->book_name;
            $data->cat_id = $request->cat_id;
            $data->pub_id = $request->pub_id;
            $data->series = $series;
            $data->episode = $request->episode;
            $data->size = $request->size_height . ' x ' . $request->size_width . ' cm';
            $data->weight = $request->weight;
            $data->datePublished = $request->date_published;
            $data->copyrightYear = $request->copyright;
            $data->bookFormat = $format;
            $data->sup_id = $request->sup_id;
            $data->serialNumber = $request->code;
            $data->numberOfPages = $request->page_number;
            $data->language = $request->language;
            $data->price = $request->price;
            $data->promotion_id = $request->promotion;
            $data->total = $request->total;
            $data->description = $request->content;
            $data->modified_by = Auth::user()->user_name;
            //Asyn author
            $aut_check = [];
            foreach ($data->author as $value) {
                $aut_check[] = $value->name;
            }
            $flag_auth = $request->author == $aut_check ? true : false;
            if ($flag_auth == false) {
                foreach ($request->author as $value) {
                    $result[] = Author::where('name', $value)->first()->id;
                }
                $data->author()->sync($result);
            }
            //Asyn translator 
            $trans_check = [];
            foreach ($data->translator as $value) {
                $trans_check[] = $value->name;
            }
            $flag_trans = $request->translator == $trans_check ? true : false;
            if ($flag_trans == false) {
                foreach ($request->translator as $value) {
                    $result[] = Translator::where('name', $value)->first()->id;
                }
                $data->translator()->sync($result);
            }
            // Check file upload 
            $check_img_upload = $request->img != null ? true : false;
            $check_thumb_upload = $request->thumb != null ? true : false;
            //Upload images
            if ($check_img_upload) {
                //Book image update
                $result = $file->update($request->img, $data->img);
                $data->img = $result;
            }

            if ($check_thumb_upload) {
                //Check book_thumb d
                if ($data->thumb()->exists() == false) {
                    //Thumb insert 
                    foreach ($request->thumb as $key => $value) {
                        BookThumbnailModel::create(
                            [
                                'book_id' => $data->book_id,
                                'image' => $thumb->store($value),
                                'description' => $data->book_name,
                                'created_by' => Auth::user()->user_name,
                                'modified_by' => Auth::user()->user_name
                            ]
                        );
                    }
                } else {
                    $data->thumb()->delete();
                    $thumb->destroy();
                    foreach ($request->thumb as $key => $value) {
                        BookThumbnailModel::create(
                            [
                                'book_id' => $data->book_id,
                                'image' => $thumb->store($value),
                                'description' => $data->book_name,
                                'created_by' => Auth::user()->user_name,
                                'modified_by' => Auth::user()->user_name
                            ]
                        );
                    }
                }
            }
            if ($data->isDirty() == false && $flag_trans == true && $flag_auth == true) {
                $request->session()->flash(
                    'infor_mess',
                    '<div class="alert alert-primary" style="text-align: center;font-size: x-large;font-family: fangsong;"> 
                        You have yet to update the information for "' . $data->getOriginal('book_name') . '" ! 
                        </br>
                        Please check it or return back if you dont want to update this book ! 
                    </div>'
                );
                DB::rollBack();
                return redirect()->back();
            }

            $request->session()->flash(
                'infor_success',
                '<div class="alert alert-success" style="text-align: center;font-size: x-large;font-family: fangsong;"> 
                    Update ' . $request->book_name . ' Successfully !! 
                </div>'
            );
            $data->save();
            DB::commit();
            return redirect()->route('admin.books');
        } catch (QueryException $e) {
            $request->session()->flash(
                'infor_warning',
                '<div class="alert alert-danger" style="text-align: center;font-size: x-large;font-family: fangsong;"> 
                    Update ' . $request->book_name . ' failed with error : </br> ' . $e->getMessage() . '</br> Try Again !!
                </div>'
            );
            DB::rollBack();
            return \redirect()->back();
        }
    }
    public function remove(Request $request)
    {
        try {
            $file =  new ImagesController(450, 565, $request->book_id);
            $data = ProductModel::withTrashed()->where('book_id', $request->book_id)->with('rating')->first();
            if ($data->order_detail()->exists() == false && $data->rating()->count() == 0 && $data->favorite()->count() == 0) {
                $data->thumb()->forceDelete();
                $file->destroy();
                $data->forceDelete();
                $request->session()->flash('infor_success', '<div class="alert alert-success" style="text-align: center;font-size: x-large;font-family: fangsong;"> Remove ' . $request->book_name . ' Successfully !! </div>');
                return redirect()->back();
            } else {
                $data->out_of_business = 1;
                $data->deleted_by = Auth::user()->user_name;
                $data->save();
                $data->delete();
                $request->session()->flash('infor_success', '<div class="alert alert-success" style="text-align: center;font-size: x-large;font-family: fangsong;"> The book ' . $request->book_name . 'can not be removed , but this will be moved to " Product Is Out Of Business" category !! </div>');
            }
            return redirect()->back();
        } catch (\Throwable $th) {
            $request->session()->flash('info_warning', '<div class="alert alert-danger" style="text-align: center;font-size: x-large;font-family: fangsong;"> Remove ' . $request->book_name . ' Failed with error : </br> ' . $th->getMessage() . '</br> Try Again !! </div>');
            return redirect()->back();
        }
    }
    public function sale(Request $request)
    {
        try {
            $data = ProductModel::withTrashed()->where('book_id', $request->book_id)->first();
            $data->out_of_business = 0;
            $data->deleted_by = null;
            $data->save();
            $data->restore();
            $request->session()->flash('infor_success', '<div class="alert alert-success" style="text-align: center;font-size: x-large;font-family: fangsong;"> Product ' . $request->book_name . ' Are On Sale !! </div>');
            return redirect()->back();
        } catch (\Throwable $th) {
            $request->session()->flash('infor_warning', '<div class="alert alert-danger" style="text-align: center;font-size: x-large;font-family: fangsong;"> Seting for ' . $request->book_name . ' Fail,Try Again !! ' . $th->getMessage() . '</div>');
            return redirect()->back();
        }
    }
    public function stop_selling(Request $request)
    {
        try {
            $data = ProductModel::find($request->book_id);
            $data->out_of_business = 1;
            $data->deleted_by = Auth::user()->user_name;
            $data->save();
            $data->delete();
            $request->session()->flash('infor_success', '<div class="alert alert-success" style="text-align: center;font-size: x-large;font-family: fangsong;">Stop selling product ' . $request->book_name . ' successfully !! </div>');
        } catch (\Throwable $th) {
            $request->session()->flash('info_warning', '<div class="alert alert-danger" style="text-align: center;font-size: x-large;font-family: fangsong;"> Stop selling product ' . $request->book_name . ' failed with error : </br>' . $th->getMessage() . ' </br> Try Again  !!  </div>');
        } finally {
            return redirect()->back();
        }
    }
}
