<?

class Data 
{
	private $_db;
	public $result;	
	function __construct()
	{
		$this->_db = Db::GetInstance();
	}

//----------------------------------------------------------------//
	public function DelStat(){
	$res = 0;
		$s = $this->_db->querywithparams("Delete from stat ",array());
		$r = $s->GetData();
		if(!$s->error()){
			$res = 1;
		}
	return $res;
	}

//----------------------------------------------------------------//
	public function Stat(){
		$r_arr = array();
		$s = $this->_db->querywithparams("select Distinct types.name, komn ,Count(kolvo) as kolvo from stat INNER JOIN types where stat.t_id=types.id Group by types.name",array());
		$r = $s->GetData();
		foreach($r as $row){
			array_push($r_arr, $row);
		}
		return $r_arr;
	}

//----------------------------------------------------------------//
	public function RandomNews(){
	$r_arr = array();
	$arr_tmp = array();
		$s = $this->_db->querywithparams("select id from info",array());
		$r = $s->GetData();
		foreach($r as $row){
			array_push($arr_tmp, $row->id);
		}
		$rand_keys = array_rand($arr_tmp, 3);
		foreach($rand_keys as $key){
			array_push($r_arr, $this->Newsinfo($arr_tmp[$key]));
		}
	return $r_arr;
	}

//----------------------------------------------------------------//
	public function Newsinfo($id){
	$arr = array();
		$s = $this->_db->querywithparams("select * from info where id=?",array($id),array());
		$r = $s->GetData();
		foreach($r as $row){
			array_push($arr, $row->id, $row->caption);
		}
		return $arr;
	}

//----------------------------------------------------------------//
//----------------------------------------------------------------//
	public function Allinfo($id){
		$arr = array();
		if($id!=0)
		{
			$s = $this->_db->querywithparams("select * from info where id=?",array($id),array());
		}
		else
		{
			$s = $this->_db->querywithparams("select * from info",array());
		}
		$r = $s->GetData();
		foreach($r as $row){
			array_push($arr, $row);
		}
	return $arr;
	}

//----------------------------------------------------------------//
	public function DataRandom(){
	$r_arr = array();
	$arr_tmp = array();
		$s = $this->_db->querywithparams("select id from objects",array());
		$r = $s->GetData();
		foreach($r as $row){
			array_push($arr_tmp, $row->id);
		}
		$rand_keys = array_rand($arr_tmp, 4);
		foreach($rand_keys as $key){
			array_push($r_arr, $this->GetObjectRand($arr_tmp[$key]));
		}
	return $r_arr;
	}
//----------------------------------------------------------------//
	public function Tdata(){
	$arr = array();	
		$s = $this->_db->querywithparams("select * from s order by id",array());
		array_push($arr, $s->GetData());
		$t = $this->_db->querywithparams("select * from types",array());
		array_push($arr, $t->GetData());
		$r = $this->_db->querywithparams("select * from rayons order by name",array());
		array_push($arr, $r->GetData());
	return $arr;	
	}
//----------------------------------------------------------------//
	public function SetStat($typ, $komn){
		$res = 0;
		$sql="INSERT INTO stat (t_id,komn) VALUES ('".$typ."','".$komn."')";
		$s = $this->_db->ActionData($sql);
		if(!$s->error()){
			$res = 1;
		}
	return $res;
	}
//----------------------------------------------------------------//
	public function GetObject($id){
	$arr = array();	
		$s = $this->_db->querywithparams("SELECT o.id,types.id as idd, types.name as type, s.name as vibor, rayons.name as rayon, komnat, floor, plosh, cena, opisanie, visible, tel1, tel2 FROM `objects` as o inner join s, types, rayons where o.s=s.id and o.tip=types.id and o.rayon=rayons.id and o.id=?",array($id));
		$r = $s->GetData();
		foreach ($r as $row) {
			array_push($arr,$row->id,$row->type,$row->vibor,$row->rayon,$row->komnat,$row->floor,$row->plosh,number_format($row->cena),$row->opisanie,$row->visible,$row->tel1,$row->tel2);
			$this->SetStat($row->idd, $row->komnat);
		}
		array_push($arr ,Foto::GetFoto($id));
	return $arr;
	}
//----------------------------------------------------------------//
	public function GetObjectRand($id){
		$arr = array();
		$s = $this->_db->querywithparams("SELECT o.id, types.name as type, s.name as vibor, rayons.name as rayon, komnat, floor, plosh, cena, opisanie, visible, tel1, tel2 FROM `objects` as o inner join s, types, rayons where o.s=s.id and o.tip=types.id and o.rayon=rayons.id and o.id=?",array($id));
		$r = $s->GetData();
		foreach ($r as $row) {
			array_push($arr,$row->id,$row->type,$row->vibor,$row->rayon,$row->komnat,$row->floor,$row->plosh,number_format($row->cena),$row->opisanie,$row->visible,$row->tel1,$row->tel2);
		}
		array_push($arr ,Foto::GetFoto($id));
		return $arr;
	}
//----------------------------------------------------------------//
	public function GetAllDataParam($tp,$tip,$rayon,$page,$p){
	$arr = array();

		$str_sql="";
		if($tp!=0){$str_sql=$str_sql." and o.s=".$tp;}
		if($tip!=0){$str_sql=$str_sql." and o.tip=".$tip;}
		if($rayon!=0){$str_sql=$str_sql." and o.rayon=".$rayon;}
		if($p!=0){$str_sql=$str_sql." and o.visible=0";}
		$sql="SELECT o.id, types.name as type, s.name as vibor, rayons.name as rayon, komnat, floor, plosh, cena, opisanie, visible FROM `objects` as o inner join s, types, rayons where o.s=s.id and o.tip=types.id and o.rayon=rayons.id".$str_sql." order by o.id Desc LIMIT ".(($page-1)*12).",".($page*12);

		$s = $this->_db->querywithparams($sql);
		$r = $s->GetData();

		foreach ($r as $row) {
			$f = Foto::GetFoto($row->id);
			array_push($arr,array($row->id,$row->type,$row->vibor,$row->rayon,$row->komnat,$row->floor,$row->plosh,number_format($row->cena),$row->opisanie,$row->visible,$f[0]));
		}

	return $arr;	
	}
//----------------------------------------------------------------//
	public function GetKolPagesParam($tp,$tip,$rayon,$p){
	$str_sql="";$count = 0;$kol=12;
		if($p!=0){if($str_sql==""){$str_sql=$str_sql." where visible=0";}else{$str_sql=$str_sql." and o.visible=0";}}
		if($tp!=0){if($str_sql==""){$str_sql=$str_sql." where s=".$tp;}else{$str_sql=$str_sql." and s=".$tp;}}
		if($tip!=0){if($str_sql==""){$str_sql=$str_sql." where tip=".$tip;}else{$str_sql=$str_sql." and tip=".$tip;}}
		if($rayon!=0){if($str_sql==""){$str_sql=$str_sql." where rayon=".$rayon;}else{$str_sql=$str_sql." and rayon=".$rayon;}}

		$sql="SELECT * FROM objects".$str_sql;

		$s = $this->_db->querywithparams($sql);
		if($s->Count()!=0){
			$count = ceil($s->Count()/$kol);
		}

	return $count;	
	}
//----------------------------------------------------------------//
	public function AddFotoToNews($id){
		$res = 0;$rs = 1;
		$sql="Update info set img = '1' where id =".$id;
		$s = $this->_db->ActionData($sql);
		if(!$s->error()){
			$res = 1;
		}
		return $res;
	}
//----------------------------------------------------------------//
	public function DelFotoFromNews($id){
		$res = 0;$rs = 1;
		$sql="Update info set img = '0' where id =".$id;
		$s = $this->_db->ActionData($sql);
		if(!$s->error()){
			$res = 1;
		}
		return $res;
	}
//----------------------------------------------------------------//
	public function EditNews($id, $cap, $txt){
		$res = 0;
		$sql="Update info set caption = '".$cap."', txt ='".$txt."' where id =".$id;
		$s = $this->_db->ActionData($sql);
		if(!$s->error()){
			$res = 1;
		}
		return $res;
	}
//----------------------------------------------------------------//
	public function InsNews($caption,$txt){
		$res = 0;
		$sql="INSERT INTO info (caption,txt,img) VALUES ('".$caption."','".$txt."','". $res ."')";
		$s = $this->_db->ActionData($sql);
		if(!$s->error()){
			$res = 1;
		}
		return $res;
	}
//----------------------------------------------------------------//
	public function InsZayavka($name,$tel,$txt){
	$res = 0;
		$sql="INSERT INTO z (name,tel,txt,dat) VALUES ('".$name."','".$tel."','".$txt."','".date("y.m.d H:m:s")."')";
		$s = $this->_db->ActionData($sql);
			if(!$s->error()){
				$res = 1;
			}
	return $res;	
	}
//----------------------------------------------------------------//
	public function InsRayon($r){
	$res = 0;
	if($this->_db->querywithparams("select id from rayons where name=?",array($r))->Count()>0){
	}else
	{
		$sql="INSERT INTO rayons (name) VALUES ('".$r."')";
		$s = $this->_db->ActionData($sql);
			if(!$s->error()){
				$res = 1;
			}
	}
	return $res;	
	}
//----------------------------------------------------------------//
	public function DelNews($rid){
		$path = '../img/news/'.$rid.'.jpg';
		$res = 0;

		$sql="Delete from info where id = ".$rid;
		$s = $this->_db->ActionData($sql);
		if(!$s->error()){
			if(is_file($path)===true){
				if(Foto::DelFile($path)) {
					$res = 1;
				}
			}
			else{$res = 1;}
		}
		return $res;
	}
//----------------------------------------------------------------//
	public function DelObject($rid){
		$path = Config::get("path").$rid; 
		$res = 0;

		$sql="Delete from objects where id = ".$rid;
		$s = $this->_db->ActionData($sql);
			if(!$s->error()){
				if(Foto::delTree($path)){
					$res = 1;
				}
			}
	return $res;		
	}
//----------------------------------------------------------------//
	public function DelZ($rid){
		$res = 0;

		$sql="Delete from z where id = ".$rid;
		$s = $this->_db->ActionData($sql);
			if(!$s->error()){
				$res = 1;
			}
	return $res;		
	}
//----------------------------------------------------------------//
	public function DelRayon($rid){
		$res = 0;
		if($this->_db->querywithparams("select id from objects where rayon=?",array($rid))->Count()>0){
		}
		else{
			$sql="Delete from rayons where id = ".$rid;
			$s = $this->_db->ActionData($sql);
				if(!$s->error()){
					$res = 1;
				}
		}
	return $res;		
	}
//----------------------------------------------------------------//
	public function InsObject($s,$tip,$rayon,$komn,$floor,$plosh,$cena,$opis,$vis,$t1,$t2){
		$res=0;
		$sql="Insert into objects (s,tip,rayon,komnat,floor,plosh,cena,opisanie,visible,tel1,tel2) values('".$s."','".$tip."','".$rayon."','".$komn."','".$floor."','".$plosh."','".$cena."','".$opis."','".$vis."','".$t1."','".$t2."')";
		$s = $this->_db->ActionData($sql);
			if(!$s->error()){
				$res = 1;
			}
		return $res;	
	}
//----------------------------------------------------------------//
	public function IzmObject($s,$tip,$rayon,$komn,$floor,$plosh,$cena,$opis,$vis,$id,$t1,$t2){
		$res=0;
		$sql="Update objects set s =$s,tip = $tip,rayon = $rayon,komnat =$komn,floor =$floor,plosh =$plosh,cena =$cena,opisanie = '".$opis."', visible = $vis, tel1='".$t1."', tel2='".$t2."' where id =$id";
		$s = $this->_db->ActionData($sql);
			if(!$s->error()){
				$res = 1;
			}
		return $res;
	}
//----------------------------------------------------------------//
	public function GetRObject($rid){
		$arr = array();
		$sql="SELECT id,s,tip,rayon,komnat,floor,plosh,cena,opisanie,visible, tel1, tel2 FROM `objects` where id = ".$rid;
		$s = $this->_db->querywithparams($sql);
			if(!$s->error()){
				$r = $s->GetData();
				foreach($r as $row) {
					array_push($arr,$row->id,$row->s,$row->tip,$row->rayon,$row->komnat,$row->floor,$row->plosh,number_format($row->cena),$row->opisanie,$row->visible,$row->tel1,$row->tel2);
				}
			array_push($arr,Foto::GetFoto($row->id));	
			}
		return $arr;	
	}
//----------------------------------------------------------------//
	public function GetRayons(){
		$arr = array();
		$sql="SELECT * FROM rayons order by name";
		$s = $this->_db->querywithparams($sql);
			if(!$s->error()){
				$r = $s->GetData();
				foreach($r as $row) {
					array_push($arr,array($row->id,$row->name));	
				}
			}
		return $arr;		
	}
//----------------------------------------------------------------//
	public function GetZ(){
		$arr = array();
		$sql="SELECT * FROM z order by id Desc";
		$s = $this->_db->querywithparams($sql);
			if(!$s->error()){
				$r = $s->GetData();
				foreach($r as $row) {
					array_push($arr,array($row->id,$row->name,$row->tel,$row->txt,$row->dat));	
				}
			}
		return $arr;		
	}
//----------------------------------------------------------------//
	public function ProverkaUsera($name,$pass){
		$res = 0;
		$sql="SELECT * FROM usrs order by id";
		$s = $this->_db->querywithparams($sql);
			if(!$s->error()){
				$r = $s->GetData();
				foreach($r as $row) {
					if($row->name===$name && $row->h===md5($pass)){
						$res=1;
					}	
				}
			}	
	return $res;
	}
//----------------------------------------------------------------//

}

?>