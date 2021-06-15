<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;
    //DEFINED DATABASE TABLE
    protected $table = "order";
    protected $primaryKey = "order_id";
    const UPDATED_AT = 'modified_at';
    public $timestamps = false;

    public function user_detail()
    {
        return $this->belongsTo("App\Models\OrderDetail", "user_name", "order_id");
    }
    public function book()
    {
        return $this->hasOne("App\Models\Book", "book_id", "book_id");
    }
}
