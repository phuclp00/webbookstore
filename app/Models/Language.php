<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;
    protected $table = "language";
    public  $primaryKey = "id";
    const UPDATED_AT = 'modified_at';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'name',
        'description',
        'modified_by',
        'created_by',
        'deleted_by'
    ];
    protected $casts = [
        'modified_at' => 'datetime',
        'created_at'  => 'datetime',
        'deleted_at' => 'datetime'

    ];
    public function book()
    {
        return $this->hasOne(ProductModel::class, 'id');
    }
}
