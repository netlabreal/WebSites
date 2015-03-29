<?
class Redirect
{
	public static function gotor($loc=null){
		if($loc){
			header('Location: '.$loc);
			exit();
		}
	}
}


?>