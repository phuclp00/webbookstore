<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;
    protected $table = "favorite";
    protected $primaryKey = "id";
    const UPDATED_AT = 'modified_at';
    public $timestamps = false;
}
