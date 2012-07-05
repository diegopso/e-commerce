<?php

class Helper_Auth{
    /**
     * Efetua o login do usuario.
     * @param type $username
     * @param type $password
     * @return type 
     */
    public static function login($username, $password){
        $password = md5($password . salt);
        
        $user = Model_Auth::login($username, $password);
        
        Session::start();
        Session::set('logged_user', $user);
        
        return $user;
    }
    
    public static function logout(){
        Session::set('logged_user', false);
    }
    
    public static function get_user(){
        return Session::get('logged_user');
    }
    
    /**
     * Cria um usuario a partir das opcoes fornecidas em um array ou objeto no formato:
     * 'NomeColuna' => 'ValorColuna'
     * ou
     * $objeto->NomeColuna = ValorColuna.
     * 
     * Obs.: As posicoes ou propriedades 'username' e 'password' sao obrigatorias.
     * 
     * @param type $options 
     */
    public static function signup($options, $validation = array()){
        if(is_object($options))
            $options = (array) $options;
        
        $options['password'] = md5($options['password'] . salt);
        
        if(!self::_is_valid_username($options['username'])){
            return false;
        }
        
        if(!self::_is_valid($options, $validation)){
            return false;
        }
        
        return Model_Auth::signup($options);
    }
    
    protected static function _is_valid_username($username){
        return true;
    }
    
    protected static function _is_valid($options, $validation){
        $isValid = true;
        
        foreach ($validation as $key => $value) {
            $isValid = preg_match($value, $options[$key]) != 0;
        }
        
        return $isValid;
    }
}
