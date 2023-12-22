<?php

namespace App\Helper;
use Illuminate\Support\Carbon;

class Helper
{
    private static function uploadImage ($imageFile , $constImagePath , $constStorageFolder){
        $fileName = 'image-' . Carbon::now()->timestamp . 'R' . random_int(111, 999) . '.' . $imageFile->getClientOriginalExtension();
        $filePath = $constImagePath . $fileName;
        $imageFile->storeAs($constStorageFolder, $fileName);
        return $filePath; 
    }
    public static function uploadUserImage( $imageFile )
    {
        return self::uploadImage($imageFile , USER_IMAGE_PATH , USER_IMAGE_STORAGE); 
    }
    public static function uploadCategoryImage( $imageFile )
    {
        return self::uploadImage($imageFile , CATEGORY_IMAGE_PATH , CATEGORY_IMAGE_STORAGE); 
    }
    public static function uploadProductImage( $imageFile )
    {
        return self::uploadImage($imageFile , PRODUCt_IMAGE_PATH , PRODUCt_IMAGE_STORAGE); 
    }
}
