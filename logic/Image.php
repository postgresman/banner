<?php

class Image
{
    public function create_image(){
        header("Content-Type: image/png");
        $image = @imagecreate(110, 20) or die("Create image was failed");

        $text_color = imagecolorallocate($image, 233, 14, 91);

        imagestring($image, 1, 5, 5,  "Test file", $text_color);
        imagepng($image);
        imagedestroy($image);
    }
}