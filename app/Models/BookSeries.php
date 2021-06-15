<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class BookSeries extends Model
{
    use HasFactory, Searchable, SoftDeletes;
    //DEFINED DATABASE TABLE
    protected $table = "book_series";
    public  $primaryKey = "id";
    const UPDATED_AT = 'modified_at';
    protected $fillable = [
        'name',
        'image',
        'description',
        'created_by',
        'modified_by',
        'deleted_by'
    ];
    protected $casts = [
        'modified_at' => 'datetime',
        'created_at'  => 'datetime',
        'deleted_at' => 'datetime'

    ];
    //DEFINED SEARCHABLE ALGOLIA
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
    public function books()
    {
        return $this->hasMany(ProductModel::class, 'series');
    }
}
