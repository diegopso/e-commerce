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
    
    public function ExcluirArquivo($id, $id_pagina){
        try {
            $arquivo = Helper_Midia::excluir($id);
            $conteudo = Model_ViewPaginas::get($id_pagina);
            return $this->_page('_snippet', 'listarimagens', $conteudo);
        } catch (Exception $exc) {
            $this->_flash('flash-message alert alert-error', 'Ocorreu um erro ao excluir o conteúdo.');
            return $this->_json(array(
                'status' => 'flash-message alert alert-error',
                'message' => 'Ocorreu um erro ao excluir o conteúdo.'
            ));
        }
    }
}