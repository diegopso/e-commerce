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
    
    public static function get_paginas($q, $pg, $qt_pg, &$count, $type = false){
        $sql = '';
        if($q){
            $sql .= 'nome LIKE "%' . $q . '%"';
            if($type){
                $sql .= ' AND type = "' . $type . '"';
            }
        }elseif($type){
            $sql .= 'type = "' . $type . '"';
        }
        
        $db = new DatabaseQuery('Model_ViewPaginas');
        $db->whereSQL($sql);
        
        $db2 = clone $db;
        $count = $db2->count();
        
        $db->orderBy('nome', 'ASC');
        $db->limit($qt_pg, $pg * $qt_pg);
        
        return $db->all();
    }
}