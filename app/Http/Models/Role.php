<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Models\Actor;
use App\Http\Models\Scene;

class Role extends Model
{
    public function actors() 
    {
        return $this->belongsToMany(Actor::class, 'role_actor');
    }

    public function scenes() 
    {
        return $this->belongsToMany(Scene::class, 'role_scene');
    }
}
