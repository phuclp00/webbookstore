<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Author extends Model
{
    use HasFactory, Searchable, SoftDeletes;
    //DEFINED DATABASE TABLE
    protected $table = "author";
    public  $primaryKey = "id";
    const UPDATED_AT = 'modified_at';
    protected $fillable = [
        'name',
        'image',
        'description',
        'created_by',
        'modified_by',
        'deleted_by',
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
        return $this->belongsToMany(ProductModel::class, 'book_author', 'auth_id', 'book_id');
    }
}
