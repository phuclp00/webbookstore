<?php

namespace App\Models;

use App\Models\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    use HasFactory;
    //DEFINED DATABASE TABLE
    protected $table = "book";
    protected $primaryKey = "book_id";
    const UPDATED_AT = 'modiffed_at';
    //DINH NGHIA KHOA TRONG TABBLE NAY KHONG PHAI LA KHOA TU TANG VA KIEU KHOA LA STRING 
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'book_id',
        'book_name',
        'description',
        'price',
        'img',
        'pub_id',
        'cat_id',
        'promotion_price',
        'modiffed_by',
        'created_by'
    ];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'modiffed_at' => 'datetime',
        'created_at'  => 'datetime',
    ];
    public function category()
    {
        return $this->belongsTo(CategoryModel::class, "cat_id");
    }
    public function publisher()
    {
        return $this->belongsTo(PublisherModel::class, "pub_id");
    }
    public function thumb(){
        return $this->hasMany(BookThumbnailModel::class,'book_id');
    }
    public function all_list_items($params, $options, $stament = null, $number_stament = null)
    {
        //Tat debugbar
        //\Debugbar::disable();
        $result = null;
        if ($options['task'] == "special-list-items") {
            $result          =   ProductModel::where($params, $stament, $number_stament)->get();
            return $result;
        }
        if ($options['task'] == "special-list-items-1") {
            $result          =   ProductModel::where($params, $stament, $number_stament)->get("book_name");
            return $result;
        }
        if ($options['task'] == "admin-list-items") {
            //$result          = ProductModel::all();
            return $result;
        }
        if ($options['task'] == "frontend-list-items") {
            $result          = ProductModel::all();
            return $result;
        }
        if ($options['task'] == "pagi-list-items") {
            $result          = ProductModel::paginate($number_stament);
            return $result;
        }
        return  $result;
    }
}
