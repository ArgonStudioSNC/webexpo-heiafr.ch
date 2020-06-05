<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Professor extends Model
{
    /**
     * Get the projects associated with the professor.
     */
    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    //
}
