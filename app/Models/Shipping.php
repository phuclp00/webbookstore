<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use BeyondCode\Vouchers\Traits\HasVouchers;

class Shipping extends Model
{
    use HasFactory, HasVouchers;
    protected $table = "shipping";
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'modified_at';
}
