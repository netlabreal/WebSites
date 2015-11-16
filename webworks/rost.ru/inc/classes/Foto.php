<?
class Foto
{
//----------------------------------------------------------------//
public static function GetFoto($id){
$f_arr=array();
	$path = Config::get("path").$id;
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
public static function delTree($dir) { 
   $files = array_diff(scandir($dir), array('.','..')); 
    foreach ($files as $file) { 
      (is_dir("$dir/$file")) ? delTree("$dir/$file") : unlink("$dir/$file"); 
    } 
    return rmdir($dir); 
} 	
//----------------------------------------------------------------//
public static function AddFoto($input,$output){
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
//----------------------------------------------------------------//
public static function DelFile($f){
	return @unlink($f);
}
//----------------------------------------------------------------//
}


?>