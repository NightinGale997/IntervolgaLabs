<?php

class ImageHelper
{
    public static function RenameUserPhoto($uploadedFile){
        $fileExtension = image_type_to_extension(exif_imagetype($uploadedFile['tmp_name']));
        $newPhotoName = 'img_' . uniqid() . $fileExtension;
        $newPhotoPath = __DIR__ . '/catalogue/img/'.$newPhotoName;
        move_uploaded_file($uploadedFile['tmp_name'], $newPhotoPath);
        return $newPhotoName;
    }
}