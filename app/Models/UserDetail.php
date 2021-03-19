<?php

namespace App\Models;

use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class UserDetail extends Model
{
    use HasFactory;
    //DEFINED DATABASE TABLE
    protected $table = "user_detail";
    protected $primaryKey = "user_id";
    protected $keyType="int";
    const UPDATED_AT = 'modiffed_at';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'full_name',
        'street',
        'district',
        'city',
        'phone',
        'list_favorite',
        'img',
        'modiffed_at',
        'created_by',
        'created_at',
        'modiffed_by'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'modiffed_at' => 'datetime',
        'created_at' => 'datetime'
    ];
    public function user_account()
    {
        return $this->belongsTo(UserModel::class,'user_id');
    }
}
