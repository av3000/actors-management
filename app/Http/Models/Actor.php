<?php

namespace App\Http\Models;

use App\Http\Models\Project;
use App\Http\Models\Role;
use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    public function projects() 
    {
        return $this->belongsToMany(Project::class, 'project_actor');
    }

    public function roles() 
    {
        return $this->belongsToMany(Role::class, 'role_actor');
    }
}
