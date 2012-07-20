<?php
/** @Entity("viewpaginas") */
class Model_ViewPaginas extends Model
{
    /** @Column(Type="int(11)") */
    public $id;

    /** @Column(Type="varchar(256)") */
    public $titulo;

    /** @Column(Type="varchar(256)") */
    public $subtitulo;

    /** @Column(Type="text") */
    public $conteudo;

    /** @Column(Type="int(11)") */
    public $data;

    /** @Column(Type="varchar(32)") */
    public $tipo;

    /** @Column(Type="varchar(8)") */
    public $status;

    /** @Column(Type="varchar(256)") */
    public $palavras_chave;

    /** @Column(Type="int(11)") */
    public $id_autor;

    /** @Column(Type="int(11)") */
    public $id_loja;

    /** @Column(Type="int(11)") */
    public $id_arquivo;

    /** @Column(Type="varchar(256)") */
    public $caminho;

    /** @Column(Type="varchar(8)") */
    public $extensao;

    /** @Column(Type="varchar(256)") */
    public $nome_original;

    /** @Column(Type="varchar(16)") */
    public $mimetype;

    /** @Column(Type="varchar(6)") */
    public $nome_autor;
    
    public static function get($id){
        $db = new DatabaseQuery('Model_ViewPaginas');
        $db->whereSQL('id = '.$id);
        $rs = $db->all();
        $count = count($rs);
        
        if($count === 0)
            throw new Exception_ConteudoNaoEncontrado();
        
        $result = $rs[0];
        $result->arquivos = array();
        if($result->id_arquivo){
            for ($i = 0; $i < $count; ++$i) {
                $result->arquivos[$i] = new stdClass();
                $result->arquivos[$i]->id_arquivo = $rs[$i]->id_arquivo;
                $result->arquivos[$i]->caminho = $rs[$i]->caminho;
                $result->arquivos[$i]->extensao = $rs[$i]->extensao;
                $result->arquivos[$i]->nome_original = $rs[$i]->nome_original;
                $result->arquivos[$i]->mimetype = $rs[$i]->mimetype;
            }
        }
        
        return $result;
    }


}