<?
session_start();
//require_once $_SERVER['DOCUMENT_ROOT'].'/inc/core/rinit.php';
define('__ROOT__', (dirname(__FILE__)));
require_once(__ROOT__.'/classes/Sessions.php');
require_once(__ROOT__.'/classes/Redirect.php');

	Sessions::delete("username");
	Redirect::gotor('../login.html');
	exit;
?>	