<?php

namespace App\Http\Models;

use App\Http\Models\Actor;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public function actors() 
    {
        return $this->belongsToMany(Actor::class, 'project_actor');
    }
}
