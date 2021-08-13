<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPhone extends Model
{
    use HasFactory;
    protected $table = "phone";
    protected $primaryKey = "id";
    const UPDATED_AT = 'modified_at';
    protected $fillable = [
        'number',
        'user_id',
        'created_by',
        'deleted_by',
        'modified_by'
    ];
    public function user()
    {
        return $this->belongsTo(UserModel::class, 'user_id');
    }
}
