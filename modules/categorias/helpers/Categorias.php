<?php

class Helper_Categorias{
    private static $validation = array(
        'nome' => array(
            'obrigatorio' => true,
            'regExp' => '@^[a-zA-Z0-9À-Ãà-ãÒ-Õò-õÈ-Êè-êÇçÌ-Îì-îÙ-Üù-ü\s\_\-\'\"\\\/\#]{1,256}$@'
        )
    );
    
    public static function get_categorias($q, $pg, $qt_pg, &$count) {
        $db = new DatabaseQuery('Model_ViewCategorias');
        
        if($q !== ''){
            $db->whereSQL("nome LIKE '%$q%'"); //pegar categorias apenas da loja cadastrada
        }
        
        $db2 = clone $db;
        $count = $db2->count();
        
        $db->orderBy('nome', 'ASC');
        $db->limit($qt_pg, $pg * $qt_pg);
        
        return $db->all();
    }
    
    public static function cadastrar($propriedades){
        $id = $propriedades['id'] ? $propriedades['id'] : null;
        $categoria = Model_Categoria::get($id);
        $categoria_properties = array_keys(get_object_vars($categoria));
        
        foreach ($categoria_properties as $k) {
            if(isset($propriedades[$k])){
                if(isset(self::$validation[$k]) && preg_match(self::$validation[$k]['regExp'], $propriedades[$k]) == 0){
                    throw new ValidationException("Formato de $k invalido.");
                }else{
                    $categoria->{$k} = $propriedades[$k];
                }
            }elseif(isset(self::$validation[$k]) && self::$validation[$k]['obrigatorio']){
                throw new ValidationException("Formato de $k invalido.");
            }
        }
        
        $categoria->save();
        return $categoria;
    }
    
    public static function excluir($id) {
        $categoria = Model_Categoria::get($id);
        
        if($id != $categoria->id)
            throw new Exception_CategoriaNaoEncontrada();
        
        $categoria->status = 'deleted';
        $categoria->save();
        return $categoria;
    }
	
	public static function desfazer_exclusao($id){
        $categoria = Model_Categoria::get($id);
        
        if($id != $categoria->id)
            throw new Exception_CategoriaNaoEncontrada();
        
        $categoria->status = 'active';
        $categoria->save();
        return $categoria;
    }
	
	public static function vincular($id_objeto, $id_categoria, $tipo_objeto = 'produto'){
		$obcat = new Model_ObjetoCategoria();
		$obcat->id_objeto = $id_objeto;
		$obcat->id_categoria = $id_categoria;
		$obcat->tipo_objeto = $tipo_objeto;
		$obcat->save();
	}
}