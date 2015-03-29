<?
Class Input{
	public static function exists(){
		$res = false;
	//	if(!empty($_POST[]){$res=true;}
		return $res;	
	}

	public static function get($item){
		$res='';
		if(isset($_POST[$item])){
			$res = 	$_POST[$item];
		}
		return $res;
	}
}
