<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;
use Kalnoy\Nestedset\NodeTrait;

class CategoryModel extends Model
{
    use HasFactory;
    use NodeTrait;
    use SoftDeletes;
    use Searchable {
        Searchable::usesSoftDelete insteadof \Kalnoy\Nestedset\NodeTrait;
    }

    protected $table = "category";
    protected $primaryKey = "id";
    const UPDATED_AT = 'modified_at';
    protected $keyType = 'string';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'parent_id',
        'name',
        '_lft',
        '_rgt',
        'type_id',
        'description',
        'created_by',
        'modified_by',
        'deleted_by'
    ];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'modified_at' => 'datetime',
        'created_at'  => 'datetime',
        'deleted_at' => 'datetime'

    ];
    public function getRouteKeyName()
    {
        return 'id';
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
    public function getLftName()
    {
        return '_lft';
    }

    public function getRgtName()
    {
        return '_rgt';
    }

    public function getParentIdName()
    {
        return 'parent_id';
    }
    // Specify parent id attribute mutator
    public function setParentAttribute($value)
    {
        $this->setParentIdAttribute($value);
    }

    public function books()
    {
        return $this->hasMany(ProductModel::class, 'cat_id');
    }
    public function listItems($params, $options, $stament = null, $number_stament = null)
    {
        //Tat debugbar
        //\Debugbar::disable();
        $result = null;
        if ($options['task'] == "special-list-items-total") {
            $result          =   ProductModel::where($params, $stament, $number_stament)->get("total");
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
                CategoryModel::orderBy('total', 'DESC')
                ->limit($number_stament)
                ->get();
            return $result;
        }
    }
    /* Mo hinh parent-child de quy
    // public function child()
    // {
    //     return $this->hasMany(self::class, 'parent_id');
    // }
    // public function childrent()
    // {
    //     return $this->child()->with('childrent');
    // }
    // public function parent()
    // {
    //     return $this->belongsTo(self::class, 'id');
    // }
    // public function root()
    // {
    //     return $this->parent()->with('root');
    // }--*/
}
