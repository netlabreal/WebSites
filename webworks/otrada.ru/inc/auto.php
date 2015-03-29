<?
require_once $_SERVER['DOCUMENT_ROOT'].'/inc/core/rinit.php';
if (!Sessions::exists("username")){
if(Input::get("login")!="" && Input::get("pass")!=""){
	$gd = new Data();
		if($gd->ProverkaUsera(Input::get("login"),Input::get("pass"))){
			Sessions::put('username',Input::get("login"));
		}
	Redirect::gotor('../admm.php');
	exit;
}
else{
	Redirect::gotor('../login.html');
}	
}
?>

