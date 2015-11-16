<?

class Config{
	public static function get($path = null){
	$res = "";	
		if($path){
			$config = $GLOBALS['config'];
			if(isset($config[$path])){
				$res = $config[$path];					
			}
		}
	return $res;
	}	

}
