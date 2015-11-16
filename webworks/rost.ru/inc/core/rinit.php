<?
session_start();
define('__ROOT__', dirname(dirname(dirname(__FILE__))));
require_once(__ROOT__.'/inc/classes/Sessions.php');
require_once(__ROOT__.'/inc/classes/Input.php');
require_once(__ROOT__.'/inc/classes/Foto.php');
require_once(__ROOT__.'/inc/classes/Data.php');
require_once(__ROOT__.'/inc/classes/Db.php');
require_once(__ROOT__.'/inc/classes/Redirect.php');
require_once(__ROOT__.'/inc/classes/Config.php');


$GLOBALS['config'] = array('host' => 'mysql52.1gb.ru', 'user'=>'gb_ost','pass'=>'d84346af3op','dbname'=>'gb_ost','path'=>'../img/data/');
//$GLOBALS['config'] = array('host' => 'localhost', 'user'=>'root','pass'=>'','dbname'=>'l','path'=>'../img/data/');
//$GLOBALS['config'] = array('host' => 'localhost', 'user'=>'045623242_real','pass'=>'real','dbname'=>'litab_otrada','path'=>'../img/data/');
//spl_autoload_register(function($class){
//	require_once $_SERVER['DOCUMENT_ROOT'].'/inc/classes/'.$class.'.php';
//});
?>