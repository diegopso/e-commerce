<?php
class Modules{
	private static $plugins = array();
	
	public static function add($name, $path){
		self::$plugins[strtolower($name)] = $path;
	}
	
	public static function remove($name){
		unset(self::$plugins[strtolower($name)]);
	}
	
	public static function instance(){
		return self::$plugins;
	}
	
	public static function is_set($name){
		return isset(self::$plugins[strtolower($name)]);
	}
}