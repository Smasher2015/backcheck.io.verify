<div class="nstyle">
<?php
	
	if(isset($_REQUEST['daction'])){
		if($_REQUEST['daction']=='delete'){
			edData($_REQUEST['verData'],$_REQUEST['daction']);
		}
	}
		
		
include("include_pages/basic_info_inc.php"); ?>	
 
<div class="mainUH">
	<div class="subUH">
    	<h1 align="center" class="mainHd">Case Information & Check(s) &nbsp;
        	[ <span title="Candidate Name" ><?=$data['emp_id'].'-'.$data['v_name']?></span> ]
       	</h1>
    </div>
<?php 
	if($LEVEL==2 || $LEVEL==5){
		$where = "";
	}else{
		$where = "user_id=$_SESSION[user_id]";
	}
	include("include_pages/checks_mimx_inc.php");
 ?> 
</div>
</div>
