<?php


class CategoriasController extends Controller{
    public function index() {
        $pg = $this->params('pg', 0);
        $qt_pg = $this->params('s', 10);
        $q = $this->params('q');
        $render_type = $this->params('r', 'page');
        
        $count = 0;
        $model = Helper_Categorias::get_categorias($q, $pg, $qt_pg, $count);
        
        $qt_pg = ceil($count / $qt_pg);
        
        $this->_set('count', $count);
        $this->_set('pg', $pg);
        $this->_set('qt_pg', $qt_pg);
        $this->_set('query', $q);
        
        if($render_type === 'html')
            return $this->_page('_snippet', 'listacategorias', $model);
        
        if($render_type === 'json')
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
            $properties['status'] = 'active';
            
            try {
                $db = Database::getInstance();
                $db->transaction();
                
                $categoria = Helper_Categorias::cadastrar($properties);
                
                $db->commit();
                
                $this->_flash('flash-message alert alert-success', 'Categoria cadastrada com sucesso.');
                
                return $this->_json(array(
                    'model' => $categoria,
                ));
            } catch (Exception $exc) {
                $db->rollback();
                $this->_flash('flash-message alert alert-error', 'Ocorreu um erro ao cadastrar a categoria.');
                return $this->_view($categoria);
            }
        }
        
        $categoria = Model_Categoria::get($id);
        
        if($id != $categoria->id)
            throw new Exception_CategoriaNaoEncontrada();
        
        return $this->_view($categoria);
    }
    
    public function excluir($id) {
        try {
            $categoria = Helper_Categorias::excluir($id);
            $this->_flash('flash-message alert alert-success', 'A categoria foi excluída.');
            return $this->_json(array(
                'status' => 'flash-message alert alert-success',
                'message' => 'A categoria foi excluída.',
                'model' => $categoria
            ));
        } catch (Exception $exc) {
            $this->_flash('flash-message alert alert-error', 'Ocorreu um erro ao excluir a categoria.');
            return $this->_json(array(
                'status' => 'flash-message alert alert-error',
                'message' => 'Ocorreu um erro ao excluir a categoria.'
            ));
        }
    }
    
    public function desfazerexclusao($id){
        try {
            $produto = Helper_Produtos::desfazer_exclusao($id);
            $this->_flash('flash-message alert alert-success', 'Ação desfeita.');
            return $this->_json(array(
                'status' => 'flash-message alert alert-success',
                'message' => 'Ação desfeita.',
                'model' => $produto
            ));
        } catch (Exception $exc) {
            $this->_flash('flash-message alert alert-error', 'Ocorreu um erro ao desfazer.');
            return $this->_json(array(
                'status' => 'flash-message alert alert-error',
                'message' => 'Ocorreu um erro ao desfazer.'
            ));
        }
    }
    
    public function EnviarImagens(){
        return $this->_view();
    }
    
    public function editor(){
        return $this->_view();
    }
}