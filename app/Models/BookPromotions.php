<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class BookPromotions extends Model
{
    use HasFactory, Searchable, SoftDeletes;
    //DEFINED DATABASE TABLE
    protected $table = "promotions";
    public  $primaryKey = "id";
    const UPDATED_AT = 'modified_at';
    protected $fillable = [
        'name',
        'percent',
        'content',
        'date_expired',
        'date_started',
        'description',
        'created_by',
        'modified_by',
        'deleted_by'
    ];
    protected $casts = [
        'modified_at' => 'datetime',
        'created_at'  => 'datetime',
        'deleted_at' => 'datetime',

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
        return $this->hasMany(ProductModel::class, 'promotion_id');
    }
}
