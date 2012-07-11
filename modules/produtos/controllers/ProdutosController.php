<?php


class ProdutosController extends Controller{
    
    public function index($q = '', $pg = 0, $qt_pg = 1) {
        $pg = $this->params('pg', 0);
        $qt_pg = $this->params('s', 1);
        $q = $this->params('q');
        $render_type = $this->params('r', 'page');
        
        $count = 0;
        $model = Helper_Produtos::get_produtos($q, $pg, $qt_pg, $count);
        
        $qt_pg = ceil($count / $qt_pg);
        
        $this->_set('count', $count);
        $this->_set('pg', $pg);
        $this->_set('qt_pg', $qt_pg);
        $this->_set('query', $q);
        
        if($render_type == 'html')
            return $this->_page('listaprodutos', $model);
        
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
            
            try {
                $pg = array(
                    'titulo' => $properties['name'],
                    'subtitulo' => $properties['modelo'],
                    'conteudo' => $properties['conteudo'],
                    'data' => time(),
                    'tipo' => 'produto',
                    'id_autor' => $properties['id_autor'], 
                    'id_loja' => $properties['id_loja']
                );
                
                //implementar estes métodos
                //$pagina = Helper_Pagina::cadastrar($pg);
                //$files = Helper_Midia::save_files($_FILES, $pagina->id);

                //$properties['id_pagina'] = $pagina->id;
                //$properties['id_imagem'] = $files['principal']->id;
                
                $produto = Helper_Produtos::cadastrar($properties);
                
                //Helper_Categorias::set_categorias($produto->id, $properties['categorias']);
                
                $this->_flash('SUCCESS', 'Produto cadastrado com sucesso.');
                $this->_redirect('~/produtos');
                return;
            } catch (Exception $exc) {
                $this->_flash('ERROR', 'Ocorreu um erro ao cadastrar o produto.');
                return $this->_view($produto);
            }
        }
        
        $produto = Model_Produto::get($id);
        
        if($id != $produto->id)
            throw new Exception_ProdutoNaoEncontrado();
        
        return $this->_view($produto);
    }
    
    public function excluir($id) {
        try {
            Helper_Produtos::excluir($id);
            $this->_flash('SUCCESS', 'O produto foi excluído.');
            return $this->_json(array(
                'status' => 'SUCCESS',
                'message' => 'O produto foi excluído.'
            ));
        } catch (Exception $exc) {
            $this->_flash('ERROR', 'Ocorreu um erro ao excluir o produto.');
            return $this->_json(array(
                'status' => 'ERROR',
                'message' => 'Ocorreu um erro ao excluir o produto.'
            ));
        }
    }
}