<?php
class SRC{
	private $db;
	private $keyAry = array();
	private $row = 0;
	public $query;
	public $search_text;
	public $tableName;
	public $srchField;
	public $isSndx = false;
	public $fields = '*';
	public $primaryKey = '';
	public $limit = 10;
	public $searchArray = array();
	public $exact=false;
	public $groupBy="";
	
	private function mysql_field_array($src){
        $field = mysql_num_fields($src);
        for ($i=0;$i<$field;$i++){
            $names[$i] = mysql_field_name($src,$i);
        }
        return $names;
    }

	private function not_in(){
		$notin='';
		foreach($this->keyAry as $keyVal){
			$notin .= (($notin!='')?',':'').$keyVal;
		}
		if($notin!='') $notin = " AND $this->primaryKey NOT IN (".$notin.")"; 
		return $notin;			
    }

	private function str_bind($sTextAry,$cnt){
		$tStr='';
		for($s=0;$s<$cnt;$s++){
			$tStr.=(($tStr!='')?' ':'').$sTextAry[$s];
		}
		return $tStr;
    }

	private function mysql_bind_array($src){
		$numRow = mysql_num_rows($src);
		if($numRow>0){
			$fields = $this->mysql_field_array($src);
			while($fatchAry = mysql_fetch_array($src)){
				$this->keyAry[$fatchAry[$this->primaryKey]] = $fatchAry[$this->primaryKey];
				foreach($fields as $field){
					$this->searchArray[$this->row][$field] = $fatchAry[$field];						
				}
				$this->row = $this->row +1;
			}
		}
    }	
	
	public function searchExact(){
		$this->db = new DB();
		$where = " $this->srchField LIKE '$this->search_text'";
		$notIn = $this->not_in();
		$arry = $this->db->select($this->tableName,$this->fields,"$where $notIn");
		$this->mysql_bind_array($arry);
		return  $this->searchArray;
	}
	
	private function search($sText){	
		$this->db = new DB();
		if($this->groupBy!='') $this->groupBy="GROUP By $this->groupBy";
		$lenSrt = "(LENGTH($this->srchField)-LENGTH('$sText')) AS len";
		$where = " $this->srchField LIKE '$sText%' $this->groupBy ORDER BY $this->srchField";
		$notIn = $this->not_in();
		$arry = $this->db->select($this->tableName,$this->fields,"$where $notIn",$this->limit);
		$this->mysql_bind_array($arry);
		
		if(!$this->exact){		
			if(($this->row+1) < $this->limit){
				$notIn = $this->not_in();
				$where = " $this->srchField LIKE '%$sText%' $notIn $this->groupBy ORDER BY $this->srchField,len";
				$arry = $this->db->select($this->tableName,"$this->fields,$lenSrt","$where",$this->limit);
				$this->mysql_bind_array($arry);
			}
		
			if(($this->row+1) < $this->limit){
				$strArrays = explode(" ", trim($sText));
				if(count($strArrays)>1){
					$where = '';
					foreach ($strArrays as $strS){
						if ($where != ''){
							$where = " $where AND $this->srchField LIKE '%$strS%'";
						}else{
							$where = " $this->srchField LIKE '%$strS%'";
						}
					}
					$notIn = $this->not_in();
					$where = "($where) $notIn $this->groupBy ORDER BY $this->srchField,len";
					$arry = $this->db->select($this->tableName,"$this->fields,$lenSrt","$where",$this->limit);
					$this->mysql_bind_array($arry);
				}
			}
		}
		
		if($this->isSndx){	
			if(($this->row+1) < $this->limit){
				$notIn = $this->not_in();
				$where = " SOUNDEX($this->srchField) = SOUNDEX('$sText') $notIn $this->groupBy ORDER BY $this->srchField";
				$arry = $this->db->select($this->tableName,$this->fields,"$where",$this->limit);
				$this->mysql_bind_array($arry);
			}
		}	
	}		
	
	public function getResults(){
		$this->search_text = str_replace("  "," ",trim($this->search_text));
		$this->search($this->search_text);
		$strArrays = explode(" ", trim($this->search_text));
		
		if(count($strArrays)>1){
/*			if(count($strArrays)>2){
				if(($this->row+1) < $this->limit){
					for($i=(count($strArrays)-1);$i>0;$i--){
						$sText = $this->str_bind($strArrays,$i);
						$this->search($sText);	
						if(($this->row+1) > $this->limit) break;
					}
				}
			}*/
			
			/*if(($this->row+1) < $this->limit){
				foreach ($strArrays as $sText){
					$this->search($sText);	
					if(($this->row+1) > $this->limit) break;
				}		
			}*/
		}
		return  $this->searchArray;
	}
}
?>