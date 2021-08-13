<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SlideModel extends Model
{
    //DEFINED DATABASE TABLE
    protected $table = "slider";
    protected $primaryKey = "id";
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'modified_at';
    public $timestamps = false;
}
