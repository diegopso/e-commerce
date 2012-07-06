<?php


class ProdutosController extends Controller{
    public function index() {
        $pg = $this->params('pg', 0);
        $qt_pg = $this->params('s', 20);
        $q = $this->params('q');
        
        $count = 0;
        $model = Helper_Produtos::get_produtos($q, $pg, $qt_pg, $count);
        
        $this->_set('count', $count);
        $this->_set('pg', $pg);
        $this->_set('qt_pg', $qt_pg);
        $this->_set('query', $q);
        return $this->_view($model);
    }
    
    public function cadastrar() {
        if(is_post){
            $properties = $this->post();
            
            try {
                $produto = Helper_Produtos::cadastrar($properties);
                $this->_flash('SUCCESS', 'Produto cadastrado com sucesso.');
                $this->_redirect('~/produtos');
                return;
            } catch (Exception $exc) {
                $this->_flash('ERROR', 'Ocorreu um erro ao cadastrar o produto. <br/>' . var_dump($exc->getMessage()));
                return $this->_view($produto);
            }
        }
        
        return $this->_view(new Model_Produto());
    }
}