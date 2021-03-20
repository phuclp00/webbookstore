<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class CategoryModel extends Model
{
    use HasFactory,Searchable;
    protected $table = "category";
    protected $primaryKey = "cat_id";
    const UPDATED_AT = 'modiffed_at';
    public $timestamps = false;
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
        'created_by',
        'modiffed_by'
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
    public function getRouteKeyName()
    {
        return 'cat_id';
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
        return $query->with('book');
    }
    public function getname()
    {
        return $this->pub_name;
    }
    public function book()
    {
        return $this->hasMany(ProductModel::class,'cat_id');
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
}
