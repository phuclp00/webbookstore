<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublisherModel extends Model
{
    use HasFactory;
    protected $table = "publisher";
    protected $primaryKey = "pub_id";
    const CREATED_AT = 'created';
    const UPDATED_AT = 'modiffed';
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
        'modiffed' => 'datetime',
        'created'  => 'datetime',
    ];
    public function book()
    {
        return $this->hasMany('App\Models\Book','pub_id','pub_id');

    }
    public function Destination($local, $options)
    {
        $result = null;

        return PublisherModel::orderByDesc(
            PublisherModel::select('arrived_at')

        )->get();
    }
}
