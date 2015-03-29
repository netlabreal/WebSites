<?
session_start();
$GLOBALS['config'] = array('host' => 'localhost', 'user'=>'lab','pass'=>'ghjcnjq','dbname'=>'otrada','path'=>'../img/data/');

spl_autoload_register(function($class){
	require_once $_SERVER['DOCUMENT_ROOT'].'/inc/classes/'.$class.'.php';
});
?>