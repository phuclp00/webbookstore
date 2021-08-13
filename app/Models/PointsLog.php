<?php

namespace App\Models;

use Encore\Admin\Form\Field\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PointsLog extends Model
{
    use HasFactory;
    protected $table = "reward_point_log";
    protected $primaryKey = "id";
    const UPDATED_AT = 'modified_at';
    protected $fillable = [
        'user_id',
        'reward_points',
        'reward_type',
        'operation_type',
        'expire_date',
        'tax',
        'final_price',
        'note',
        'created_by',
        'modified_by',
        'deleted_by'
    ];
    protected $casts = [
        'modified_at' => 'datetime',
        'created_at'  => 'datetime',
        'expire_date' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(UserModel::class, 'user_id');
    }
}
