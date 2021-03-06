<?php

namespace App\Models;

use App\Mail\UserRegistered;
use Canvas\Models\Post;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Canvas\Traits\User as StoryTeller;

/**
 * Class User
 * @package App\Models
 *
 */
class User extends Authenticatable
{
//    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use SoftDeletes;
    use StoryTeller;

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    protected $perPage = 10;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role', 'phone', 'username','about','birthday','avatar', 'summary'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'birthday' => 'date',
        'digest' => 'boolean',
        'dark_mode' => 'boolean',
        'role' => 'int',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'avatar'
    ];

    // user roles

    /**
     * Role identifier for a Contributor.
     *
     * @const int
     */
    const CONTRIBUTOR = 1;

    /**
     * Role identifier for an Editor.
     *
     * @const int
     */
    const EDITOR = 2;

    /**
     * Role identifier for an Admin.
     *
     * @const int
     */
    const ADMIN = 3;

    // status
    const ACTIVE = 'active';
    const INACTIVE = 'inactive';
    const BANNED = 'banned';

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = Str::uuid()->toString();
        });

        static::created(function ($user) {
            Mail::to($user)
                ->queue(new UserRegistered($user));
        });
    }

    public function getAvatarAttribute()
    {
        return $this->getProfilePhotoUrlAttribute();
    }

    public function verified()
    {
        return $this->email_verified_at !== null;
    }

    public function cache() : array
    {
        return json_decode(Redis::get($this->id),true) ?? [];
    }

    public function updateCache(array $data)
    {
        $userData = $this->cache();

        Redis::set($this->id,json_encode(array_merge($userData,$data)));
    }

    public function setLocale()
    {
        $userData = $this->cache();

        app()->setLocale($userData['locale'] ?? 'en');
    }

    public function memberSince()
    {
        if(empty($this->created_at))
            return null;

        return $this->created_at->diffForHumans();
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
