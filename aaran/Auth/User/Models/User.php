<?php

namespace Aaran\Auth\User\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Aaran\Auth\Models\Tenant;
use Aaran\Auth\User\Database\Factories\UserFactory;
use Aaran\Auth\User\Models\Role;
use Aaran\Core\Scopes\TenantScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
//use Laravel\Fortify\TwoFactorAuthenticatable;
//use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
//    use HasProfilePhoto;
    use Notifiable;
//    use TwoFactorAuthenticatable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_photo_path',
        'tenant_id',
        'role_id'
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    protected $appends = [
        'profile_photo_url',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function isSundar(): bool
    {
        return in_array($this->email, [
            'sundar@sundar.com',
            'sundar@codexsun.com',
        ]);
    }


    public function isAdmin(): bool
    {
        return in_array($this->email, [
            'sundar@sundar.com',
            'sundar@codexsun.com',
            'developer@aaran.com',
        ]);
    }

    public static function getName($id)
    {
        if($id){
            return self::find($id)->name;
        }
    }

    protected static function booted(): void
    {
        static::addGlobalScope(new TenantScope);
    }

    public static function search(string $searches)
    {
        return empty($searches) ? static::query()
            : static::where('vname', 'like', '%' . $searches . '%');
    }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    protected static function newFactory() : UserFactory
    {
        return new UserFactory();
    }

}
