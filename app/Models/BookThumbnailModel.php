<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookThumbnailModel extends Model
{
    use HasFactory;
    //DEFINED DATABASE TABLE
    protected $table = "thumbnail";
    protected $primaryKey = "id";
    const UPDATED_AT = 'modified_at';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'book_id',
        'image',
        'description',
        'created_by',
        'modified_by',
    ];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'modified_at' => 'datetime',
        'created_at'  => 'datetime',
    ];
    public function book()
    {
        return $this->belongsTo(ProductModel::class, 'book_id');
    }
}
