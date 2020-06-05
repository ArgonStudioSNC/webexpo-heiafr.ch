<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'experts' => 'array',
    ];

    /**
     * Get the student that owns the project.
     */
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    /**
     * Get the site that hosts the project.
     */
    public function site()
    {
        return $this->belongsTo(Site::class);
    }

    /**
     * Get the professor that mentors the project.
     */
    public function professor()
    {
        return $this->belongsTo(Professor::class);
    }

    /**
     * Get the workshop that organizes the project.
     */
    public function workshop()
    {
        return $this->belongsTo(Workshop::class);
    }
    //
}
