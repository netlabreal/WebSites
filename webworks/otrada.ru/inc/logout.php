<?
require_once $_SERVER['DOCUMENT_ROOT'].'/inc/core/rinit.php';
	Sessions::delete("username");
	Redirect::gotor('../admm.php');
	exit;
?>	