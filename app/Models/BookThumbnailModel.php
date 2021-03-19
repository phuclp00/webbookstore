<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookThumbnailModel extends Model
{
    use HasFactory;
    //DEFINED DATABASE TABLE
    protected $table = "book_thumbnail";
    protected $primaryKey = "book_id";
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
        'book_id',
        'thumbnail_1',
        'thumbnail_2',
        'thumbnail_3',
        'thumbnail_4',
        'thumbnail_5',
        'thumbnail_6',
        'thumbnail_7',
        'created_by',
        'modiffed_by',
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

}
