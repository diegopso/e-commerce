<?php

class AuthController extends Controller{
    public function index(){
        return $this->_view();
    }
    
    public function login(){
        if(is_post){
            $username = $this->post('username');
            $password = $this->post('password');
            
            $user = Helper_Auth::login($username, $password);
            
            if($user){
                return $this->_print('Bem vindo, ' . $user->username);
            }else{
                return $this->_redirect('~/auth/');
            }
        }
    }
    
    public function signup(){
        if(is_post){
            $options = array();
            $options['username'] = $this->post('username');
            $options['password'] = $this->post('password');
            
            try{
                Helper_Auth::signup($options);
                $this->_flash('SUCCESS', 'Cadastro realizado com sucesso.');
            }catch (Exception $e){
                $this->_flash('ERROR', 'Ocorreu um erro ao efetuar o cadastro.');
            }
        }
        
        return $this->_view();
    }
}
