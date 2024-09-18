<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\UserType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Arr;
class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'first_name',
        'last_name',
        'email',
        'password',
        'user_type',
        'salary_per_day',
        'nic',
        'mobile',
        'active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
        'profile_image_url',
        'user_type_name',
        'status_name',
    ];

    public function getProfileImageUrlAttribute()
    {
        $directory = public_path('img/profile');
        $files = File::allFiles($directory);
        $imageNames = collect($files)
            ->filter(function ($file) {
                return in_array($file->getExtension(), [
                    'jpg',
                    'jpeg',
                    'png',
                    'gif',
                    'bmp',
                    'webp',
                ]);
            })
            ->map(function ($file) {
                $url = '/img/profile/' . $file->getFilename();
                return $url;
            })
            ->toArray();

        //dd(Arr::random($imageNames));
        return Arr::random($imageNames);
    }

    public function getUserTypeNameAttribute()
    {
        $user_type_name = UserType::getKey(intval($this->user_type));
        return str_replace('_', ' ', strtolower($user_type_name));
    }

    public function getStatusNameAttribute()
    {
        return $this->active == 1 ? 'Activated' : 'Deactivated';
    }
}
