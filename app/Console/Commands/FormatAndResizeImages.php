<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Image;
use Intervention\Image\Exception\NotReadableException;

class FormatAndResizeImages extends Command
{
    private const JPG_EXTENSIONS = ['jpg', 'jpeg'];

    private const JPG_QUALITY = 100;

    private const VARIANT_JPG_QUALITY = 95;

    private const BIG_FILE_SIZE = 5242880;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'webexpo:format-resize
                            {year : the year wich images you want to format and resize}
                            {skip=0 : skip the first n students}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Convert every image to .jpg and resize them in a Webexpo project for the given year';

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
        ini_set('memory_limit', '4G');

        $year = $this->argument('year');
        $this->resizeStudentsPortraits('/public/students');
        $this->resizeProjectsImages('/public/projects/' . $year . '/bachelor');
        $this->resizeProjectsImages('/public/projects/' . $year . '/master');

        return 0;
    }

    private function resizeProjectsImages($path)
    {
        $skip = $this->argument('skip');
        $this->info('resizeProjectsImages on folder ' . $path . '...');
        $this->newLine();
        foreach (array_slice(Storage::directories($path), $skip) as $studentDir) {
            $this->info('we now resize student ' . basename($studentDir));
            // BOARDS
            $this->info('we now resize BOARDS...');
            if (!Storage::exists($studentDir . '/boards')) {
                $this->error('no boards directory!');
            } else {
                $this->resize($studentDir . '/boards', [600, 1200], false);
            }
            // IMAGES
            $this->info('we now resize IMAGES...');
            if (!Storage::exists($studentDir . '/images')) {
                $this->error('no images directory!');
            } else {
                $this->resize($studentDir . '/images', [600, 1200, 2400], false);
            }
            // VIGNETTE
            $this->info('we now resize VIGNETTE...');
            if (!Storage::exists($studentDir . '/vignette')) {
                $this->error('no vignette directory!');
            } else {
                $this->resize($studentDir . '/vignette', [600], false);
                $vignetteFiles = Storage::files($studentDir . '/vignette');
                if (empty($vignetteFiles)) {
                    $this->error('no vignette file to replace by a placeholder!');
                } else {
                    Storage::put($vignetteFiles[0], 'PLACEHOLDER FILE created ' . date('Y-m-d H:i:s'));
                }
            }
        }
        $this->newLine();
    }

    private function resizeStudentsPortraits($path)
    {
        $this->info('resizeStudentsPortraits on folder ' . $path . '...');
        $this->newLine();
        foreach (Storage::directories($path) as $studentDir) {
            $dirPath = $studentDir . '/portrait';
            if (!Storage::exists($dirPath)) {
                $this->error('no portrait directory!');
                continue;
            }

            $this->info('we now resize student ' . basename($studentDir));

            foreach (Storage::files($dirPath) as $file) {
                $filename = pathinfo($file, PATHINFO_FILENAME);
                $targetFile = $dirPath . '/' . $filename . '.jpg';
                $this->line($filename);

                $image = $this->readImage($file);
                if ($image === null) {
                    continue;
                }
                $image->orientate();

                if ($image->width() > 600) {
                    $image->resize(600, null, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    });
                    $this->line('resized to 600px');
                } elseif ($file !== $targetFile) {
                    $this->line($this->isJpgFile($file) ? 'renamed to .jpg' : 'converted to jpg');
                } else {
                    $this->line('orientation normalized');
                }

                $this->writeJpg($image, $file, $targetFile, self::JPG_QUALITY);
                $image->destroy();
            }
        }
        $this->newLine();
    }

    private function resize($path, $sizes, $lazy)
    {
        foreach ($sizes as $size) {
            Storage::makeDirectory($path . '/@' . $size);
        }
        $this->line('directories created!');

        $this->line('processing images...');
        arsort($sizes);
        foreach (Storage::files($path) as $file) {
            $filename = pathinfo($file, PATHINFO_FILENAME);
            $targetFile = $path . '/' . $filename . '.jpg';
            $this->line($filename);
            $originalSize = Storage::size($file);
            if ($originalSize < 100) {
                $this->line('ignoring placeholder file!');
                continue;
            }

            $image = $this->readImage($file);
            if ($image === null) {
                continue;
            }
            $image->orientate();

            if ($originalSize > self::BIG_FILE_SIZE) {
                $image->resize(4000, 4000, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
                $this->line('resized to 4000px');
            } elseif ($file !== $targetFile) {
                $this->line($this->isJpgFile($file) ? 'renamed to .jpg' : 'converted to jpg');
            } else {
                $this->line('orientation normalized');
            }

            $this->writeJpg($image, $file, $targetFile, self::JPG_QUALITY);

            foreach ($sizes as $size) {
                $variantPath = $path . '/@' . $size . '/' . $filename . '@' . $size . '.jpg';
                if ($image->width() > $size) {
                    $image->resize($size, null, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    })
                        ->save(storage_path('app/' . $variantPath), self::VARIANT_JPG_QUALITY, 'jpg');
                    $this->line('resized to ' . $size . 'px');
                } elseif ($lazy === false) {
                    Storage::delete($variantPath);
                    Storage::copy($targetFile, $variantPath);
                    $this->line('file copied to @' . $size);
                } else {
                    $this->line('no version created for @' . $size);
                }
            }

            $image->destroy();
        }
        $this->newLine();
    }

    private function isJpgFile($file)
    {
        return in_array(strtolower(pathinfo($file, PATHINFO_EXTENSION)), self::JPG_EXTENSIONS, true);
    }

    private function readImage($file)
    {
        try {
            return Image::make(storage_path('app/' . $file));
        } catch (NotReadableException $e) {
            $this->error('unreadable image, skipped: ' . $file);

            return null;
        }
    }

    private function writeJpg($image, $sourceFile, $targetFile, $quality)
    {
        if ($sourceFile === $targetFile) {
            $image->save(storage_path('app/' . $targetFile), $quality, 'jpg');

            return;
        }

        $tmpFile = $targetFile . '.tmp';
        $image->save(storage_path('app/' . $tmpFile), $quality, 'jpg');

        Storage::delete($sourceFile);
        Storage::delete($targetFile);
        Storage::move($tmpFile, $targetFile);
    }
}
