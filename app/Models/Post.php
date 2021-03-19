<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable =[
        'title','content','published'
    ];
    public function user(){
        return $this->belongsTo(UserModel::class);
    }
    public function comment()
    {
        return $this->hasMany(Comment::class);
    }
}
