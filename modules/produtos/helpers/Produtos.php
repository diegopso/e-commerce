<?php

class Helper_Produtos{
    private static $validation = array(
        'nome' => array(
            'obrigatorio' => false,
            'regExp' => '@([a-zA-Z0-9\s\-\.\_])@'
        )
    );
    
    public static function get_produtos($q, $pg, $qt_pg, &$count) {
        $db = new DatabaseQuery('Produto');
        $db->whereSQL("nome LIKE '%$q%'");
        
        $db2 = clone $db;
        $count = $db2->count();
        
        $db->orderBy('nome', 'ASC');
        $db->limit($qt_pg, $pg * $qt_pg);
        
        return $db->all();
    }
    
    public static function cadastrar($propriedades){
        $produto = Produto::get($propriedades['id'] ? $propriedades['id'] : null);
        
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
        $produto = Produto::get($id);
        $produto->delete();
    }
}