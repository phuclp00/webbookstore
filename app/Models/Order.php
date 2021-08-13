<?php

namespace App\Models;

use BeyondCode\Vouchers\Models\Voucher;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use BeyondCode\Vouchers\Traits\HasVouchers;
use Illuminate\Support\Facades\Request;

class Order extends Model
{
    use HasFactory, SoftDeletes, HasVouchers;
    //DEFINED DATABASE TABLE
    protected $table = "order";
    protected $primaryKey = "id";
    const UPDATED_AT = 'modified_at';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'id',
        'delivery_adress_id',
        'voucher_id',
        'shipping_id',
        'status_id',
        'payment_id',
        'tax',
        'final_price',
        'note',
        'created_by',
        'modified_by'
    ];
    protected $casts = [
        'modified_at' => 'datetime',
        'created_at'  => 'datetime',
    ];
    public function books()
    {
        return $this->belongsToMany(ProductModel::class, 'order_detail', 'order_id', 'book_id')->withPivot('quantity')->withTimestamps();
    }
    public function payment()
    {
        return $this->belongsTo(Payment::class, 'payment_id');
    }
    public function shipping()
    {
        return $this->belongsTo(Shipping::class, 'shipping_id');
    }
    public function status()
    {
        return $this->belongsTo(OrderStatus::class, 'status_id');
    }
    public function vouchers()
    {
        return $this->belongsTo(Voucher::class, 'voucher_id');
    }
    public function address()
    {
        return $this->belongsTo(UserAddress::class, 'delivery_adress_id')->withTrashed();
    }
}
