<?php

class Classe_qqFileUploader {
    private $allowedExtensions = array('jpg', 'png', 'jpeg', 'gif');
    private $sizeLimit = 8388608;
    private $file;

    function __construct(array $allowedExtensions = null, $sizeLimit = 8388608){        
        $allowedExtensions = array_map("strtolower", $allowedExtensions);
            
        if($allowedExtensions)
            $this->allowedExtensions = $allowedExtensions;        
        
        $this->sizeLimit = $sizeLimit;
        
        $this->checkServerSettings();       

        if (isset($_GET['qqfile'])) {
            $this->file = new Classe_qqUploadedFileXhr();
        } elseif (isset($_FILES['qqfile'])) {
            $this->file = new Classe_qqUploadedFileForm();
        } else {
            $this->file = false; 
        }
    }
    
    private function checkServerSettings(){
        $postSize = $this->toBytes(ini_get('post_max_size'));
        $uploadSize = $this->toBytes(ini_get('upload_max_filesize'));        
        
        if ($postSize < $this->sizeLimit || $uploadSize < $this->sizeLimit){
            $size = max(1, $this->sizeLimit / 1024 / 1024) . 'M';
            
            die("{'error':'Upload max size ". $postSize . '=>' . $this->sizeLimit ." exceded.', 'error_type':'size_limit_exceded'}");
        }        
    }
    
    private function toBytes($str){
        $val = trim($str);
        $last = strtolower($str[strlen($str)-1]);
        switch($last) {
            case 'g': $val *= 1024;
            case 'm': $val *= 1024;
            case 'k': $val *= 1024;        
        }
        return $val;
    }
    
    /**
     * Returns array('success'=>true) or array('error'=>'error message')
     */
    function handleUpload($uploadDirectory, $replaceOldFile = FALSE){
        if (!is_writable($uploadDirectory)){
            die("{'error':'Not writable directory.', 'error_type':'permission'}");
        }
        
        if (!$this->file){
            die("{'error':'No files sended.', 'error_type':'no files'}");
        }
        
        $size = $this->file->getSize();
        
        if ($size == 0) {
            die("{'error':'No files sended.', 'error_type':'no files'}");
        }
        
        if ($size > $this->sizeLimit) {
            die("{'error':'Upload max size ". $size ." exceded.', 'error_type':'size_limit_exceded'}");
        }
        
        $pathinfo = pathinfo($this->file->getName());
        //$filename = Text::slug($pathinfo['filename']);
        $filename = md5(uniqid());
        $ext = $pathinfo['extension'];

        if($this->allowedExtensions && !in_array(strtolower($ext), $this->allowedExtensions)){
            $these = implode(', ', $this->allowedExtensions);
            die("{'error':'Unsuported image type.', 'error_type':'unsuported type'}");
        }
        
        if(!$replaceOldFile){
            /// don't overwrite previous files that were uploaded
            while (file_exists($uploadDirectory . $filename . '.' . $ext)) {
                $filename .= rand(10, 99);
            }
        }
        
        if ($this->file->save($uploadDirectory . $filename . '.' . $ext)){
            return array(
                'success'=> true, 
                'fileName'=> $uploadDirectory . $filename . '.' . $ext,
                'ext' => $ext,
                'basename' => $filename,
                'original_name' => $pathinfo['filename']
            );
        } else {
            die("{'error':'ERROR.', 'error_type':'unknow'}");
        }
        
    }    
}
