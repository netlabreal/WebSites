<?php
session_start();
define('__ROOT__', (dirname(__FILE__)));
$GLOBALS['config'] = array('host' => 'mysql52.1gb.ru', 'user'=>'gb_ost','pass'=>'d84346af3op','dbname'=>'gb_ost','path'=>'../img/data/');

require_once(__ROOT__.'/inc/classes/Sessions.php');
require_once(__ROOT__.'/inc/classes/Input.php');
require_once(__ROOT__.'/inc/classes/Redirect.php');
require_once(__ROOT__.'/inc/classes/Data.php');
require_once(__ROOT__.'/inc/classes/Db.php');
require_once(__ROOT__.'/inc/classes/Config.php');
require_once(__ROOT__.'/inc/classes/Foto.php');


if (!Sessions::exists("username")){
	if(Input::get("login")!="" && Input::get("pass")!=""){
		$gd = new Data();

		if($gd->ProverkaUsera(Input::get("login"),Input::get("pass"))==1) {
			Sessions::put('username', Input::get("login"));
			//*****************************************************//
			Redirect::gotor('../admm.php');
			//*****************************************************//
			//echo Sessions::get('username');
		}
		else{
			Redirect::gotor('../login.html');
		}
	}
	else{
		Redirect::gotor('../login.html');
	}
	exit;
}
else
{echo 'RRRRRR!';}
?>
