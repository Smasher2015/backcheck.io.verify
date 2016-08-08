<?php

class DB{

private $userName = USER;
private $password = PASS; 
private $hostName = HOST;
private $dbName =  DB;
private $con;

public $isdebug = false;
public $insertedID;
public $emsg='';
public $query;

	public function open(){
		try{
			if($this->con) return true;
			$this->con = mysql_connect($this->hostName,$this->userName,$this->password);	
			if($this->con){
				if(!mysql_select_db($this->dbName,$this->con)){
					 throw new Exception('DB Selection Error!');
				}
				return true;
			}else{
				throw new Exception('DB Connecting Error!');
			}
		}catch(Exception $e){
			$this->emsg = $this->getException($e);
			return false;	
		}	
	}
	
	public function select($table,$cols='*',$where='',$limit='',$orderby=''){
		if(trim($where)!=''){
		 	$where =" WHERE $where";
		 }
		 if($limit!=''){
		 	$limit =" limit $limit";
		 }
		//echo "SELECT $cols FROM $table $where $orderby $limit";
		$this->query = "SELECT $cols FROM $table $where $orderby $limit";
		return $this->execute(false);
	}

	public function delete($table,$where){	
		$this->query = "DELETE FROM $table WHERE $where";
		$isDelete = $this->execute(false);
		//if($isDelete) $status="SUCCESS"; else $status="ERROR"; 
		//$qry = addslashes(trim($this->query));
		//$this->update_sql_log($qry,$status,"DELETE");
		return $isDelete;
	}

	public function update($cols,$table,$where){
		$this->query = "UPDATE $table SET $cols WHERE  $where";
        $isUpdate = $this->execute(false);
		//if($isUpdate) $status="SUCCESS"; else $status="ERROR"; 
		//$qry = addslashes(trim($this->query));	
		//$this->update_sql_log($qry,$status,"UPDATE");
		return $isUpdate;
	}

	public function updateCol($cols,$vals,$table,$where){
		$cols = explode(',',$cols);
		$vals = explode(',',$vals);
		foreach($cols as $key=>$col){
			$nwdata = urldecode($vals[$key]);
			$tCols=(isset($tCols)?"$tCols,":'')."$cols[$key]=$nwdata";	
		
		}
		//echo "UPDATE $table SET $tCols WHERE  $where"; exit;
		$this->query = "UPDATE $table SET $tCols WHERE  $where";
        $isUpdate = $this->execute(false);
		return $isUpdate;
	}
	
	public function insert($cols,$values,$table,$dbLog=true){
		$values = urldecode($values);
		$this->query = "INSERT INTO $table($cols) VALUES($values)";
        $isInsert = $this->execute($dbLog);
		//if($dbLog){
		//	if($isInsert) $status="SUCCESS"; else $status="ERROR"; 
		//	$qry = addslashes(trim($this->query));
		//	$this->update_sql_log($qry,$status,"INSERT");
		//}
		return $isInsert;
	}
	
	public function insertSet($setValues,$table){
		$this->query = "INSERT INTO $table SET $setValues";
        $isInsert = $this->execute(true);
		//if($isInsert) $status="SUCCESS"; else $status="ERROR"; 
		//$qry = addslashes(trim($this->query));
		//$this->update_sql_log($qry,$status,"INSERT SET");
		return $isInsert;
	}
	
	public function insertMulti($cols,$multiValues,$table){
		$this->query = "INSERT INTO $table $cols VALUES $multiValues";
        $isInsert = $this->execute(true);
		//if($isInsert) $status="SUCCESS"; else $status="ERROR"; 
		//$qry = addslashes(trim($this->query));
		//$this->update_sql_log($qry,$status,"INSERT SET");
		return $isInsert;
	}

	public function countRec($cols="*",$table,$where=''){
		if($where!='') 	$where =" WHERE ".$where;
		$this->query = "SELECT COUNT($cols) AS count FROM $table $where";
		$counts = $this->execute(false);
		$counts = mysql_fetch_array($counts);
		return $counts['count'];
	}

	public function close(){		
		try{
		if($this->con){
			if(mysql_close($this->con)){
				return true;
			}else{
				throw new Exception('DB Closing Error!');
			}
		}else{
			return true;
		}
		}catch(Exception $e){
			$this->emsg = $this->getException($e);
			return false;
		}
	}

	public function dispose(){
		//$this->close();
	}

	private function getException($e){
		$tmp = 'Msg: '.$e->getMessage().'<br/>';
		$tmp = $tmp.'Line: '.$e->getLine().'<br/>';
		$tmp = $tmp.'File: '.$e->getFile().'<br/>';
		return $tmp;
	}

	private function execute($getLastID=true){
		if($this->open()){
			try{
				$result = mysql_query($this->query);
				if($getLastID)	$this->insertedID = mysql_insert_id();
				if($result){
					return $result;
				}else{
					throw new Exception(mysql_error());	
				}
			}catch(Exception $e){
				$this->emsg =  $this->getException($e);
				//$this->dispose();
				return false;
				}
		}
	}
	
	public function __construct(){

	}	

	public function __destruct(){
     	$this->dispose();
	}

    private function update_sql_log($query,$status,$qtype){
		try{
			$uid = $_SESSION['user_id'];
			$page= $_SERVER['PHP_SELF'];
			$this->insert("qur_type,qur_uid,qur_query,qur_page,qur_status", "'$qtype',$uid,'$query','$page','$status'", "query_log",false);
		}catch (exception $e){
			$this->emsg = $this->getException($e);
			return false;
		}
    }

    public function activityLog($action,$type,$source,$entryID){
		try{
			$uid = $_SESSION['user_id'];
			$this->insert("act_action,act_type,user_id,source_id,entry_id", "'$action','$type',$uid,$source,$entryID", "activity_log",false);
		}catch (exception $e){
			$this->emsg = $this->getException($e);
			return false;
		}
    }


	public function pagination($total,$currentPage,$baseLink,$nextPrev=true,$limit){
		if(!$total OR !$currentPage OR !$baseLink){
			return false;
		}
		//Total Number of pages
		$totalPages = ceil($total/$limit);
		//Text to use after number of pages
		$txtPagesAfter = ($totalPages==1)? " page": " pages";
		//Start off the list.
		$txtPageList = '<br />'.$totalPages.$txtPagesAfter.' : <br />';
		//Show only 3 pages before current page(so that we don't have too many pages)
		$min = ($page - 3 < $totalPages && $currentPage-3 > 0) ? $currentPage-3 : 1;
		//Show only 3 pages after current page(so that we don't have too many pages)
		$max = ($page + 3 > $totalPages) ? $totalPages : $currentPage+3;
		//Variable for the actual page links
		$pageLinks = "";
		//Loop to generate the page links
		for($i=$min;$i<=$max;$i++){
			if($currentPage==$i)
			{
				//Current Page
				$pageLinks .= '<li class="page"><a href="#">'.$i.'</a></li>';
			}
			else
			{
				$pageLinks .= '<li><a href="'.$baseLink.$i.'">'.$i.'</a></li>';
			}
		}
		if($nextPrev)
		{
			//Next and previous links
			$next = ($currentPage + 1 > $totalPages) ? false : '<li class="text"><a href="'.$baseLink.($currentPage + 1).'" >Next</a></li>';   
			$prev = ($currentPage - 1 <= 0 ) ? false : '<li class="text"><a href="'.$baseLink.($currentPage - 1).'" >Previous</a></li>';
		}
		
		return  $prev.$pageLinks.$next ;
	}

} 

?>