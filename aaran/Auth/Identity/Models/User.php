<?php

namespace Aaran\Auth\Identity\Models;

use Aaran\Auth\Identity\Database\Factories\UserFactory;
use Aaran\Core\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_photo', // Custom profile photo column
        'tenant_id', // Future multi-tenancy support
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Define relationship with Tenant (if needed in the future)
    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    // Get full profile photo URL
    public function getProfilePhotoUrlAttribute()
    {
        return $this->profile_photo
            ? Storage::url($this->profile_photo)
            : asset('images/default-profile.png');
    }

    // Delete old profile photo when updating
    public function deleteOldProfilePhoto()
    {
        if ($this->profile_photo && Storage::exists($this->profile_photo)) {
            Storage::delete($this->profile_photo);
        }
    }

    public function hasPermission($permission)
    {
        return $this->permissions()->where('name', $permission)->exists();
    }

    protected static function newFactory(): UserFactory
    {
        return new UserFactory();
    }
}
