<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notifications extends Model
{
    use HasFactory, SoftDeletes;

    //DEFINED DATABASE TABLE

    protected $table = "notifications";
    protected $primaryKey = "id";
    protected $keyType = "string";
    public $incrementing = false;

    protected $fillable = [
        'id',
        'type',
        'notifiable_type',
        'notifiable_id',
        'data',
        'read_at',
        'created_by',
        'modified_by',
        'deleted_by'
    ];
    protected $casts = [
        'updated_at' => 'datetime',
        'created_at'  => 'datetime',
        'deleted_at' => 'datetime'
    ];
    /**
     * Get the user associated with the Notifications
     *
     */
    public function usermodel()
    {
        return $this->belongsTo(UserModel::class, 'user_id', 'notifiable_id');
    }
}
