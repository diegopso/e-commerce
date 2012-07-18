<?php
class ConteudosController extends Controller{
    public function index(){
        $pg = $this->params('pg', 0);
        $qt_pg = $this->params('s', 10);
        $q = $this->params('q');
        $render_type = $this->params('r', 'page');
        
        $count = 0;
        $model = Helper_Conteudos::get_paginas($q, $pg, $qt_pg, $count, 'conteudo', 'Listar');
        
        $qt_pg = ceil($count / $qt_pg);
        
        $this->_set('count', $count);
        $this->_set('pg', $pg);
        $this->_set('qt_pg', $qt_pg);
        $this->_set('query', $q);
        
        if($render_type == 'html')
            return $this->_page('_snippet', 'listaconteudos', $model);
        
        if($render_type == 'json')
            return $this->_json(array(
                'model' => $model,
                'count' => $count,
                'pg' => $pg,
                'qt_pg' => $qt_pg,
                'query' => $q
            ));
        
        return $this->_view($model);
    }
    
    public function cadastrar($id = null) {
        if(is_post){
            $properties = $this->post();
            $properties['id_loja'] = 0; //loja do usuario logado
            $properties['id_autor'] = 0; //colocar usuario logado
            $properties['status'] = 'active';
            
            try {
                $db = Database::getInstance();
                $db->transaction();
                
                $conteudo = Helper_Conteudos::cadastrar($properties);
                
                $count = count($properties['filename']);
                $id_pagina = $conteudo->id;
                for ($i = 0; $i < $count; ++$i) {
                    Helper_Conteudos::vincular_arquivo($properties['filename'][$i], $properties['nome_original'][$i], $id_pagina);
                }
                
                if(isset($properties['palavras_chave'])){
                    $palavras_chave = $properties['palavras_chave'];
                    $palavras_chave = preg_replace('([\s]{2,})', ' ', $palavras_chave);
                    $palavras_chave = str_replace('; ', ';', $palavras_chave);
                    $palavras_chave = preg_replace('@[;]{2,}@', ';', $palavras_chave);
                    $palavras_chave = preg_replace('@;$@', '', $palavras_chave);
                    $palavras_chave = preg_replace('@^;@', '', $palavras_chave);
                    
                    $palavras = explode(';', $palavras_chave);
                    foreach ($palavras as $value) {
                        Helper_Conteudos::adicionar_palavra_chave($conteudo->id, trim($value));
                    }
                }
                
                //Helper_Categorias::set_categorias($conteudo->id, $properties['categorias']);
                
                $db->commit();
                $this->_flash('flash-message alert alert-success', 'Conteúdo cadastrado com sucesso.');
                $this->_redirect('~/conteudos');    
                return;
            } catch (Exception $exc) {
                $db->rollback();
                $this->_flash('flash-message alert alert-error', 'Ocorreu um erro ao cadastrar o conteúdo.' . var_dump($exc));
                return $this->_view($conteudo);
            }
        }
        
        $conteudo = Model_Pagina::get($id);
        
        if($id != $conteudo->id)
            throw new Exception_ContudoNaoEncontrado();
        
        return $this->_view($conteudo);
    }
    
    public function excluir($id) {
        try {
            $conteudo = Helper_Conteudos::excluir($id);
            $this->_flash('flash-message alert alert-success', 'O conteúdo foi excluído.');
            return $this->_json(array(
                'status' => 'flash-message alert alert-success',
                'message' => 'O conteúdo foi excluído.',
                'model' => $conteudo
            ));
        } catch (Exception $exc) {
            $this->_flash('flash-message alert alert-error', 'Ocorreu um erro ao excluir o conteúdo.');
            return $this->_json(array(
                'status' => 'flash-message alert alert-error',
                'message' => 'Ocorreu um erro ao excluir o conteúdo.'
            ));
        }
    }
    
    public function desfazerexclusao($id){
        try {
            $conteudo = Helper_Conteudos::desfazer_exclusao($id);
            $this->_flash('flash-message alert alert-success', 'Ação desfeita.');
            return $this->_json(array(
                'status' => 'flash-message alert alert-success',
                'message' => 'Ação desfeita.',
                'model' => $conteudo
            ));
        } catch (Exception $exc) {
            $this->_flash('flash-message alert alert-error', 'Ocorreu um erro ao desfazer.');
            return $this->_json(array(
                'status' => 'flash-message alert alert-error',
                'message' => 'Ocorreu um erro ao desfazer.'
            ));
        }
    }
}