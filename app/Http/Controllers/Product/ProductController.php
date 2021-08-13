<?php

namespace App\Http\Controllers\Product;

use App\Events\RatingProduct;
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
use App\Models\CategoryModel;
use Illuminate\Http\Request;
use App\Models\ProductModel;
use App\Models\PublisherModel;
use App\Models\TagsModel;
use App\Models\Translator;
use Carbon\Carbon;
use Cart;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class ProductController extends Controller
{
    //================================================================ CLIENT  =================================================================//

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
    public function features_product()
    {
        return Cache::remember('product.features', \now()->addHours(1), function () {
            return ProductModel::where('promotion_id', '!=', null)->get();
        });
    }

    public function check_quantity(Request $request)
    {
        $quantity = $request->quantity;
        $book = ProductModel::find($request->book);
        if ($book) {
            if ($book->total >= $quantity) {
                return \response(["status" => "success", "mess" => "Thêm vào giỏ hàng thành công !"]);
            } else {
                return \response([
                    "status" => "danger",
                    "mess" => "Số lượng hiện tại của sản phẩm '" . $book->book_name . "' trong hệ thống không đủ, số lượng khả dụng hiện tại của sản phẩm là : $book->total Mọi chi tiết xin vui lòng liên hệ bộ phận CSKH để được hỗ trợ !"
                ]);
            }
        } else {
            return \response([
                "status" => "danger",
                "mess" => "Không tìm thấy sản phẩm !"
            ]);
        }
    }
    public function rating(Request $request)
    {
        try {
            DB::beginTransaction();
            $user = Auth::user();
            $book = ProductModel::find($request->id);
            $user->rating()->attach(
                $request->id,
                [
                    'title' => $request->title,
                    'rating' => $request->rating,
                    'comment' => $request->mess
                ]
            );
            DB::commit();
            event(new RatingProduct($book, $user));
            return \response([
                'status' => "sucess",
                'mess' => "Đăng bài đánh giá thành công"
            ]);
        } catch (\Throwable $th) {
            DB::rollback();
            return \response([
                'status' => "danger",
                'mess' => "Đăng bài đánh giá thất bại"
            ]);
        }
    }
    public function flash_sale()
    {
        Cache::remember('product.flashsale', now()->addHours(1), function () {
            return ProductModel::where('promotion_id', 2)->with(['author', 'promotion'])->get();
        });
    }
    public function product_related_cart(Request $request)
    {
        $list_related =  new Collection();
        foreach ($request->cart as $key => $value) {
            $data = ProductModel::where('book_id', $value["book_id"])->with('author', 'promotion')->first();
            if ($data->series()->exists()) {
                $series = BookSeries::where('id', $data->series)->with('books')->first();
                foreach ($series->books as $value) {
                    $list_related->push($value);
                }
            }
            if ($data->author()->exists()) {
                foreach ($data->author as $key => $auth) {
                    $author = Author::where('id', $auth->id)->with('books.author', 'books.promotion')->first();
                    foreach ($author->books as  $value) {
                        $list_related->push($value);
                    }
                }
            }
            if ($data->category()->exists()) {
                $category = CategoryModel::where('id', $data->category->id)->with('ancestors.books', 'descendants.books', 'books')->get();
                foreach ($category as $value) {
                    foreach ($value->books as $cat_book) {
                        $list_related->push($cat_book);
                    }
                    if ($value->descendants == null) {
                        foreach ($value->ancestors as  $parent) {
                            if ($parent->books->count() > 0) {
                                foreach ($parent->books as  $item) {
                                    $list_related->push($item);
                                }
                            }
                        }
                    } else {
                        foreach ($value->descendants  as  $children) {
                            if ($children->books->count() > 0) {
                                foreach ($$children->books as $value) {
                                    $list_related->push($value);
                                }
                            }
                        }
                    }
                }
            }
            if ($data->publisher()->exists()) {
                $publisher = PublisherModel::where('id', $data->publisher->id)->with('books.author', 'books.promotion')->first();
                foreach ($publisher->books as $value) {
                    $list_related->push($value);
                }
            }
            if ($data->tags()->exists()) {
                $tags = TagsModel::find($data->tags->tag_id)->with('books.author', 'books.promotion')->first();
                foreach ($tags as  $value) {
                    foreach ($value->books as $book) {
                        $list_related->push($book);
                    }
                }
            }
        }
        return   $list_related->unique('book_id')->values()->all();
    }
    //================================================================ ADMIN  =================================================================//

    public function add(ProductRequest  $request)
    {
        try {
            //code...

            DB::beginTransaction();
            $series = null;
            // declare parameters
            $file =  new ImagesController(450, 565, $request->book_id);
            $thumb = new ImagesController(450, 565, "$request->book_id/thumb");
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
                'serialNumber' => $request->code,
                'cat_id' => $request->cat_id,
                'pub_id' => $request->pub_id,
                'sup_id' => $request->sup_id,
                'series' => $series,
                'episode' => $request->episode,
                'size' => $request->size_height . ' x ' . $request->size_width . ' cm',
                'weight' => $request->weight,
                'datePublished' => $request->date_published,
                'copyrightYear' => $request->copyright,
                'bookFormat' => $request->format,
                'out_of_business' => 0,
                'numberOfPages' => $request->page_number,
                'language' => $request->language,
                'price' => $request->price,
                'promotion_id' => $request->promotion,
                'total' => $request->total,
                'description' => $request->content,
                //Upload images
                'created_by' => Auth::user()->user_name,
            ]);
            //Insert author
            if ($request->author) {
                foreach ($request->author as $value) {
                    if ($value) {
                        $result = Author::where('name', $value)->first()->id;
                        $product->author()->attach($result);
                    }
                }
            }
            //Insert translator
            if ($request->translator) {
                foreach ($request->translator as $value) {
                    if ($value) {
                        $result = Translator::where('name', $value)->first()->id;
                        $product->translator()->attach($result);
                    }
                }
            }
            DB::commit();
            //Insert image
            if ($request->img != null) {
                $product->img = $file->store($request->img);
                $product->save();
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
            //Insert author related
            $request->session()->flash(
                'infor_success',
                '<div class="alert alert-primary" style="text-align: center;font-size: x-large;font-family: fangsong;"> 
                    Add ' . $request->book_name . ' Successfully !! 
                </div>'
            );
            return redirect()->back();
        } catch (\Throwable $th) {
            DB::rollBack();
            $request->session()->flash(
                'infor_warning',
                '<div class="alert alert-danger" style="text-align: center;font-size: x-large;font-family: fangsong;"> 
                    Update ' . $request->book_name . ' failed with error : </br> ' . $th->getMessage() . '</br> Try Again !!
                </div>'
            );
            return back();
        }
    }
    public function update(Product_Update $request)
    {
        $format = null;
        $series = null;
        try {
            DB::beginTransaction();
            $data = ProductModel::find($request->book_id)->load('thumb');
            $duplicate = ProductModel::where('book_name', $request->book_name)->first();
            if ($duplicate != null && $duplicate->book_id != $data->book_id) {
                $request->session()->flash(
                    'infor_warning',
                    '<div class="alert alert-primary" style="text-align: center;font-size: x-large;font-family: fangsong;"> 
                    Already have this book name in store !
                </div>'
                );
                return redirect()->back();
            };
            if ($data == null) {
                $request->session()->flash(
                    'infor_warning',
                    '<div class="alert alert-primary" style="text-align: center;font-size: x-large;font-family: fangsong;"> 
                        The book not found in the store , check your book id !
                </div>'
                );
                return redirect()->back();
            }
            $file =  new ImagesController(450, 565, $data->book_id);
            $thumb = new ImagesController(450, 565, "$data->book_id/thumb");
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
                return \redirect()->back()->withErrors('Already have this episode in the book store !');
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
            $data->bookFormat = $request->format;
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
            if ($request->author) {
                $aut_check = [];
                foreach ($data->author as $value) {
                    $aut_check[] = $value->name;
                }
                $flag_auth = $request->author == $aut_check ? true : false;
                if (count($aut_check) > 0) {
                    foreach ($request->author as $value) {
                        $result[] = Author::where('name', $value)->first()->id;
                        $data->author()->sync($result);
                    }
                }
            }
            if ($request->translator) {
                //Asyn translator 
                $trans_check = [];
                foreach ($data->translator as $value) {
                    $trans_check[] = $value->name;
                }
                $flag_trans = $request->translator == $trans_check ? true : false;
                if (count($trans_check) > 0) {
                    foreach ($request->translator as $value) {
                        $result[] = Translator::where('name', $value)->first()->id;
                    }
                    $data->translator()->sync($result);
                }
            } else $flag_trans = true;
            $data->save();
            DB::commit();
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
