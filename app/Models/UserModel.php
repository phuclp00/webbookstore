<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use App\Events\User\UserRegisted;
use BeyondCode\Vouchers\Models\Voucher;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prophecy\Doubler\Generator\Node\ReturnTypeNode;
use Laravel\Scout\Searchable;
use Laravel\Sanctum\HasApiTokens;
use Gabievi\Promocodes\Traits\Rewardable;
use BeyondCode\Vouchers\Traits\CanRedeemVouchers;
use Illuminate\Support\Str;
use Illuminate\Contracts\Auth\CanResetPassword;
use function PHPUnit\Framework\returnSelf;

class UserModel extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use Searchable;
    use SoftDeletes;
    use CanRedeemVouchers;
    //DEFINED DATABASE TABLE
    protected $table = "user_account";
    protected $primaryKey = "user_id";
    const UPDATED_AT = 'modified_at';
    protected $guard = 'web';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_name',
        'email',
        'password',
        'image',
        'membership_id',
        'level',
        'status',
        'refresh_token',
        'remember_token',
        'email_verified_at',
        'deleted_by',
        'modified_by',
        'created_by'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'modified_at' => 'datetime',
        'created_at'  => 'datetime',
        'deleted_at' => 'datetime'
    ];
    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $guarded = [];
    protected static $logAttributesToIgnore = ['remember_token'];
    protected static $ignoreChangedAttributes = ['remember_token'];

    protected $touches = ['rating', 'membership'];

    public function searchableAs()
    {
        return 'user_account';
    }
    public function getRouteKeyName()
    {
        return 'user_id';
    }
    public function getScoutKey()
    {
        return $this->user_id;
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
    public function setPasswordAttribute($password)
    {
        if (Hash::needsRehash($password))
            $password = Hash::make($password);

        $this->attributes['password'] = $password;
    }
    protected function makeAllSearchableUsing($query)
    {
        return $query->with('phone')->with('address');
    }
    public function get_notify()
    {
        return $this->hasMany(Notifications::class, 'notifiable_id', 'user_id');
    }
    public function address()
    {
        return $this->hasMany(UserAddress::class, 'user_id');
    }
    public function phone()
    {
        return $this->hasMany(UserPhone::class, 'user_id');
    }
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function points()
    {
        return $this->hasMany(PointsLog::class, 'user_id');
    }
    public function membership()
    {
        return $this->belongsTo(Membership::class, 'membership_id');
    }
    public function getLevel()
    {
        return $this->level;
    }
    public function is_admin()
    {
        return $this->level == "admin" ? true : false;
    }
    public function vouchers()
    {
        return $this->hasMany(Voucher::class, "model_id");
    }
    public function social_account()
    {
        return $this->hasMany(SocialAccount::class, 'user_id');
    }
    public function rating()
    {
        return $this->belongsToMany(ProductModel::class, 'ratings', 'user_id', 'book_id');
    }
    public function favorite()
    {
        return $this->belongsToMany(ProductModel::class, 'favorite', 'user_id', 'book_id');
    }
}
