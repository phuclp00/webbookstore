<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderDetail extends Model
{
    use HasFactory, SoftDeletes;
    //DEFINED DATABASE TABLE
    protected $table = "order_detail";
    protected $primaryKey = "order_id";
    const UPDATED_AT = 'modified_at';
    public $timestamps = false;


    public function book()
    {
        return $this->belongsTo(ProductModel::class, 'book_id');
    }
    public function order()
    {
        return $this->hasOne("App\Models\Order", "order_id", "order_id");
    }
}
