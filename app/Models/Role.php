<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Role extends Model
{
    protected $fillable = [
        'name',
        'description',
        'slug',
        'status',
        'permissions',
        'notifications',
        'dashboard_access'
    ];

    protected $casts = [
        'permissions' => 'collection',
    ];

    public function users() {
        return $this->belongsToMany(User::class);
    }

    public function access() {
        return $this->hasMany(AccessMenuAdmin::class, 'role_id');
    }
}
