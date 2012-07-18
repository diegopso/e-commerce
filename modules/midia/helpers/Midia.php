<?php

class Helper_Midia{
    public static function resize_image($filename, $image_sizes, $pathinfo = null){
        $count = count($image_sizes);
        $i = 0;
        if(!$pathinfo){
            $pathinfo = pathinfo($filename);
        }
        $place = upload_directory . $pathinfo['filename'];
        $ext = '.' . $pathinfo['extension'];
        
        while($i < $count){
            Classe_Imagem::resize($filename, $image_sizes[$i], $place . '_' . $image_sizes[$i] . $ext);
            ++$i;
        }
    }
    
    public static function remove_from_temp($file_path){
        rename(temp_directory . $file_path, upload_directory . $file_path);
    }
}
