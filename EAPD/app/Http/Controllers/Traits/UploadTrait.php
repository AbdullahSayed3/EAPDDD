<?php

namespace App\Http\Controllers\Traits;

use Illuminate\Support\Facades\Storage;

trait UploadTrait
{
    public function uploadFile($field, $foldername)
    {

        if ($field != null) {

            $destinationPath = 'uploads/'.$foldername;
            $imageName = '';
            $imageName = $this->uploadFileOrMultiUpload($field, $destinationPath);

            return $imageName;
        }

        return '';
    }

    public function uploadFileWithId($field, $userId, $foldername)
    {

        if ($field != null) {

            $destinationPath = 'uploads/'.$foldername.'/'.$userId;
            $all = [];
            $imageName = '';
            $imageName = $this->uploadFileOrMultiUpload($field, $destinationPath);

            return $imageName;
        }

        return '';
    }

    protected function uploadFileOrMultiUpload($image, $destinationPath)
    {
        $extension = $image->getClientOriginalExtension();
        $fileName = rand(11111, 99999).'_'.time().'.'.$extension;
        // ##delete oldimage

        if ($image->move($destinationPath, $fileName)) {
            return $fileName;
        }
    }

    public function updateFile($field, $oldImageName, $foldername)
    {

        if ($field != null) {

            $destinationPath = 'uploads/'.$foldername;
            $imageName = '';
            $imageName = $this->updateFileOrMultiUpload($field, $oldImageName, $destinationPath);

            return $imageName;
        }

        return '';
    }

    protected function updateFileOrMultiUpload($image, $oldImageName, $destinationPath)
    {
        $extension = $image->getClientOriginalExtension();
        $fileName = rand(11111, 99999).'_'.time().'.'.$extension;
        // ##delete oldimage
        // ##delete oldimage
        if ($oldImageName == 'no-image') {

        } else {
            if (file_exists($destinationPath.'/'.$oldImageName)) {
                chmod($destinationPath.'/'.$oldImageName, 0777);
                unlink($destinationPath.'/'.$oldImageName);
            }
        }

        if ($image->move($destinationPath, $fileName)) {
            return $fileName;
        }
    }

    
    

    public function deleteFile($fileName, $filePath)
    {
        $fullPath = public_path($filePath . '/' . $fileName);        
        if (file_exists($fullPath)) {
            if (unlink($fullPath)) {
                return true;
            }
            error_log("Failed to delete file: {$fullPath}");
            return false;
        }

        error_log("File not found: {$fullPath}");
        return false;
    }
}
