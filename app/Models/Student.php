<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    /**
     * Get the project  associated with the student.
     */
    public function project()
    {
        return $this->hasOne(Project::class);
    }
    
    //
}
