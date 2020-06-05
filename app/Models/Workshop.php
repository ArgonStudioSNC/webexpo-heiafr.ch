<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Workshop extends Model
{
    /**
     * Get the projects associated with the workshop.
     */
    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    //
}
