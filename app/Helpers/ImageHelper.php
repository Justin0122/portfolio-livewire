<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Model;

class ImageHelper extends Model
{
    public static function getImages($id, $type): array
    {
        $images = [];
        $path = public_path('/storage/' . $type . '/' . $id);
        $files = scandir($path);
        foreach ($files as $file) {
            if ($file != '.' && $file != '..') {
                $images[] = $file;
            }
        }
        $path = "storage/" . $type . "/" . $id . "/";
        return array_map(function ($image) use ($path) {
            return $path . $image;
        }, $images);
    }

    public static function removeImages($id, $type): void
    {
        //delete the entire folder
        $path = public_path('/storage/' . $type . '/' . $id);
        $files = scandir($path);
        foreach ($files as $file) {
            if ($file != '.' && $file != '..') {
                unlink($path . '/' . $file);
            }
        }
        rmdir($path);
    }

    public static function removeImage($image): void
    {
        $path = public_path($image);
        unlink($path);
        session()->flash('message', 'Photo deleted successfully');
    }

    public static function addImages($image, $id, $type): void
    {
        foreach ($image as $photo) {
            $photo->storeAs('public/' . $type . '/' . $id, $photo->getClientOriginalName());
        }
    }
}
