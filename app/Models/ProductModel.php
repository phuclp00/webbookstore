<?php

namespace App\Models;

use App\Models\DB;
use App\Models\Language;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Redis;
use Laravel\Scout\Searchable;

class ProductModel extends Model
{
    use HasFactory, Searchable, SoftDeletes;
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
        'price',
        'img',
        'cat_id',
        'pub_id',
        'sup_id',
        'weight',
        'episode',
        'series',
        'promotion_id',
        'out_of_business',
        'datePublished',
        'copyrightYear',
        'bookFormat',
        'translator',
        'rating',
        'total',
        'size',
        'serialNumber',
        'numberOfPages',
        'language',
        'modified_by',
        'created_by',
        'deleted_by',
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
    protected $touches = ['author', 'category', 'publisher', 'format', 'supplier', 'series', 'translator', 'tags'];

    // public function __construct()
    // {
    //     $this->storage = Redis::connection();
    // }
    public function getRouteKeyName()
    {
        return 'book_id';
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
        return $array;
    }
    protected function makeAllSearchableUsing($query)
    {
        return $query->with('category', 'publisher');
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
    public function author()
    {
        return $this->belongsToMany(Author::class, 'book_author', 'book_id', 'auth_id');
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
    public function order_detail()
    {
        return $this->hasOne(OrderDetail::class, "book_id");
    }
    public function rating()
    {
        return $this->hasMany(Rating::class, "id");
    }
    public function favorite()
    {
        return $this->hasMany(Favorite::class, "book_id");
    }
}
