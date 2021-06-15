<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookType extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "types";
    public  $primaryKey = "id";

    const UPDATED_AT = 'modified_at';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'modified_by',
        'created_by',
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
    public function books()
    {
        return $this->hasMany(ProductModel::class, 'type');
    }
    public function category()
    {
        return $this->hasMany(CategoryModel::class, 'type_id');
    }
}
