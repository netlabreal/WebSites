<?
require_once '../inc/core/rinit.php';

//**************************************//
$param = Input::get('param');
switch ($param) {
	case 'delstat':$gd = new Data; echo json_encode($gd->DelStat());
		break;
	case 'stat':$gd = new Data; echo json_encode($gd->Stat());
		break;
	case 'editnews':$id = Input::get('id'); $cap = Input::get('cap'); $txt = Input::get('txt');$gd = new Data; echo json_encode($gd->EditNews($id, $cap, $txt));
		break;
	case 'delnews':$id = Input::get('id');$gd = new Data; echo json_encode($gd->DelNews($id));
		break;
	case 'insnews':$cap = Input::get('caption');$tx = Input::get('txt');$gd = new Data; echo json_encode($gd->insNews($cap, $tx));
		break;
	case 'randomnews':$gd = new Data; echo json_encode($gd->RandomNews());
		break;
	case 'allinfo':$nid = Input::get('id')!=0?Input::get('id'):0;$gd = new Data; echo json_encode($gd->Allinfo($nid));
		break;
	case 'random':$gd = new Data; echo json_encode($gd->DataRandom());
		break;
	case '1':$gd = new Data; echo json_encode($gd->Tdata());
		break;
	case '2':$id = Input::get('id');$gd = new Data();echo json_encode($gd->GetObject($id));
			break;
	case '3':$page = Input::get('page');$tp = Input::get('tp');$tip = Input::get('tip');$rayon = Input::get('rayon');$p = Input::get('p');
			 $gd = new Data();echo json_encode($gd->GetAllDataParam($tp,$tip,$rayon,$page,$p));
			break;
	case '4':$tp = Input::get('tp');$tip = Input::get('tip');$rayon = Input::get('rayon');$p = Input::get('p');
			 $gd = new Data();echo json_encode($gd->GetKolPagesParam($tp,$tip,$rayon,$p));
			break;
	case '5':$name = Input::get('name');$tel = Input::get('tel');$txt = Input::get('txt');
			 $gd = new Data();echo json_encode($gd->InsZayavka($name,$tel,$txt));
			break;
	case '11':$id = Input::get('id');$gd = new Data; echo json_encode($gd->DelObject($id));
		break;
	case '12':$id = Input::get('id');$gd = new Data; echo json_encode($gd->GetRObject($id));
		break;
	case '14':$gd = new Data; echo json_encode($gd->GetRayons());
		break;
	case '15':  $s = Input::get('s');$tip = Input::get('tip');$rayon = Input::get('rayon');$komn = Input::get('komn');
				$floor = Input::get('floor');$plosh = Input::get('plosh');$cena = Input::get('cena');$opis = Input::get('opis');$vis = Input::get('vis');
				$tel1 = Input::get('tel1'); $tel2 = Input::get('tel2');
				$gd = new Data; echo json_encode($gd->InsObject($s,$tip,$rayon,$komn,$floor,$plosh,$cena,$opis,$vis,$tel1,$tel2));
		break;
	case '16':  $id = Input::get('id'); $s = Input::get('s');$tip = Input::get('tip');$rayon = Input::get('rayon');$komn = Input::get('komn');
				$floor = Input::get('floor');$plosh = Input::get('plosh');$cena = Input::get('cena');$opis = Input::get('opis');$vis = Input::get('vis');
				$tel1 = Input::get('tel1'); $tel2 = Input::get('tel2');
				$gd = new Data; echo json_encode($gd->IzmObject($s,$tip,$rayon,$komn,$floor,$plosh,$cena,$opis,$vis,$id,$tel1,$tel2));
		break;
	case '17':  $gd = new Data; echo json_encode($gd->GetZ());
		break;
	case '18':  $id = Input::get('id');$gd = new Data; echo json_encode($gd->DelZ($id));
		break;
	case '19':  $id = Input::get('id');$gd = new Data; echo json_encode($gd->DelRayon($id));
		break;
	case '20':  $r = Input::get('rayon');$gd = new Data; echo json_encode($gd->InsRayon($r));
		break;
	case '21':  $gd = new Data; echo json_encode($gd->Allinfo(0));
		break;
	case '':
		break;	
}
//**************************************//
//echo Foto::delTree(Config::get("path")."29");

//$s = Db::getInstance()->querywithparams("select * from s where id=? or id=?",array(1,2));
//if(!$s->error()){
//	$r = $s->GetData();
//	foreach ($r as $key) {
		//echo $key->name.'<br>';
//	}	
	//echo '<br>'.$s->Count();
//}else{echo "error";}
