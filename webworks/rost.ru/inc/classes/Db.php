<?

Class Db{
	private static $_instance = null;
	private $_pdo, $_query, $_res,$_error,$_count;

	private function __construct(){
		try {
				$this->_pdo = new PDO('mysql:host='.Config::get("host").';dbname='.Config::get("dbname"),Config::get("user"),Config::get("pass"));	
				$this->_pdo -> exec("SET CHARACTER SET utf8");
			} catch (PDOException $e) {
				die($e->getMessage());
			}	
	}
	public static function GetInstance(){
		if(!isset(self::$_instance)){
			self::$_instance = new Db();
		}
		return self::$_instance;
	}
	public function querywithparams($sql, $params=array()){
		$this->_error = false;
		if($this->_query = $this->_pdo->prepare($sql)){
			$x = 1;
			foreach ($params as $param) {
				$this->_query->bindValue($x,$param);
				$x++;
			}
		}

		if(@$this->_query->execute()){
			$this->_res = $this->_query->fetchAll(PDO::FETCH_OBJ);
			$this->_count = $this->_query->rowCount();
		}else {$this->_error=true;}
	return $this;	
	}

	public function ActionData($sql){
		$this->_error = false;
		if($this->_query = $this->_pdo->prepare($sql)){
			if($this->_query->execute()){
			}
			else {$this->_error=true;}
		}

	return $this;	
	}


	public function GetData(){
		return $this->_res;
	}
	public function error(){
		return $this->_error;
	}
	public function Count(){
		return $this->_count;
	}

}
