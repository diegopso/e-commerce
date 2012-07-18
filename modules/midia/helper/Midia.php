<?php

class Helper_Midia{
    public static function resize_image($filename, $image_sizes, $pathinfo = null){
        $count = count($iamge_sizes);
        $i = 0;
        if(!$pathinfo){
            $pathinfo = pathinfo($filename);
        }
        $place = wwwroot . 'uploads/' . $pathinfo[PATHINFO_FILENAME] . '_';
        $ext = '.' . $pathinfo[PATHINFO_EXTENSION];
        
        while($i < $count){
            Classe_Image::resize($filename, $iamge_sizes[$i], $place . $iamge_sizes[$i] . $ext);
            ++$i;
        }
    }
    
    public static function remove_from_temp($file_path){
        $novo = str_replace('/temp', '', $file_path);
        $root = root . 'app/wwwroot';
        rename($root . $file_path, $root . $novo);
    }
}
