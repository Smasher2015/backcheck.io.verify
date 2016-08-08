<?php
	if(isset($_POST['addbasic'])){
		if(!$verCase){
			echo msg('err',$_REQUEST['msgErr']);
		}
	}
	
	if(isset($_POST['addAttach'])){
		foreach($_REQUEST['casev'] as $ascase){
			$tAry = explode('|',$ascase);
			$case = trim($tAry[0]);
			$flKey  = trim($tAry[1]);
			if(is_numeric($case)){
				$checkInf = getCheck(0,0,$case);
				if(is_array($checkInf) && isset($_FILES[$flKey.$case])){
					$_REQUEST['ascase']=$case;
					$_FILES[$flKey]  = $_FILES[$flKey.$case];
					$_REQUEST['check'] =$checkInf['checks_id'];
					adddata($_REQUEST,4,false);
				}
			}
		}
	}
	
	if(isset($_REQUEST['daction'])){
		if($_REQUEST['daction']=='delete'){
			edData($_REQUEST['datav'],$_REQUEST['daction']);
		}
	}
		
?>
<div class="innerdiv">
     <h2 class="head-alt">Order a Case</h2>
     <div class="innercontent">
		<?php 
				include("include_pages/add_check_inc.php");
		?>
	</div>
    <div class="clear" ></div>
</div>

<form style="display:none;" method="post" name="dataFrm" >
        <input type="hidden" name="daction" value="delete"  />
        <input type="hidden" name="datav" value="0"  />
</form>