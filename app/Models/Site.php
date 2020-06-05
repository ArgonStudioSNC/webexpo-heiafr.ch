<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    /**
     * Get the projects associated with the site.
     */
    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    //
}
