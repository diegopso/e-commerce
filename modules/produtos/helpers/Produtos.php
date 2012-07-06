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
    
    public static function cadastrar($properties){
        $produto = Produto::get(isset($properties['id']) ? $properties['id'] : null);
        
        foreach (self::$validation as $key => $value) {
            if(isset($properties[$key])){
                if(preg_match($value['regExp'], $properties[$key]) == 0){
                    throw new ValidationException();
                }else{
                    $produto->{$key} = $properties[$key];
                }
            }elseif($value['obrigatorio']){
                throw new ValidationException();
            }
        }
        
        $produto->save();
        return $produto;
    }
}