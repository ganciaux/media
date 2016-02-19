<?php

class session {
	static $token='';
	public function __construct(){}
	public static function csrf_token()
	{
		if (!isset($_SESSION['csrf-token'])) {
    		self::$token = md5(uniqid(rand(), TRUE));
    		$_SESSION['csrf-token'] = self::$token;
		}
		else{
    		self::$token = $_SESSION['csrf-token'];
		}
		
		return self::$token;
	}
}