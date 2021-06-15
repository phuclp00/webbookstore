<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;
    protected $table = "ratings";
    protected $primaryKey = "id";
    const UPDATED_AT = 'modified_at';
    public $timestamps = false;

    public function book()
    {
        return $this->belongsTo(ProductModel::class, 'book_id');
    }
}
