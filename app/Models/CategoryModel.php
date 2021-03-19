<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryModel extends Model
{
    use HasFactory;
    //DEFINED DATABASE TABLE
    protected $table = "category";
    protected $primaryKey = "cat_id";
    const CREATED_AT = 'created';
    const UPDATED_AT = 'modiffed';
    //DINH NGHIA KHOA TRONG TABBLE NAY KHONG PHAI LA KHOA TU TANG VA KIEU KHOA LA STRING 
    public $incrementing = false;
    protected $keyType = 'string';
      /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cat_id',
        'cat_name',
        'description',
    ];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'modiffed' => 'datetime',
        'created'  => 'datetime',
    ];
    public function book()
    {
        return $this->hasMany("App\Models\ProductModel", "cat_id", "cat_id");
    }
   

    public function listItems($params, $options,$stament=null,$number_stament=null)
    {
        //Tat debugbar
        //\Debugbar::disable();
        $result = null;
        if ($options['task'] == "special-list-items-total") {
            $result          =   ProductModel::where($params,$stament,$number_stament)->get("total");
            return $result;
        }
        if ($options['task'] == "admin-list-items") {
            $result          =   CategoryModel::all();
            return $result;
        }
        if ($options['task'] == "frontend-list-items") {
            $result          = CategoryModel::all();
            return $result;
        }
        if ($options['task'] == "top-list-items") {
            $result =
                CategoryModel::orderBy('total','DESC')
                ->limit($number_stament)
                ->get();
                return $result ;
        }
    }
    public function Destination($local, $options)
    {
        $result = null;

        return CategoryModel::orderByDesc(
            CategoryModel::select('arrived_at')

        )->get();
    }
}
