<?
define('__ROOT__', (dirname(__FILE__)));
echo __ROOT__;
require_once(__ROOT__.'/inc/classes/Sessions.php');
require_once(__ROOT__.'/inc/classes/Input.php');
require_once(__ROOT__.'/inc/classes/Redirect.php');

if (!Sessions::exists("username")){
if(Input::get("login")!="" && Input::get("pass")!=""){
	$gd = new Data();
	echo $gd->DataRandom();
		//if($gd->ProverkaUsera(Input::get("login"),Input::get("pass"))){
		//	Sessions::put('username',Input::get("login"));
		//}
	//Redirect::gotor(__ROOT__.'/obj.php');
	//Redirect::gotor('../admm.php');
	exit;
}
else{
	Redirect::gotor('../login.html');
}	
}
?>

