<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Show_info_user extends Model
{
    use HasFactory;
    //DEFINED DATABASE TABLE
    protected $table = "user_account_info";
    protected $primaryKey = \false;
    protected $keyType = \false;
}
