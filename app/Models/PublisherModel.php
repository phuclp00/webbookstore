<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublisherModel extends Model
{
    use HasFactory;
    protected $table = "publisher";
    protected $primaryKey = "pub_id";
    const UPDATED_AT = 'modiffed_at';
    public $timestamps = false;
    protected $keyType = 'string';
      /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pub_id',
        'pub_name',
        'pub_img',
        'description',
    ];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'modiffed_at' => 'datetime',
        'created_at'  => 'datetime',
    ];
    public function book()
    {
        return $this->hasMany(ProductModel::class,'pub_id');

    }
}
