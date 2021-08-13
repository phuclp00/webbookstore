<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Vanthao03596\HCVN\Models\District;
use Vanthao03596\HCVN\Models\Province;
use Vanthao03596\HCVN\Models\Ward;

class UserAddress extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "address";
    public  $primaryKey = "id";
    const UPDATED_AT = 'modified_at';
    protected $fillable = [
        'user_id',
        'address_line_1',
        'address_line_2',
        'district',
        'wards',
        'city',
        'country',
        'zip_code',
        'deleted_by',
        'modified_by',
        'created_by'
    ];
    public function user()
    {
        return $this->belongsTo(UserModel::class, 'user_id');
    }
    public function orders()
    {
        return $this->hasMany(Order::class, 'delivery_adress_id')->withTrashed();
    }
    public function guest()
    {
        return $this->hasMany(Guest::class, 'address_id');
    }
    public function get_districts()
    {
        return $this->belongsTo(District::class, 'district', 'id');
    }
    public function get_wards()
    {
        return $this->belongsTo(Ward::class, 'wards', 'id');
    }
    public function get_city()
    {
        return $this->belongsTo(Province::class, 'city', 'id');
    }
}
