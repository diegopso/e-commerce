<?php

class Model_Auth extends User{
    public static function login($username, $password){
        $db = new DatabaseQuery('User');
        
        $user = $db->where('username = ?', $username)->all();
        
        if($user){
            $user = $user[0];
            
            if($user->password == $password){
                return $user;
            }
        }
        
        return false;
    }
    
    public static function signup($options){
        $user = new User();
        
        foreach ($options as $key => $value) {
            $user->{$key} = $value;
        }
        
        $user->save();
        return $user;
    }
}
