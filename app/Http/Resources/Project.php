<?php

namespace App\Http\Resources;

use App\Http\Resources as Resources;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class Project extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $base_projects_url = '/projects'.'/'.$this->year.'/'.$this->degree.'/'.$this->student->uuid;

        $vignette = array_map('basename', Storage::disk('public')->files($base_projects_url.'/vignette'));
        $images = array_map('basename', Storage::disk('public')->files($base_projects_url.'/images'));
        $boards = array_map('basename', Storage::disk('public')->files($base_projects_url.'/boards'));
        $books = array_map('basename', Storage::disk('public')->files($base_projects_url.'/books'));

        $vignette = $this::cleanArray($vignette, ['jpeg', 'jpg', 'gif', 'png']);
        $images = $this::cleanArray($images, ['jpeg', 'jpg', 'gif', 'png']);
        $boards = $this::cleanArray($boards, ['jpeg', 'jpg', 'gif', 'png']);
        $books = $this::cleanArray($books, ['pdf']);

        return [
            'id' => $this->id,
            'degree' => $this->degree,
            'year' => $this->year,
            'student' => new Resources\Student($this->student),
            'site' => new Resources\Site($this->site),
            'professor' => new Resources\Professor($this->professor),
            'workshop' => new Resources\Workshop($this->workshop),
            'experts' => $this->experts,
            'title' => $this->title,
            'lead' => $this->lead,
            'text' => $this->text,

            'vignette_file' => ! empty($vignette) ? $vignette[0] : null,
            'images_files' => ! empty($images) ? $images : null,
            'boards_files' => ! empty($boards) ? $boards : null,
            'books_files' => ! empty($books) ? $books : null,
        ];
    }

    public function cleanArray($files, $extensions)
    {
        $cleanArray = [];
        foreach ($files as $file) {
            [$name, $extension] = explode('.', $file);

            if (in_array($extension, $extensions)) {
                $cleanArray[] = $file;
            }
        }

        return $cleanArray;
    }
}
