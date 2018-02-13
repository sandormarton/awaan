<?php
/**
 * Created by PhpStorm.
 * User: majd
 * Date: 12/27/2017
 * Time: 1:44 PM
 */

namespace App\Providers;

class TextToImage {
    private $img;

    /**
     * Display image
     */
    function showImage(){
        header('Content-Type: image/png');
        return imagepng($this->img);
    }

    /**
     * Create image from text
     * @param string text to convert into image
     * @param int font size of text
     * @param int width of the image
     * @param int height of the image
     * @param string bg url of the background
     */
    function createImage($text, $fontSize = 22, $angle = 0, $imgWidth = 400, $imgHeight = 80){

        //text font path
        $font = public_path("fonts/HelveticaNeueMEforSKY-Reg/HelveticaNeueMEforSKY-Reg.ttf");
        $bg= public_path('images/viewed-videos.jpg');
        /* Attempt to open */
        $this->img = @imagecreatefromjpeg($bg);
        //create the image
        //$this->img = imagecreatetruecolor($imgWidth, $imgHeight);

        //create some colors
        $white = imagecolorallocate($this->img, 255, 255, 255);
        $grey = imagecolorallocate($this->img, 128, 128, 128);
        $black = imagecolorallocate($this->img, 0, 0, 0);
        imagefilledrectangle($this->img, 0, 50, $imgWidth - 1, $imgHeight - 1, $white);

        //break lines
        $splitText = explode ( "\\n" , $text );
        $lines = count($splitText);

        foreach($splitText as $txt){
            $textBox = imagettfbbox($fontSize,$angle,$font,$txt);
            $textWidth = abs(max($textBox[2], $textBox[4]));
            $textHeight = abs(max($textBox[5], $textBox[7]));
            $x = ((imagesx($this->img) - $textWidth)/2) + 48;
            //$y = ((imagesy($this->img) + $textHeight)/2)-($lines-2)*$textHeight;
            $y=385;
            $lines = $lines-1;

            //add some shadow to the text
            imagettftext($this->img, $fontSize, $angle, $x, $y, $grey, $font, $txt);

            //add the text
            imagettftext($this->img, $fontSize, $angle, $x, $y, $black, $font, $txt);
        }
        return true;
    }

    /**
     * Save image as png format
     * @param string file name to save
     * @param string location to save image file
     */
    function saveAsPng($fileName = 'text-image', $location = ''){
        header('Content-Type: image/png');
        $fileName = $fileName.".png";
        $fileName = !empty($location)?$location.$fileName:$fileName;
        return imagepng($this->img, $fileName);
    }

    /**
     * Save image as jpg format
     * @param string file name to save
     * @param string location to save image file
     */
    function saveAsJpg($fileName = 'text-image', $location = ''){
        header( "Content-type: image/jpg; charset=utf-8" );
        $fileName = $fileName.".jpg";
        $fileName = !empty($location)?$location.$fileName:$fileName;
        return imagejpeg($this->img, $fileName);
    }
}