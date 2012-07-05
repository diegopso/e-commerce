<?php
class Request{
	private $url;
	private $query;
	private $method;
	
	public static function factory($uri = ''){
		if($uri[0] == '/'){
			$url = str_replace(root_virtual, '/', site_url) . $uri;
		}else{
			$url = site_url . $uri;
		}
		
		return new self($url);
	}
	
	public function __construct($url, $method = 'GET'){
		$this->url = $url;
		$this->method = $method;
		$this->query = array();
	}
	
	public static function array2query($data){
		$query_str = '';
		foreach($data as $k => $v){
			$query_str .= '&' . $k . '=' . $v;
		}
		
		return '?' . substr($query_str, 1);
	}
	
	public function query($data){
		$this->query = $data;
		return $this;
	}
	
	public function method($type = 'GET'){
		$this->method = strtoupper($type);
		return $this;
	}
	
	
	public function execute(){
		if($this->method == 'GET'){
			return file_get_contents($this->url . self::array2query($this->query));
		}else{
			if(!function_exists(curl_init))
				throw new MethodNotFoundException('curl_init');
				
			$ch = curl_init($this->url);
			 
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $this->data);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			 
			$response = curl_exec($ch);
			curl_close($ch);
			
			return $response;
		}
	} 
}