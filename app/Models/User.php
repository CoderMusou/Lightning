<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\UploadedFile;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Multicaret\Acquaintances\Traits\CanLike;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use CanLike;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'description',
        'profile_photo_path'
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
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function getAvatarUrl(string $default = 'mp', int $size = 80)
    {
        return sprintf(
            'https://www.gravatar.com/avatar/%s?d=%s&s=%s',
            md5(strtolower(trim($this->email))), urlencode($default), $size
        );
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::needsRehash($value) ? Hash::make($value) : $value;
    }

    public function setAvatarAttribute($avatar)
    {
        $this->attributes['avatar'] = $avatar instanceof UploadedFile
            ? Storage::url($avatar->store('avatars'))
            : $avatar;
    }

    protected static function booted()
    {
        static::creating(function (self $user) {
            if (! $user->profile_photo_path) {
                $user->profile_photo_path = $user->getAvatarUrl();
            }
        });
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'author_id');
    }

    public function publishedPosts()
    {
        return $this->posts()->published();
    }

    public function likedPosts()
    {
        return $this->likes(Post::class)->published();
    }
}
