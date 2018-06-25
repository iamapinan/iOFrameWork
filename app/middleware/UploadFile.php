<?php
namespace App\Middleware;

class UploadFile {
    public $dest = '';
    public $file = '';
    public $ext = '.jpg';
    public function upload_base64() {
        $this->ext = explode('/', explode(';', this()->body['image'])[0])[1];
        $image_parts = explode(";base64,", $this->file);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $file = $this->dest . uniqid() . '.' . $this->ext;
        if(file_put_contents($file, $image_base64))
        {
            return pathinfo($file);
        } else {
            return false;
        }
    }
}