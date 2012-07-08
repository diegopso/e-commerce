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
        
        foreach (self::$validation as $k => $v) {
            if(isset($propriedades[$k])){
                if(preg_match($v['regExp'], $propriedades[$k]) == 0){
                    throw new ValidationException();
                }
            }elseif($value['obrigatorio']){
                throw new ValidationException("Formato de $k invalido.");
            }
        }
        
        foreach ($propriedades as $k => $p) {
            $produto->{$k} = $p;
        }
        
        $produto->save();
        return $produto;
    }
    
    public static function excluir($id) {
        $produto = Model_Produto::get($id);
        
        if($id != $produto->id)
            throw new Exception_ProdutoNaoEncontrado();
        
        $produto->delete();
    }
}