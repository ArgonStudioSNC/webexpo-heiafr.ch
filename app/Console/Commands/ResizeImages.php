<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Image;

class ResizeImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'webexpo:resize
                            {year : the year wich images you want to resize}
                            {skip=0 : skip the first n students}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Resize images in a Webexpo project for the given year';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $year = $this->argument('year');
        $this->resizeStudentsPortraits('/public/students');
        $this->resizeProjectsImages('/public/projects/'.$year.'/bachelor');
        $this->resizeProjectsImages('/public/projects/'.$year.'/master');

        return 0;
    }

    private function resizeProjectsImages($path) {
        $skip = $this->argument('skip');
        $this->info('resizeProjectsImages on folder '.$path.'...');
        $this->newLine();
        foreach (array_slice(Storage::directories($path), $skip) as $studentDir) {
            $this->info('we now resize student '.basename($studentDir));
            // BOARDS
            $this->info('we now resize BOARDS...');
            if (!Storage::exists($studentDir.DIRECTORY_SEPARATOR.'boards')){
                $this->error('no boards directory!');
            } else {
                $this->resize($studentDir.DIRECTORY_SEPARATOR.'boards', [600,1200], true);
            }
            // IMAGES
            $this->info('we now resize IMAGES...');
            if (!Storage::exists($studentDir.DIRECTORY_SEPARATOR.'images')){
                $this->error('no images directory!');
            } else {
                $this->resize($studentDir.DIRECTORY_SEPARATOR.'images', [600,1200,2400], true);
            }
            // VIGNETTE
            $this->info('we now resize VIGNETTE...');
            if (!Storage::exists($studentDir.DIRECTORY_SEPARATOR.'vignette')){
                $this->error('no vignette directory!');
            } else {
                $this->resize($studentDir.DIRECTORY_SEPARATOR.'vignette', [600], false);
                Storage::put(Storage::files($studentDir.DIRECTORY_SEPARATOR.'vignette')[0], 'PLACEHOLDER FILE created '.date('Y-m-d H:i:s'));
            }
        }
        $this->newLine();
    }

    private function resizeStudentsPortraits($path) {
        $this->info('resizeStudentsPortraits on folder '.$path.'...');
        $this->newLine();
        foreach (Storage::directories($path) as $studentDir) {
            $dirPath = $studentDir.DIRECTORY_SEPARATOR.'portrait';
            if (!Storage::exists($dirPath)){
                $this->error('no portrait directory!');
            } else {
                $this->info('we now resize student '.basename($studentDir));

                foreach (Storage::files($dirPath) as $file) {
                    $image = Storage::get($file);
                    $filename = pathinfo($file, PATHINFO_FILENAME);
                    $this->line($filename);

                    // resizing
                    $image_resize = Image::make($image);
                    if ($image_resize->width() > 600) {
                        $image_resize->resize(600, null, function ($constraint){
                            $constraint->aspectRatio();
                            $constraint->upsize();
                        })
                        ->save(storage_path('app'.DIRECTORY_SEPARATOR.$dirPath.DIRECTORY_SEPARATOR.$filename.'.jpg'), 100, 'jpg');
                        $this->line('resized to 600px');
                    } else {
                        $this->line('file is allready ok!');
                    }
                    $image_resize->destroy();
                }
            }
        }
        $this->newLine();
    }

    private function resize($path, $sizes, $lazy) {
        foreach ($sizes as $size) {
            $dirPath = $path.DIRECTORY_SEPARATOR.'@'.$size;
            Storage::makeDirectory($dirPath);
        }
        $this->line('directories created!');

        $this->line('processing images...');
        foreach (Storage::files($path) as $file) {
            $image = Storage::get($file);
            $filename = pathinfo($file, PATHINFO_FILENAME);
            $this->line($filename);
            if(Storage::size($file) < 100) {
                $this->line('ignoring placeholder file!');
                break;
            }
            // resizing
            $image_resize = Image::make($image);
            $image_resize->backup();
            arsort($sizes);
            foreach ($sizes as $size) {
                if($image_resize->width() > $size) {
                    $image_resize->resize($size, null, function ($constraint){
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    })
                    ->save(storage_path('app'.DIRECTORY_SEPARATOR.$path.DIRECTORY_SEPARATOR.'@'.$size.DIRECTORY_SEPARATOR.$filename.'@'.$size.'.jpg'), 95, 'jpg')
                    ->reset();
                    $this->line('resized to '.$size.'px');
                } elseif ($lazy === false) {
                    Storage::copy($file, $path.DIRECTORY_SEPARATOR.'@'.$size.DIRECTORY_SEPARATOR.$filename.'@'.$size.'.jpg');
                    $this->line('file copied to @'.$size);
                } else {
                    $this->line('no version created for @'.$size);
                }
            }
            // file is bigger than 5MB
            if(Storage::size($file) > 5242880) {
                $image_resize->resize(4000, 4000, function ($constraint){
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })
                ->save(storage_path('app'.DIRECTORY_SEPARATOR.$path.DIRECTORY_SEPARATOR.$filename.'.jpg'), 100, 'jpg');
                $this->line('resized to 4000px');
            }
            $image_resize->destroy();
        }
        $this->newLine();
    }
}
