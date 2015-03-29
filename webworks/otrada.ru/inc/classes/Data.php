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
	public function Tdata(){
	$arr = array();	
		$s = $this->_db->querywithparams("select * from S order by id",array());
		array_push($arr, $s->GetData());
		$t = $this->_db->querywithparams("select * from types",array());
		array_push($arr, $t->GetData());
		$r = $this->_db->querywithparams("select * from Rayons order by name",array());
		array_push($arr, $r->GetData());
	return $arr;	
	}
//----------------------------------------------------------------//
	public function GetObject($id){
	$arr = array();	
		$s = $this->_db->querywithparams("SELECT o.id, types.name as type, s.name as vibor, rayons.name as rayon, komnat, floor, plosh, cena, opisanie, visible FROM `Objects` as o inner join s, types, rayons where o.s=s.id and o.tip=types.id and o.rayon=rayons.id and o.id=?",array($id));
		$r = $s->GetData();
		foreach ($r as $row) {
			array_push($arr,$row->id,$row->type,$row->vibor,$row->rayon,$row->komnat,$row->floor,$row->plosh,number_format($row->cena),$row->opisanie,$row->visible);
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
		$sql="SELECT o.id, types.name as type, s.name as vibor, rayons.name as rayon, komnat, floor, plosh, cena, opisanie, visible FROM `Objects` as o inner join s, types, rayons where o.s=s.id and o.tip=types.id and o.rayon=rayons.id".$str_sql." order by o.id Desc LIMIT ".(($page-1)*12).",".($page*12);

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

		$sql="SELECT * FROM Objects".$str_sql;

		$s = $this->_db->querywithparams($sql);
		if($s->Count()!=0){
			$count = ceil($s->Count()/$kol);
		}

	return $count;	
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
	public function DelObject($rid){
		$path = Config::get("path").$rid; 
		$res = 0;

		$sql="Delete from Objects where id = ".$rid;
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

		$sql="Delete from Z where id = ".$rid;
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
	public function InsObject($s,$tip,$rayon,$komn,$floor,$plosh,$cena,$opis,$vis){
		$res=0;
		$sql="Insert into Objects (s,tip,rayon,komnat,floor,plosh,cena,opisanie,visible) values('".$s."','".$tip."','".$rayon."','".$komn."','".$floor."','".$plosh."','".$cena."','".$opis."','".$vis."')";
		$s = $this->_db->ActionData($sql);
			if(!$s->error()){
				$res = 1;
			}
		return $res;	
	}
//----------------------------------------------------------------//
	public function IzmObject($s,$tip,$rayon,$komn,$floor,$plosh,$cena,$opis,$vis,$id){
		$res=0;
		$sql="Update Objects set s =$s,tip = $tip,rayon = $rayon,komnat =$komn,floor =$floor,plosh =$plosh,cena =$cena,opisanie = '".$opis."', visible = $vis where id =$id";
		$s = $this->_db->ActionData($sql);
			if(!$s->error()){
				$res = 1;
			}
		return $res;	
	}
//----------------------------------------------------------------//
	public function GetRObject($rid){
		$arr = array();
		$sql="SELECT id,s,tip,rayon,komnat,floor,plosh,cena,opisanie,visible FROM `Objects` where id = ".$rid;
		$s = $this->_db->querywithparams($sql);
			if(!$s->error()){
				$r = $s->GetData();
				foreach($r as $row) {
					array_push($arr,$row->id,$row->s,$row->tip,$row->rayon,$row->komnat,$row->floor,$row->plosh,number_format($row->cena),$row->opisanie,$row->visible);	
				}
			array_push($arr,Foto::GetFoto($row->id));	
			}
		return $arr;	
	}
//----------------------------------------------------------------//
	public function GetRayons(){
		$arr = array();
		$sql="SELECT * FROM Rayons order by name";
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
		$sql="SELECT * FROM Z order by id";
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
		$res = false;
		$sql="SELECT * FROM Usrs order by id";
		$s = $this->_db->querywithparams($sql);
			if(!$s->error()){
				$r = $s->GetData();
				foreach($r as $row) {
					if($row->name===$name && $row->h===md5($pass)){
						$res=true;
					}	
				}
			}	
	return $res;
	}
//----------------------------------------------------------------//

}

?>