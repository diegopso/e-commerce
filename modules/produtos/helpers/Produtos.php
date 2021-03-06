<?php

class Helper_Produtos{
    private static $validation = array(
        'nome' => array(
            'obrigatorio' => true,
            'regExp' => '@^[a-zA-Z0-9À-Ãà-ãÒ-Õò-õÈ-Êè-êÇçÌ-Îì-îÙ-Üù-ü\s\_\-\'\"\\\/\#]{1,256}$@'
        ),
        'modelo' => array(
            'obrigatorio' => false,
            'regExp' => '@^[a-zA-Z0-9À-Ãà-ãÒ-Õò-õÈ-Êè-êÇçÌ-Îì-îÙ-Üù-ü\s\_\-\'\"\\\/\#]{0,256}$@'
        ),
        'quantidade' => array(
            'obrigatorio' => true,
            'regExp' => '@^[0-9]{1,11}$@'
        ),
        'preco' => array(
            'obrigatorio' => true,
            'regExp' => '@^[0-9]{1,9}(\.[0-9]{0,2})?$@'
        ),
        'altura' => array(
            'obrigatorio' => false,
            'regExp' => '@^[0-9]{0,9}(\.)?[0-9]{0,2}$@'
        ),
        'largura' => array(
            'obrigatorio' => false,
            'regExp' => '@^[0-9]{0,9}(\.)?[0-9]{0,2}$@'
        ),
        'comprimento' => array(
            'obrigatorio' => false,
            'regExp' => '@^[0-9]{0,9}(\.)?[0-9]{0,2}$@'
        ),
        'peso' => array(
            'obrigatorio' => false,
            'regExp' => '@^[0-9]{0,9}(\.)?[0-9]{0,2}$@'
        ),
    );
    
    public static function get_produtos($q, $pg, $qt_pg, &$count) {
        $db = new DatabaseQuery('Model_ViewProdutos');
        $db->whereSQL("nome LIKE '%$q%'"); //pegar produtos apenas da loja cadastrada
        
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
        $produtos_properties = array_keys(get_object_vars($produto));
        
        foreach ($produtos_properties as $k) {
            if(isset($propriedades[$k])){
                if(isset(self::$validation[$k]) && preg_match(self::$validation[$k]['regExp'], $propriedades[$k]) == 0){
                    throw new ValidationException("Formato de $k invalido.");
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
    
    public static function adicionar_palavras_chave($id_produto, $palavra){
        $palavra_chave = Palavrachave::get();
        $palavra_chave->palavra = $palavra;
        $palavra_chave->id_objeto = $id_produto;
        $palavra_chave->tipo_objeto = 'produto';
        
        $palavra_chave->save();
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