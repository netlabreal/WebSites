<?
//error_reporting(0);
$servername = "localhost";
//$username = "real";
//$password = "real";
$username = "lab";
$password = "ghjcnjq";
//$db = "litab_otrada";
$db = "otrada";
//echo $num = (float) str_replace(',', '', "1,200,000");
//----------------------------------------------------------------//
function DelFile($f){
unlink($f);
}
//----------------------------------------------------------------//
function GetFoto($id){
$f_arr=array();
$path = '../img/data/'.$id;
$h = @opendir($path);	
if($h!==false){
while (false !== ($file = readdir($h))) { 
		if($file!=='.' and $file!=='..'){
			if(is_file($path."/".$file)===true){
				array_push($f_arr, $path."/".$file);
			}
		}
	}	
closedir($h);
}	
return $f_arr;
}
//----------------------------------------------------------------//
function GetRData($id){
Global $servername,$username, $password, $db;
$arr = array();$farr=array();

	$conn = mysqli_connect($servername,$username,$password ) or die("0");
	if(!$conn){
		echo "can not connect!";
	}
	else
	{
		mysqli_select_db($conn,$db);
		$sql="SELECT o.id, types.name as type, s.name as vibor, rayons.name as rayon, komnat, floor, plosh, cena, opisanie, visible FROM `Objects` as o inner join s, types, rayons where o.s=s.id and o.tip=types.id and o.rayon=rayons.id and o.id=".$id;
		mysqli_query($conn,"SET NAMES utf8");
		$result = mysqli_query($conn,$sql);
		if(mysqli_num_rows($result)>0){
			while($row=mysqli_fetch_assoc($result)){
				array_push($arr, $row["id"],$row["type"],$row["vibor"],$row["rayon"],$row["komnat"],$row["floor"],$row["plosh"],number_format($row["cena"]),$row["opisanie"],$row["visible"]);
			}
		}
		mysqli_free_result($result);
	mysqli_close($conn);
	}
	//$er = GetFoto($id);
	array_push($arr ,GetFoto($id));
	
return $arr;
}
//----------------------------------------------------------------//
function delTree($dir) { 
   $files = array_diff(@scandir($dir), array('.','..')); 
    foreach ($files as $file) { 
      (is_dir("$dir/$file")) ? delTree("$dir/$file") : unlink("$dir/$file"); 
    } 
    return rmdir($dir); 
} 	
//----------------------------------------------------------------//
function DelData($rid){
$path = '../img/data/'.$rid;
Global $servername,$username, $password, $db;
$res = 0;
	$conn = mysqli_connect($servername,$username,$password ) or die("0");
	if($conn){
		mysqli_select_db($conn,$db);
		$sql="Delete from Objects where id = ?";
		if($stmt = mysqli_prepare($conn,$sql)){
			mysqli_query($conn,"SET NAMES utf8");
			mysqli_stmt_bind_param($stmt,"i",$rid);
			if(mysqli_stmt_execute($stmt)){
				if(delTree($path)){
					$res=1;
				}
			}
			mysqli_stmt_close($stmt);
		}
		mysqli_close($conn);
	}

return $res;
}
//----------------------------------------------------------------//
function VnestiData($s,$tip,$rayon,$komn,$floor,$plosh,$cena,$opis){
Global $servername,$username, $password, $db;
$res = 0;
	$conn = mysqli_connect($servername,$username,$password ) or die("0");
	if($conn){
		mysqli_select_db($conn,$db);
		$sql="Insert into Objects (s,tip,rayon,komnat,floor,plosh,cena,opisanie) values(?,?,?,?,?,?,?,?)";
		if($stmt = mysqli_prepare($conn,$sql)){
		$res=11;
			mysqli_query($conn,"SET NAMES utf8");
			mysqli_stmt_bind_param($stmt,"iiiiidds",$s,$tip,$rayon,$komn,$floor,$plosh,$cena,$opis);
			if(mysqli_stmt_execute($stmt)){
				$res=1;
			}
			mysqli_stmt_close($stmt);
		}
		mysqli_close($conn);
	}

return $res;

}
//----------------------------------------------------------------//
function IzmData($rid,$s,$tip,$rayon,$komn,$floor,$plosh,$cena,$opis,$vis){
Global $servername,$username, $password, $db;
$res = 0;
//if((is_int($rid)) and (is_int($s)) and (is_int($tip)) and (is_int($rayon)) and (is_int($komn)) and (is_int($floor)) and (is_float($plosh)) and (is_float($cena)) ){
	$conn = mysqli_connect($servername,$username,$password ) or die("0");
	if($conn){
		mysqli_select_db($conn,$db);
		$sql="Update Objects set s = ?,tip = ?,rayon = ?,komnat =?,floor =?,plosh =?,cena =?,opisanie = ?, visible = ? where id =?";
		if($stmt = mysqli_prepare($conn,$sql)){
			mysqli_query($conn,"SET NAMES utf8");
			mysqli_stmt_bind_param($stmt,"iiiiiddsii",$s,$tip,$rayon,$komn,$floor,$plosh,$cena,$opis,$vis,$rid);
			if(mysqli_stmt_execute($stmt)){
				$res=1;
			}
			mysqli_stmt_close($stmt);
		}
		mysqli_close($conn);
	}
//}
return $res;
}
//----------------------------------------------------------------//
function GetData($rid){
	Global $servername,$username, $password, $db;
	$data = array();
	$conn = mysqli_connect($servername,$username,$password ) or die("0");
	if(!$conn){
		echo "can not connect!";
	}
	else
	{
		mysqli_select_db($conn,$db);
		$sql="SELECT id,s,tip,rayon,komnat,floor,plosh,cena,opisanie,visible FROM `Objects` where id =?";
		if($stmt = mysqli_prepare($conn,$sql)){
			mysqli_query($conn,"SET NAMES utf8");
			mysqli_stmt_bind_param($stmt,"i",$rid);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_bind_result($stmt, $col1, $col2, $col3, $col4, $col5, $col6, $col7, $col8, $col9, $col10);
			 while (mysqli_stmt_fetch($stmt)) {
				array_push($data, $col1,$col2,$col3,$col4,$col5,$col6,$col7,number_format($col8),$col9, $col10);
				
			}
			mysqli_stmt_close($stmt);
		}
	mysqli_close($conn);
	}
	array_push($data ,GetFoto($rid));
	
	return $data;
}
//----------------------------------------------------------------//
function GetAllData($page){
Global $servername,$username, $password, $db;
$arr = array();

	$conn = mysqli_connect($servername,$username,$password ) or die("0");
	if(!$conn){
		echo "can not connect!";
	}
	else
	{
		mysqli_select_db($conn,$db);
		$sql="SELECT o.id, types.name as type, s.name as vibor, rayons.name as rayon, komnat, floor, plosh, cena, opisanie, visible FROM `Objects` as o inner join s, types, rayons where o.s=s.id and o.tip=types.id and o.rayon=rayons.id order by o.id Desc LIMIT ".(($page-1)*12).",".($page*12);
		mysqli_query($conn,"SET NAMES utf8");
		$result = mysqli_query($conn,$sql);
		if(mysqli_num_rows($result)>0){
			$arr = array();
			while($row=mysqli_fetch_assoc($result)){

				$f = GetFoto($row["id"]);
				array_push($arr,$f);
				//array_push($arr, array($row["id"],$row["type"],$row["vibor"],$row["rayon"],$row["komnat"],$row["floor"],$row["plosh"],number_format($row["cena"]),$row["opisanie"],$row["visible"]));
			}
		}
		mysqli_free_result($result);
	mysqli_close($conn);
	}

return $arr;
}
//----------------------------------------------------------------//
function GetKolPages(){
Global $servername,$username, $password, $db;
$count = 0;$kol=12;

	$conn = mysqli_connect($servername,$username,$password ) or die("0");
	if(!$conn){
		echo "can not connect!";
	}
	else
	{
		mysqli_select_db($conn,$db);
		$sql="SELECT Count(*) from Objects";
		$result = mysqli_query($conn,$sql);
		$c = mysqli_fetch_row($result);
		mysqli_close($conn);
		mysqli_free_result($result);
		if($c!=0){$count = ceil($c[0]/$kol);}
		
	}
	return $count;
}
//----------------------------------------------------------------//
function GetKolPagesParam($tp,$tip,$rayon,$p){
Global $servername,$username, $password, $db;
$count = 0;$kol=12;

	$str_sql="";
	if($p!=0){
		if($str_sql==""){$str_sql=$str_sql." where visible=0";}else
		{$str_sql=$str_sql." and o.visible=0";}
	}
	if($tp!=0){
		if($str_sql==""){$str_sql=$str_sql." where s=".$tp;}else
		{$str_sql=$str_sql." and s=".$tp;}
	}
	if($tip!=0){
		if($str_sql==""){$str_sql=$str_sql." where tip=".$tip;}else
		{$str_sql=$str_sql." and tip=".$tip;}
	}
	if($rayon!=0){
		if($str_sql==""){$str_sql=$str_sql." where rayon=".$rayon;}else
		{$str_sql=$str_sql." and rayon=".$rayon;}
	}
	
	$conn = mysqli_connect($servername,$username,$password ) or die("0");
	if(!$conn){
		echo "can not connect!";
	}
	else
	{
		mysqli_select_db($conn,$db);
		$sql="SELECT Count(*) from Objects".$str_sql;
		$result = mysqli_query($conn,$sql);
		$c = mysqli_fetch_row($result);
		mysqli_close($conn);
		mysqli_free_result($result);
		if($c!=0){$count = ceil($c[0]/$kol);}
		
	}
	//return $sql;
	return $count;
}
//----------------------------------------------------------------//
function GetAllDataParam($tp,$tip,$rayon,$page,$p){
Global $servername,$username, $password, $db;
$arr = array();

	$str_sql="";
	if($tp!=0){$str_sql=$str_sql." and o.s=".$tp;}
	if($tip!=0){$str_sql=$str_sql." and o.tip=".$tip;}
	if($rayon!=0){$str_sql=$str_sql." and o.rayon=".$rayon;}
	if($p!=0){$str_sql=$str_sql." and o.visible=0";}
	$conn = mysqli_connect($servername,$username,$password ) or die("0");
	if(!$conn){
		echo "can not connect!";
	}
	else
	{
		mysqli_select_db($conn,$db);
		$sql="SELECT o.id, types.name as type, s.name as vibor, rayons.name as rayon, komnat, floor, plosh, cena, opisanie, visible FROM `Objects` as o inner join s, types, rayons where o.s=s.id and o.tip=types.id and o.rayon=rayons.id".$str_sql." order by o.id Desc LIMIT ".(($page-1)*12).",".($page*12);
		mysqli_query($conn,"SET NAMES utf8");
		$result = mysqli_query($conn,$sql);
		if(mysqli_num_rows($result)>0){
			$arr = array();
			while($row=mysqli_fetch_assoc($result)){
			$f = GetFoto($row["id"]);
				//array_push($arr,$f);
				array_push($arr, array($row["id"],$row["type"],$row["vibor"],$row["rayon"],$row["komnat"],$row["floor"],$row["plosh"],number_format($row["cena"]),$row["opisanie"],$row["visible"],$f[0]));
			}
		}
	mysqli_close($conn);
	}

return $arr;
}
//----------------------------------------------------------------//
function getTdata(){
Global $servername,$username, $password, $db;
$arr = array();$tp = array();$tip = array(); $r = array();

	$conn = mysqli_connect($servername,$username,$password ) or die("0");
	if(!$conn){
	}
	else
	{
		mysqli_select_db($conn,$db);
		//*******************************//
		$sql="SELECT * FROM types";
		mysqli_query($conn,"SET NAMES utf8");
		$result = mysqli_query($conn,$sql);
		if(mysqli_num_rows($result)>0){
			while($row=mysqli_fetch_assoc($result)){
				array_push($tp, array($row["id"],$row["name"]));
			}
		}
		
		mysqli_free_result($result);
		//*******************************//
		$sql="SELECT * FROM Rayons order by name";
		mysqli_query($conn,"SET NAMES utf8");
		$result = mysqli_query($conn,$sql);
		if(mysqli_num_rows($result)>0){
			while($row=mysqli_fetch_assoc($result)){
				array_push($r, array($row["id"],$row["name"]));
			}
		}
		mysqli_free_result($result);
		//*******************************//
		$sql="SELECT * FROM S order by id";
		mysqli_query($conn,"SET NAMES utf8");
		$result = mysqli_query($conn,$sql);
		if(mysqli_num_rows($result)>0){
			while($row=mysqli_fetch_assoc($result)){
				array_push($tip, array($row["id"],$row["name"]));
			}
		}
		mysqli_free_result($result);
		//*******************************//
		
		mysqli_close($conn);
	}
array_push($arr,$tip);
array_push($arr,$tp);
array_push($arr,$r);

return $arr;
}

$init  = 0;
$dataa = 0;
if ($_SERVER['REQUEST_METHOD']=='POST'){
	$init  = $_POST["init"];
	$dataa = $_POST["dataa"];
	$t     = $_POST["t"];
	$r     = $_POST["r"];
}
if($dataa==0 and $init==0){
	echo "0";
	exit;
}
if($dataa=="1"){
echo json_encode(GetAllData(1));
}

if($dataa=="11"){
	$id = $_POST["id"];
	echo json_encode(GetData($id));
}

if($dataa=="12"){
	$id = $_POST["id"];
	echo json_encode(GetRData($id));
}
		
if($dataa=="22"){
	$id = $_POST["id"];
	$s = $_POST["s"];
	$tip = $_POST["tip"];
	$rayon = $_POST["rayon"];
	$komn = $_POST["komn"];
	$floor = $_POST["floor"];
	$plosh = $_POST["plosh"];
	$cena = $_POST["cena"];
	$opis = $_POST["opis"];
	$vis = $_POST["vis"];
	echo json_encode(IzmData($id,$s,$tip,$rayon,$komn,$floor,$plosh,$cena,$opis,$vis));
}

if($dataa=="2"){
	$s = $_POST["s"];
	$tip = $_POST["tip"];
	$rayon = $_POST["rayon"];
	$komn = $_POST["komn"];
	$floor = $_POST["floor"];
	$plosh = $_POST["plosh"];
	$cena = $_POST["cena"];
	$opis = $_POST["opis"];
	$vis = $_POST["vis"];
	echo json_encode(VnestiData($s,$tip,$rayon,$komn,$floor,$plosh,$cena,$opis));
}

if($dataa=="3"){
$page = $_POST["page"];
echo json_encode(GetAllData($page));
}
if($dataa=="4"){
echo json_encode(GetKolPages());
}

if($dataa=="5"){
$page  = $_POST["page"];
$tp    = $_POST["tp"];
$tip   = $_POST["tip"];
$rayon = $_POST["rayon"];
$p     = $_POST["p"];

echo json_encode(GetAllDataParam($tp,$tip,$rayon,$page,$p));
}

if($dataa=="6"){
$tp    = $_POST["tp"];
$tip   = $_POST["tip"];
$rayon = $_POST["rayon"];
$p     = $_POST["p"];
echo json_encode(GetKolPagesParam($tp,$tip,$rayon,$p));
}
if($dataa=="7"){
$id = $_POST["id"];
echo json_encode(DelData($id));
}

if($init=="2"){
Global $servername,$username, $password, $db;
$arr = array();

	$conn = mysqli_connect($servername,$username,$password ) or die("0");
	if(!$conn){
	}
	else
	{
		mysqli_select_db($conn,$db);
		//*******************************//
		$sql="SELECT * FROM Rayons order by name";
		mysqli_query($conn,"SET NAMES utf8");
		$result = mysqli_query($conn,$sql);
		if(mysqli_num_rows($result)>0){
			while($row=mysqli_fetch_assoc($result)){
				array_push($arr, array($row["id"],$row["name"]));
			}
		}
		mysqli_free_result($result);
		//*******************************//
		
		mysqli_close($conn);
	}

echo json_encode($arr);

}

if($init=="333"){
echo json_encode(getTdata());
}

?>
