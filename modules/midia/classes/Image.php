<?php

class Classe_Image{
    public static function resize($filename, $size, $destination, $max_dimension = CLASSE_IMAGE_RATIO, $compression = 75){
        $image_info = getimagesize($filename);
        $image_type = $image_info[2];
        
        if($image_type == IMAGETYPE_JPEG){
            $image = imagecreatefromjpeg($filename);
            
            if($max_dimension === CLASSE_IMAGE_RATIO){
                $image = self::resize_by_ratio($image, $size);
            }elseif($max_dimension === CLASSE_IMAGE_HEIGHT){
                $image = self::resize_by_height($image, $height);
            }else{
                $image = self::resize_by_width($image, $width);
            }
            
            imagejpeg($image, $destination, $compression);
        }elseif($image_type == IMAGETYPE_PNG){
            $image = imagecreatefrompng($filename);
            
            if($max_dimension === CLASSE_IMAGE_RATIO){
                $image = self::resize_by_ratio($image, $size);
            }elseif($max_dimension === CLASSE_IMAGE_HEIGHT){
                $image = self::resize_by_height($image, $height);
            }else{
                $image = self::resize_by_width($image, $width);
            }
            
            imagepng($image, $destination, $compression);
        }elseif($image_type == IMAGETYPE_GIF){
            $image = imagecreatefromgif($filename);
            
            if($max_dimension === CLASSE_IMAGE_RATIO){
                $image = self::resize_by_ratio($image, $size);
            }elseif($max_dimension === CLASSE_IMAGE_HEIGHT){
                $image = self::resize_by_height($image, $height);
            }else{
                $image = self::resize_by_width($image, $width);
            }
            
            imagegif($image, $destination);
        }
    }
    
    private static function resize_by_height($image, $height, $o = NULL){
        if($o){
            $o_height = $o['h'];
            $o_width = $o['w'];
        }else{
            $o_height = imagesy($image);
            $o_width = imagesx($image);
        }
        
        $ratio = $height / $o_height;
        $width = $o_width * $ratio;
        
        $new_image = imagecreatetruecolor($width, $height);
        imagecopyresampled($new_image, $image, 0, 0, 0, 0, $width, $height, $o_width, $o_height);
        return $new_image;
    }
    
    private static function resize_by_width($image, $width, $o = NULL){
        if($o){
            $o_height = $o['h'];
            $o_width = $o['w'];
        }else{
            $o_height = imagesy($image);
            $o_width = imagesx($image);
        }
        
        $ratio = $width / $o_width;
        $height = $o_height * $ratio;
        
        $new_image = imagecreatetruecolor($width, $height);
        imagecopyresampled($new_image, $image, 0, 0, 0, 0, $width, $height, $o_width, $o_height);
        return $new_image;
    }
    
    private static function resize_by_ratio($image, $size){
        $o_height = imagesy($image);
        $o_width = imagesx($image);
        
        if($o_height > $o_width){
            return self::resize_by_height($image, $size, array(
                'h' => $o_height,
                'w' => $o_width
            ));
        }else{
            return self::resize_by_width($image, $size, array(
                'h' => $o_height,
                'w' => $o_width
            ));
        }
    }
}