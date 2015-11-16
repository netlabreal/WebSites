<?
require_once 'core/rinit.php';
function imageresize($outfile,$infile,$neww,$newh,$quality) {
    $im=imagecreatefromjpeg($infile);
    $k1=$neww/imagesx($im);
    $k2=$newh/imagesy($im);
    $k=$k1>$k2?$k2:$k1;

    $w=intval(imagesx($im)*$k);
    $h=intval(imagesy($im)*$k);

    $im1=imagecreatetruecolor($w,$h);
    imagecopyresampled($im1,$im,0,0,0,0,$w,$h,imagesx($im),imagesy($im));

    imagejpeg($im1,$outfile,$quality);
    imagedestroy($im);
    imagedestroy($im1);
    }


function delTree($dir) { 
   $files = array_diff(scandir($dir), array('.','..')); 
    foreach ($files as $file) { 
      (is_dir("$dir/$file")) ? delTree("$dir/$file") : unlink("$dir/$file"); 
    } 
    return rmdir($dir); 
} 	
//----------------------------------------------------------------//
function DelObject($id){
$path = '../img/data/'.$id;
if(delTree($path)){

}
}
//----------------------------------------------------------------//
function KolFiles($id){
$count=0;
$path = '../img/data/'.$id;
$h = @opendir($path);	
if($h!==false){
while (false !== ($file = readdir($h))) { 
		if($file!=='.' and $file!=='..'){
			if(is_file($path."/".$file)===true){
			$count++;
			}
		}
	}	
closedir($h);	
}	
return $count;
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

function DelFile($f){
return @unlink($f);
}

function AddFoto($input,$output){
$res=false;
$w = 400;
$src = imagecreatefromjpeg($input);
if($src){
	$w_src = imagesx($src);
	$h_src= imagesy($src);

	$ratio = $w_src/$w;
	$rr = $w_src/$h_src;
	
	$w_dest = round($w_src/$ratio);
	$h_dest = round($h_src/$ratio);
	//echo($ratio);
	if($rr>1.5){$dest = imagecreatetruecolor(400,230);}else{$dest = imagecreatetruecolor(400,300);}
	$white = imagecolorallocate($dest, 255, 255, 255);
	imagefill($dest, 0, 0, $white);
	 //imagefill($dest, 255, 0, 0);

	if(imagecopyresampled($dest, $src, 0, 0, 0, 0, $w_dest, $h_dest, $w_src, $h_src)){
		if(imagejpeg($dest,$output,100)){$res=true;}
	}
	imagedestroy($dest);
	imagedestroy($src);
	
}

return $res;	
}
//echo $_POST;

if(isset($_POST['init'])){
	if($_POST['init']=="1"){
		echo json_encode(DelFile($_POST['file']));
	}
	if($_POST['init']=="2"){
		$gd = new Data();
		$rid = (int)basename($_POST['file'], ".jpg");
		if($gd->DelFotoFromNews($rid)!=0) {
			echo json_encode(DelFile($_POST['file']));
		}
	}
}

//*************************************//
if(isset($_POST['id'])){
$r = "0";
$path = '../img/data/'.$_POST['id'];
	if($_FILES['myfile']['type']=="image/jpeg"){
		$f = $_FILES['myfile']['tmp_name'];
			if(file_exists($path)){
				$output = $path.'/'.date("ymdHms").'.jpg';
			}else{
				mkdir($path,0777);
				$output = $path.'/'.date("ymdHms").'.jpg';
			}
			if(KolFiles($_POST['id'])<5){
				if(AddFoto($f,$output)){
					$r = $output;
				}
			}else{$r="1";}	
	}else{$r="2";}
echo $r;	
}
//*************************************//
if(isset($_POST['newsid'])) {
$r = "0";
	$path = '../img/news/'.$_POST['newsid'].'.jpg';
	if($_FILES['newsfile']['type']=="image/jpeg"){
		$f = $_FILES['newsfile']['tmp_name'];
		if(file_exists($path)){
			$r = 44;
		}else{
			$gd = new Data();
			if($gd->AddFotoToNews($_POST['newsid'])!=0){
				AddFoto($f,$path);
				$r = $path;
			}
		}
	}else{$r="2";}
echo $r;
}
//else {echo 0;}

?>