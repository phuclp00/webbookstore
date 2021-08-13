<?php

namespace App\Models;

use App\Models\DB;
use App\Models\Language;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Redis;
use Laravel\Scout\Searchable;
use BeyondCode\Vouchers\Traits\HasVouchers;
use Stripe\Product;

class ProductModel extends Model
{
    use HasFactory, Searchable, SoftDeletes, HasVouchers;
    //DEFINED DATABASE TABLE
    protected $table = "book";
    public  $primaryKey = "book_id";
    const UPDATED_AT = 'modified_at';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'book_id',
        'book_name',
        'description',
        'size',
        'img',
        'pub_id',
        'cat_id',
        'sup_id',
        'weight',
        'series',
        'episode',
        'price',
        'promotion_id',
        'out_of_business',
        'datePublished',
        'copyrightYear',
        'bookFormat',
        'serialNumber',
        'numberOfPages',
        'language',
        'total',
        'created_by',
        'deleted_by',
        'modified_by',
    ];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'modified_at' => 'datetime',
        'created_at'  => 'datetime',
        'date_published' => 'date',
        'deleted_at' => 'datetime'
    ];
    //protected $touches = ['author', 'category', 'publisher', 'format', 'supplier', 'series', 'translator', 'tags', 'promotion', 'rating'];

    public function searchableAs()
    {
        return 'book';
    }
    public function getRouteKeyName()
    {
        return 'book_id';
    }
    public function getScoutKey()
    {
        return $this->book_id;
    }
    public function isPublished()
    {
        return $this->created_at !== null;
    }
    public function shouldBeSearchable()
    {
        return $this->isPublished();
    }
    public function toSearchableArray()
    {
        $array = $this->toArray();
        $array['categories']['level10'] = '';
        foreach (CategoryModel::defaultOrder()->ancestorsAndSelf($this->cat_id) as $key => $value) {
            if ($key == 0) {
                $array['categories']['level10'] = $value->name;;
            } else {
                $first = $key - 1;
                $last = $key;
                $array['categories']['level1' . $last] = $array['categories']['level1' . $first] . " > " . $value->name;
            }
        }
        $array['author'] = $this->author->map(function ($data) {
            return $data["name"];
        })->toArray();
        $array['publisher'] = $this->publisher ? $this->publisher->name : "";
        $array['format'] = $this->format ? $this->format->name : "";
        $array['supplier'] = $this->supplier ? $this->supplier->name : "";
        $array['translator'] =
            $this->translator->map(function ($data) {
                return $data["name"];
            })->toArray();
        $array['_tags'] = $this->tags->map(function ($data) {
            return $data["name"];
        })->toArray();
        $array['rating'] =  $this->rating()->avg('rating') == null ? 0 : $this->rating()->avg('rating') + 0;
        $array['promotion']['name'] = $this->promotion ? $this->promotion->name : "";
        $array['promotion']['percent'] = $this->promotion ? $this->promotion->percent : "";

        $array['slug'] = $this->slug() == null ? "" : $this->slug()->first()->slug;
        $array['tseries'] = $this->book_series ? $this->book_series->name : "";
        return $array;
    }
    protected function makeAllSearchableUsing($query)
    {
        return $query->with('author', 'category', 'publisher', 'format', 'supplier', 'series', 'translator', 'tags', 'rating');
    }
    public function category()
    {
        return $this->belongsTo(CategoryModel::class, "cat_id");
    }
    public function supplier()
    {
        return $this->belongsTo(SupplierModel::class, "sup_id");
    }
    public function publisher()
    {
        return $this->belongsTo(PublisherModel::class, "pub_id");
    }
    public function thumb()
    {
        return $this->hasMany(BookThumbnailModel::class, 'book_id');
    }
    public function format()
    {
        return $this->belongsTo(BooksFormat::class, 'bookFormat');
    }
    public function series()
    {
        return $this->belongsTo(BookSeries::class, 'series');
    }
    public function book_series()
    {
        return $this->belongsTo(BookSeries::class, 'series');
    }
    public function author()
    {
        return $this->belongsToMany(Author::class, 'book_author', 'book_id', 'auth_id');
    }
    public function seo()
    {
        return $this->hasMany(BookSeo::class, 'book_id');
    }
    public function slug()
    {
        return $this->seo()->where('title', 'slug')->first();
    }
    public function tags()
    {
        return $this->belongsToMany(TagsModel::class, 'book_tags', 'book_id', 'tags_id');
    }
    public function translator()
    {
        return $this->belongsToMany(Translator::class, "book_translator", "book_id", "trans_id");
    }
    public function lang()
    {
        return $this->belongsTo(Language::class, "language");
    }
    public function promotion()
    {
        return $this->belongsTo(BookPromotions::class, 'promotion_id');
    }
    public function order_detail()
    {
        return $this->hasOne(OrderDetail::class, "book_id");
    }
    public function rating()
    {
        return $this->belongsToMany(UserModel::class, "ratings", "book_id", "user_id")->withPivot('title', 'comment', 'rating', 'created_at');
    }
    public function favorite()
    {
        return $this->hasMany(Favorite::class, "book_id");
    }
}
