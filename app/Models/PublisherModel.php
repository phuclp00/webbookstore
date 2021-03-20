<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class PublisherModel extends Model
{
    use HasFactory,Searchable;
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
    public function getRouteKeyName()
    {
        return 'pub_id';
    }
    public function isPublished()
    {
        return $this->created_at !== null;
    }
    public function shouldBeSearchable()
    {
        return $this->isPublished();
    }
    public function toSearchableArray()
    {
        $array = $this->toArray();
        return $array;
    }
    protected function makeAllSearchableUsing($query)
    {
        return $query->with('book');
    }
    public function getname()
    {
        return $this->pub_name;
    }
    public function book()
    {
        return $this->hasMany(ProductModel::class,'pub_id');
    }
}
