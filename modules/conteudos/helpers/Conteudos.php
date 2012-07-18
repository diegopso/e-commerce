<?php

class Helper_Conteudos{
    private static $validation = array(
        'titulo' => array(
            'obrigatorio' => true,
            'regExp' => '@^[a-zA-Z0-9À-Ãà-ãÒ-Õò-õÈ-Êè-êÇçÌ-Îì-îÙ-Üù-ü\s\_\-\'\"\\\/\#]{1,256}$@'
        ),
        'subtitulo' => array(
            'obrigatorio' => false,
            'regExp' => '@^[a-zA-Z0-9À-Ãà-ãÒ-Õò-õÈ-Êè-êÇçÌ-Îì-îÙ-Üù-ü\s\_\-\'\"\\\/\#]{0,256}$@'
        ),
        'conteudo' => array(
            'obrigatorio' => true,
            'regExp' => '@(.*)@'
        )
    );
    
    public static function get_paginas($q, $pg, $qt_pg, &$count, $type = false, $sufix = ''){
        $sql = '';
        if($q){
            $sql .= 'nome LIKE "%' . $q . '%"';
            if($type){
                $sql .= ' AND type = "' . $type . '"';
            }
        }elseif($type){
            $sql .= 'type = "' . $type . '"';
        }
        
        $db = new DatabaseQuery('Model_ViewPaginas' . $sufix);
        $db->whereSQL($sql);
        
        $db2 = clone $db;
        $count = $db2->count();
        
        $db->orderBy('nome', 'ASC');
        $db->limit($qt_pg, $pg * $qt_pg);
        
        return $db->all();
    }
    
    public static function cadastrar($propriedades){
        $pagina = Model_Pagina::get($propriedades['id']);
        $pagina_properties = Model_Pagina::get_properties_name();
        
        foreach ($pagina_properties as $k) {
            if(isset($propriedades[$k])){
                if(isset(self::$validation[$k]) && preg_match(self::$validation[$k]['regExp'], $propriedades[$k]) === 0){
                    throw new ValidationException('Formato de '.$k.' inválido.');
                }else{
                    $pagina->{$k} = $propriedades[$k];
                }
            }elseif(isset(self::$validation[$k]) && self::$validation[$k]['obrigatorio']){
                throw new ValidationException('Formato de '.$k.' inválido.');
            }
        }
        
        $pagina->save();
        return $pagina;
    }
    
    public static function excluir($id) {
        $pagina = Model_Pagina::get($id);
        
        if($id != $pagina->id)
            throw new Exception_ConteudoNaoEncontrado();
        
        $pagina->status = 'deleted';
        $pagina->save();
        return $pagina;
    }
    
    public static function desfazer_exclusao($id){
        $pagina = Model_Pagina::get($id);
        
        if($id != $pagina->id)
            throw new Exception_ConteudoNaoEncontrado();
        
        $pagina->status = 'active';
        $pagina->save();
        return $pagina;
    }
    
    public static function adicionar_palavra_chave($id_pagina, $palavra){
        $palavra_chave = new Palavrachave();
        $palavra_chave->palavra = $palavra;
        $palavra_chave->id_objeto = $id_pagina;
        $palavra_chave->tipo_objeto = 'pagina';
        
        $palavra_chave->save();
    }
    
    public static function vincular_arquivo($filepath, $filename, $id_pagina, $image_sizes = array(256, 128)){
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $filepath);
        finfo_close($finfo);
        
        $pathinfo = pathinfo($filepath);
        
        $ext = '.' . $pathinfo[PATHINFO_EXTENSION];
        $caminho = $pathinfo[PATHINFO_FILENAME];
        
        if(strpos($mime, 'image') !== false){
            Helper_Midia::resize_image($filepath, $image_sizes, $pathinfo);
        }else{
            Helper_Midia::remove_from_temp($filepath);
        }
        
        $arquivo = new Model_Arquivo();
        $arquivo->caminho = $caminho;
        $arquivo->extensao = $ext;
        $arquivo->mimetype = $mime;
        $arquivo->nome_original = $filename;
        $arquivo->id_pagina = $id_pagina;
        $arquivo->id_loja = $id_loja;
        
        $arquivo->save();
    }
}