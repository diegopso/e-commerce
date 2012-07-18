<?php
class MidiaController extends Controller{
    public function AjaxUpload(){
        try {
            $uploader = new Classe_qqFileUploader();
            $result = $uploader->handleUpload(wwwroot . 'uploads/temp/');
            $this->_flash('SUCCESS', 'Imagem enviada.');
            return $this->_json(array(
                'status' => 'SUCCESS',
                'message' => 'Imagem enviada.',
                'model' => $result
            ));
        } catch (Exception $exc) {
            $this->_flash('ERROR', 'Ocorreu um erro ao enviar a imagem.');
            return $this->_json(array(
                'status' => 'ERROR',
                'message' => 'Ocorreu um erro ao enviar a imagem.'
            ));
        }
    }
}