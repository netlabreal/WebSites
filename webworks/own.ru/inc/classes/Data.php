<?
class Data 
{
	private $_db;
	function __construct()
	{
		$this->_db = Db::GetInstance();
	}
//----------------------------------------------------------------//
	public function InsZayavka($name,$txt){
	$res = 0;
		$sql="INSERT INTO z (name,tel,txt,dat) VALUES ('".$name."','".$txt."','".date("y.m.d H:m:s")."')";
		$s = $this->_db->ActionData($sql);
			if(!$s->error()){
				$res = 1;
			}
	return $res;	
	}
//----------------------------------------------------------------//


}

?>