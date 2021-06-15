<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class SupplierModel extends Model
{
    use HasFactory, Searchable, SoftDeletes;
    protected $table = "supplier";
    protected $primaryKey = "id";
    const UPDATED_AT = 'modified_at';
    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'image',
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
        return $this->name;
    }
    public function books()
    {
        return $this->hasMany(ProductModel::class, 'book_id');
    }
}
