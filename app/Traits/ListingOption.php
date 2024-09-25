<?php

namespace App\Traits;

use Carbon\Carbon;
use Intervention\Image\Facades\Image as Image;

trait ListingOption
{

    public function checkResponsiveImage($photo_img)
    {
        $photo_height = $photo_img->getHeight();
        $photo_width = $photo_img->getWidth();

        return $photo_width == 653 || $photo_height == 914;
    }

    public function formatISO($date)
    {        
        $format_date = Carbon::parse($date, 'UTC');
        return $format_date->format('Y-m-d H:i:s');
    }

    public function storePhoto($file_name, $photo_width, $photo_height, $folder_name, $photo)
    {
        // Store the file in the public disk
        $path = $photo->storeAs(
            path: "public/photos/$folder_name",
            name: $file_name
        );

        // Optimize image
        $file_path = storage_path("app/" . $path);
        $image = Image::make($file_path);
        $image->resize($photo_width, $photo_height, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        $image->fit($photo_width, $photo_height);
        $image->save($file_path, 80);

        $f_path = "storage/photos/$folder_name/$file_name";

        return true;
    }
}