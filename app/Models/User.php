<?php

namespace App\Models;

use App\Models\Product;
use App\Models\Role;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'profile_photo',
        'birthday',
        'city',
        'gender',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    public function role()
    {

        return $this->belongsTo(Role::class);
    }

    public function products()
    {

        return $this->hasMany(Product::class);
    }

    public function scopeSuperAdmins($query)
    {

        return $query->whereHas('role', function ($roleQuery) {
            $roleQuery->where('name', 'super-admin');
        });
    }

    public function isAdmin()
    {
        return in_array($this->role->name, ['admin', 'super-admin']);
    }
}
