<?php

class Classe_Imagem{
    public static function resize($filename, $size, $destination, $max_dimension = CLASSE_IMAGEM_RATIO, $compression = 75){
        $path = temp_directory . $filename;
        $image_info = getimagesize($path);
        $image_type = $image_info[2];
        
        if($image_type == IMAGETYPE_JPEG){
            $image = imagecreatefromjpeg($path);
            $o_height = imagesy($image);
            $o_width = imagesx($image);
            
            if($max_dimension === CLASSE_IMAGEM_RATIO){
                $image = self::resize_by_ratio($image, $size, $o_height, $o_width);
            }elseif($max_dimension === CLASSE_IMAGEM_HEIGHT){
                $image = self::resize_by_height($image, $size, $o_height, $o_width);
            }else{
                $image = self::resize_by_width($image, $size, $o_height, $o_width);
            }
            
            imagejpeg($image, $destination, $compression);
        }elseif($image_type == IMAGETYPE_PNG){
            $image = imagecreatefrompng($path);
            
            if($max_dimension === CLASSE_IMAGEM_RATIO){
                $image = self::resize_by_ratio($image, $size, $o_height, $o_width);
            }elseif($max_dimension === CLASSE_IMAGEM_HEIGHT){
                $image = self::resize_by_height($image, $size, $o_height, $o_width);
            }else{
                $image = self::resize_by_width($image, $size, $o_height, $o_width);
            }
            
            imagepng($image, $destination, $compression);
        }elseif($image_type == IMAGETYPE_GIF){
            $image = imagecreatefromgif($path);
            
            if($max_dimension === CLASSE_IMAGEM_RATIO){
                $image = self::resize_by_ratio($image, $size, $o_height, $o_width);
            }elseif($max_dimension === CLASSE_IMAGEM_HEIGHT){
                $image = self::resize_by_height($image, $size, $o_height, $o_width);
            }else{
                $image = self::resize_by_width($image, $size, $o_height, $o_width);
            }
            
            imagegif($image, $destination);
        }
    }
    
    private static function resize_by_height($image, $height, $o_height, $o_width){
        $ratio = $height / $o_height;
        $width = $o_width * $ratio;
        
        $new_image = imagecreatetruecolor($width, $height);
        imagecopyresampled($new_image, $image, 0, 0, 0, 0, $width, $height, $o_width, $o_height);
        return $new_image;
    }
    
    private static function resize_by_width($image, $width, $o_height, $o_width){
        $ratio = $width / $o_width;
        $height = $o_height * $ratio;
        
        $new_image = imagecreatetruecolor($width, $height);
        imagecopyresampled($new_image, $image, 0, 0, 0, 0, $width, $height, $o_width, $o_height);
        return $new_image;
    }
    
    private static function resize_by_ratio($image, $size, $o_height, $o_width){
        if($o_height > $o_width){
            return self::resize_by_height($image, $size, $o_height, $o_width);
        }else{
            return self::resize_by_width($image, $size, $o_height, $o_width);
        }
    }
}