<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Guest extends Model
{
    use HasFactory, Notifiable, SoftDeletes;
    protected $table = "guest";
    const UPDATED_AT = 'modified_at';
    protected $primaryKey = "user_id";
    public $incrementing = false;
    protected $fillable = [
        'user_id',
        'full_name',
        'phone',
        'ip_address',
        'email',
        'address_id',
        'modified_by',
        'created_by',
        'modified_by'
    ];
    protected $casts = [
        'modified_at' => 'datetime',
        'created_at'  => 'datetime',
    ];

    public function comments()
    {
        return $this->hasMany(Order::class, 'id');
    }
    public function address()
    {
        return $this->belongsTo(UserAddress::class, 'address_id', 'id');
    }
}
