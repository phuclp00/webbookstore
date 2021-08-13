<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookSeo extends Model
{
    use HasFactory;
    protected $table = "book_seo";
    public function book()
    {
        return $this->belongsTo(ProductModel::class, 'book_id');
    }
}
