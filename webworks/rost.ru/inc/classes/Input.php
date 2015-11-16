<?
Class Input{
	public static function exists(){
		$res = false;
		return $res;
	}

	public static function get($item){
		$res='';
		if(isset($_POST[$item])){
			$res = 	$_POST[$item];
		}
		return $res;
	}

	public static function return_get($item){
		$res='';
		if(isset($_GET[$item])){
			$res = 	$_GET[$item];
		}
		return $res;
	}

}
