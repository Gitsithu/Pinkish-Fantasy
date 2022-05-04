<?php

namespace App\Core;


use Validator;
use Auth;
use DB;
use App\Http\Requests;
use App\Session;
use App\Core\User\UserRepository;
use App\Core\SyncsTable\SyncsTable;
use Image;
use App\Log\LogCustom;
use Mail;


class Utility
{
    

    public static function getCurrentUserID()
    {
        //$id = Auth::guard('User')->user()->id;
        $user = auth()->user();
        $id = $user->id;
        return $id;
    }

    public static function saveImage($photo, $path)
    {
        if (! file_exists($path)) {
            mkdir($path, 0777, true);
        }

        //setting photo name
        $photo_name  = $photo->getClientOriginalName();

        // moving image into image folder
        $photo->move($path, $photo_name);

        $rWidth = 1.0;
        $rHeight =  1.0;

        // getting image width and height
        $imgData = getimagesize($path . $photo_name);
        $width = $imgData[0];
        $imgWidth = $width * $rWidth;
        $height = $imgData[1];
        $imgHeight = $height * $rHeight;

        // generate unique id for the image name
        $photo_unique_name = uniqid();

        // resizing image
        $image = Image::make(sprintf($path .'/%s', $photo_name))
            ->resize($imgWidth, $imgHeight)->save();

        return $photo_name;
    }

    public static function getImage($photo)
    {
        $photo_name = $photo->getClientOriginalName();
        return $photo_name;
    }

    public static function getImageExt($photo)
    {
        $photo_ext = $photo->getClientOriginalExtension();

        return $photo_ext;
    }

    public static function resizeImage($photo, $photo_name, $path)
    {
        if (! file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $photo->move($path, $photo_name);

        $rWidth     = 1.0;
        $rHeight    = 1.0;

        $imgData    = getimagesize($path . $photo_name);
        $width      = $imgData[0];
        $imgWidth   = $width * $rWidth;
        $height     = $imgData[1];
        $imgHeight  = $height * $rHeight;

        //to avoid "allowed memory size of 134217728 bytes exhausted" issue
        ini_set('memory_limit', '256M');

        $image      = Image::make(sprintf($path . '/%s', $photo_name))
                      ->resize($imgWidth, $imgHeight)->save();

        return $image;
    }

    public static function resizeImageWithDefaultWidthHeight($photo, $photo_name, $path, $width, $height)
    {
        if (! file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $photo->move($path, $photo_name);

        $rWidth     = 1.0;
        $rHeight    = 1.0;

        $imgWidth   = $width * $rWidth;
        $imgHeight  = $height * $rHeight;

        $image      = Image::make(sprintf($path . '/%s', $photo_name))
                      ->resize($imgWidth, $imgHeight)->save();

        return $image;
    }

    public static function removeImage($image_url = "")
    {
        try {
            unlink(public_path() . $image_url);
        } catch (\Exception $e) {
            $currentUser = Utility::getCurrentUserID(); //get currently logged in user

                 }
    }
    

}