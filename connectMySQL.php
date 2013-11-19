<?php

class MySQL {
	
	
	var $lastError;					
	var $lastQuery;				
	var $result;						
	var $records;						
	var $affected;					
	var $rawResults;				
	var $arrayedResult;			
	
	var $hostname;
	var $username;	
	var $password;	
	var $database;	
	
	var $databaseLink;		
	
	
	function MySQL($database, $username, $password, $hostname='localhost'){
		$this->database = $database;
		$this->username = $username;
		$this->password = $password;
		$this->hostname = $hostname;
		
		$this->Connect();
	}
	
	
	
	
	private function Connect($persistant = false){
		$this->CloseConnection();
		
		if($persistant){
			$this->databaseLink = mysql_pconnect($this->hostname, $this->username, $this->password);
		}else{
			$this->databaseLink = mysql_connect($this->hostname, $this->username, $this->password);
		}
		
		if(!$this->databaseLink){
   		$this->lastError = 'Could not connect to server: ' . mysql_error($this->databaseLink);
			return false;
		}
		
		if(!$this->UseDB()){
			$this->lastError = 'Could not connect to database: ' . mysql_error($this->databaseLink);
			return false;
		}
		return true;
	}
	
	

	private function UseDB(){
		if(!mysql_select_db($this->database, $this->databaseLink)){
			$this->lastError = 'Cannot select database: ' . mysql_error($this->databaseLink);
			return false;
		}else{
			return true;
		}
	}
	
	
	
	function ExecuteSQL($query){
		$this->lastQuery 	= $query;
		if($this->result 	= mysql_query($query, $this->databaseLink)){
			$this->records 	= @mysql_num_rows($this->result);
			$this->affected	= @mysql_affected_rows($this->databaseLink);
			
			if($this->records > 0){
				$this->ArrayResults();
				return $this->arrayedResult;
			}else{
				return true;
			}
			
		}else{
			$this->lastError = mysql_error($this->databaseLink);
			return false;
		}
	}
	
	
	
	function Insert($vars, $table, $exclude = ''){
		
		
		if($exclude == ''){
			$exclude = array();
		}
		
		array_push($exclude, 'MAX_FILE_SIZE'); 
		

		$vars = $this->SecureData($vars);
		
		$query = "INSERT INTO `{$table}` SET ";
		foreach($vars as $key=>$value){
			if(in_array($key, $exclude)){
				continue;
			}
		
			$query .= "`{$key}` = '{$value}', ";
		}
		
		$query = substr($query, 0, -2);
		
		return $this->ExecuteSQL($query);
	}
	
	
	function Delete($table, $where='', $limit='', $like=false){
		$query = "DELETE FROM `{$table}` WHERE ";
		if(is_array($where) && $where != ''){
		
			$where = $this->SecureData($where);
			
			foreach($where as $key=>$value){
				if($like){
				
					$query .= "`{$key}` LIKE '%{$value}%' AND ";
				}else{
			
					$query .= "`{$key}` = '{$value}' AND ";
				}
			}
			
			$query = substr($query, 0, -5);
		}
		
		if($limit != ''){
			$query .= ' LIMIT ' . $limit;
		}
		
		return $this->ExecuteSQL($query);
	}
	
	
	
	
	
	function Update($table, $set, $where, $exclude = ''){
	
		if(trim($table) == '' || !is_array($set) || !is_array($where)){
			return false;
		}
		if($exclude == ''){
			$exclude = array();
		}
		
		array_push($exclude, 'MAX_FILE_SIZE'); 
		
		$set 		= $this->SecureData($set);
		$where 	= $this->SecureData($where);
		
	
		
		$query = "UPDATE `{$table}` SET ";
		
		foreach($set as $key=>$value){
			if(in_array($key, $exclude)){
				continue;
			}
			$query .= "`{$key}` = '{$value}', ";
		}
		
		$query = substr($query, 0, -2);
		
	
		
		$query .= ' WHERE ';
		
		foreach($where as $key=>$value){
			$query .= "`{$key}` = '{$value}' AND ";
		}
		
		$query = substr($query, 0, -5);
		
		return $this->ExecuteSQL($query);
	}
	
	
	function CloseConnection(){
		if($this->databaseLink){
			mysql_close($this->databaseLink);
		}
	}
}

?>
