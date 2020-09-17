<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Models\Role;

class Scene extends Model
{
    public function roles() 
    {
        return $this->belongsToMany(Role::class, 'role_scene');
    }
}
