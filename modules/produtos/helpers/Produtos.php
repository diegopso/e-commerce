<?php

class Helper_Produtos{
    private static $validation = array(
        'nome' => array(
            'obrigatorio' => false,
            'regExp' => '@([a-zA-Z0-9\s\-\.\_])@'
        )
    );
    
    public static function get_produtos($q, $pg, $qt_pg, &$count) {
        $db = new DatabaseQuery('Model_Produto');
        $db->whereSQL("nome LIKE '%$q%'");
        
        $db2 = clone $db;
        $count = $db2->count();
        
        $db->orderBy('nome', 'ASC');
        $db->limit($qt_pg, $pg * $qt_pg);
        
        return $db->all();
    }
    
    public static function cadastrar($propriedades){
        //be safe
        if(is_object($propriedades))
            $propriedades = (array) $propriedades;
        
        $id = $propriedades['id'] ? $propriedades['id'] : null;
        $produto = Model_Produto::get($id);
        $produtos_properties = Model_Produto::get_properties_name();
        
        foreach ($produtos_properties as $k) {
            if(isset($propriedades[$k])){
                if(isset(self::$validation[$k]) && preg_match(self::$validation[$k]['regExp'], $propriedades[$k]) == 0){
                    throw new ValidationException();
                }else{
                    $produto->{$k} = $propriedades[$k];
                }
            }elseif(isset(self::$validation[$k]) && self::$validation[$k]['obrigatorio']){
                throw new ValidationException("Formato de $k invalido.");
            }
        }
        
        $produto->save();
        return $produto;
    }
    
    public static function excluir($id) {
        $produto = Model_Produto::get($id);
        
        if($id != $produto->id)
            throw new Exception_ProdutoNaoEncontrado();
        
        $produto->status = 'deleted';
        $produto->save();
        return $produto;
    }
    
    public static function desfazer_exclusao($id){
        $produto = Model_Produto::get($id);
        
        if($id != $produto->id)
            throw new Exception_ProdutoNaoEncontrado();
        
        $produto->status = 'active';
        $produto->save();
        return $produto;
    }
}