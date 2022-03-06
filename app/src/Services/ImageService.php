<?php
namespace App\Services;


class ImageService
{
    const DIR = __DIR__  . '/../../../public/uploads/images/';
    /**
     * Check User method.
     * @param object $image_obj
     * @return boolean
     */
    public function image($image_obj)
    {
        $allowTypes = ['image/jpg', 'image/png', 'image/jpeg', 'image/gif'];

        if (
            !empty($image_obj->getClientMediaType()) &&
            in_array($image_obj->getClientMediaType(), $allowTypes)
        ) {
            // Upload file to server.
            if (
                !empty($image_obj->file) &&
                move_uploaded_file($image_obj->file, SELF::DIR . $image_obj->getClientFilename())
            ) {
                return TRUE;
            }
        }
        return FALSE;
    }
}
