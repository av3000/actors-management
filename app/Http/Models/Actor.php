<?php

namespace App\Http\Models;

use App\Http\Models\Project;
use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    public function projects() 
    {
        return $this->belongsToMany(Project::class, 'project_actor');
    }
}
