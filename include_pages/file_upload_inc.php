<?php
$db = new DB();
?>
<div style="width:100%;" align="center">
    <div style="width:45%;"> 
        <form action="" name="datafile" enctype="multipart/form-data" method="post">
            <div>
                <input size="60" type="file" name="file" style="width:100%" />
            </div>
            <div>
            <select name="vuser" id="cat" style="width:100%; margin-top:20px;">
                <option value="0">--Select Company--</option>
        <?php  	$companys = $db->select("company");
                 while($company = mysql_fetch_array($companys)) { ?>
                <option value="<?php echo $company['id']; ?>"><?php echo $company['name']; ?></option>
        <?php } ?>
            </select>
             </div>
             <div style="margin-top:20px;">
                <fieldset style="width:410px;padding-top:10px;">
                    <legend>Please Checkout Checks</legend>
                <?php 
                     $checks = $db->select("checks","*","is_active=1");
                     while($check = mysql_fetch_array($checks)){?>
                            <div class="fld">
                                <input type="checkbox" name="checks[]"  value="<?php echo $check['checks_id']; ?>" >
                                <?php echo $check['checks_title']; ?>
                            </div>
                <?php }?> 
                </fieldset>
             </div>                                  
        	<input style="float:right;" class="button" type="submit" name="submit" value="Upload File"  />
        </form>
    </div>
    <div class="clear"></div>
</div>
<div style="margin-top:20px;">
<?php
if(isset($_FILES['file'])){
	$vuser = $_REQUEST['vuser'];
	if(isset($_REQUEST['checks'])){
		if ($_FILES["file"]["error"] <= 0){
			if($vuser!='0'){
				$len = strlen($_FILES["file"]["name"]);
				$ext = strtolower(substr($_FILES["file"]["name"],($len-3)));
					if($ext=='csv'){
			
					$fp = fopen($_FILES["file"]["tmp_name"],'r');
					$colsAry = array('emp_id','v_name','v_nic','vdgtyp','vdgree','vuni','vedyr','veddur','v_ftname','v_dob','vbatch');
					$pCols = "emp_id,v_name,v_nic,v_ftname,v_dob";
					$sCols = "vdgtyp,vdgree,vuni,vedyr,veddur,vbatch";
					$err_msg='';
					$alRedy='';
					$rCount=0;
					$cCount=0;
					while($csv_line = fgetcsv($fp,1024)) {
						$values='';
						for ($i = 0, $j = count($csv_line); $i < $j; $i++) {
							$csv_line[$i] = trim(addslashes($csv_line[$i]));
							$va[$colsAry[$i]] = trim($csv_line[$i]);
						}
						if(is_numeric($csv_line[0])){
							$data = $db->select("ver_data","v_id,emp_id","emp_id=$va[emp_id] AND com_id=$vuser");
							if(mysql_num_rows($data)==0){
								$values = mkValues($va,$pCols);
								$values = $values[0].','.$vuser;
								$isInserted = $db->insert($pCols.',v_user_id',$values,"ver_data");
								$vid = $db->insertedID;
								if($isInserted){
									$rCount=$rCount+1;
									foreach($_REQUEST['checks'] as $check){
										$isInserted = $db->insert("v_id,checks_id","$vid,$check","ver_checks");		
										$asid = $db->insertedID;								
										if(!$isInserted ){
											echo msg('err',"Check Insertion Error! Record ID [$csv_line[0]] Check ID[$check]");
										}else{
											if($check==1){
												addExtCols($asid,$sCols,$va);
											}											
											$cCount = $cCount+1;
										}
									}
								}else{
									echo msg('err',"Insertion Error! Record ID [$csv_line[0]]");
								}
							}else{
								echo msg('err',"Record is Already There Record ID [$csv_line[0]]");
							}
						}else{
							echo msg('err',"Invalid Record ID [$csv_line[0]]");
						}
					}
					fclose($fp);
					if($rCount>0) echo msg('sec',"Recod  Inserted[$rCount] Successfully...");
					if($cCount>0) echo msg('sec',"Checks Inserted[$cCount] Successfully...");
				}else{ 
					echo msg('err',"Invalid File Type Please Upload Correct File");
				}
			}else{
				echo msg('err',"Please Select Company Name");
			}
		}
	}else{
		echo msg('err',"Please Select Check(s)");
	}
}
?>
</div>