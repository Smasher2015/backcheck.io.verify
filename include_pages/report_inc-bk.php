<link rel="stylesheet" href="<?php echo SURL; ?>css/report_style.css?var=2">
<style type="text/css">
.mainPage{
	width:100%;
	border: #CCC solid 1px;
}

.viewReport img{
	width:100%;
}

.viewReport th{
	background-color:#FFF;
	text-align:left;
	color:#000;
}

.viewReport{
	width:96%;
	background-color:#FFF;
	padding:20px;
}
</style>

<?php
	if(is_numeric($_REQUEST['ascase'])){
		$pdflnk="pdf.php?pg=case&ascase=$_REQUEST[ascase]";
	}else{
		$pdflnk="pdf.php?pg=case&case=$_REQUEST[case]";
	}
?>

<img title="Generate PDF" style="position:absolute;margin-right:10px;top:30px;right:24px;cursor:pointer;" 
src="img/pdf_icon.png" onclick="downloadPDF('<?=$pdflnk?>')" >
                    
<div class="viewReport" style="background-color:#FFF;">
<?php 
if(!isset($_REQUEST['ascase'])) $_REQUEST['ascase']=0;
if(is_numeric($_REQUEST['ascase']) && is_numeric($_REQUEST['case'])){
	$case = 	$_REQUEST['case'];
	$ascase = $_REQUEST['ascase'];
	$access=true;
}else $access=false;

if($access){
	$db = new DB();
	$varData = $db->select("ver_data","*","v_id=$case");
	if($ascase!=0){
		$asWhere = "v_id=$case AND as_id=$ascase AND as_status='Close'";
	}else{
		$asWhere = "v_id=$case AND as_status='Close'";
	}
	$asDatas = $db->select("ver_checks","*",$asWhere);
	if((mysql_num_rows($varData)>0) && (mysql_num_rows($asDatas)>0)){
		$varData = mysql_fetch_array($varData);
?>

<div class="mainPage">
    <img style="margin-bottom:10px;" src="img/header_img.png"  />
    <div class="clearfix"></div>
   
		<div style="text-align:center;" align="center">
        	<?php include('include_pages/assement_inc.php'); ?>
        	<div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    <div>
		<?php  include("include_pages/report_footer_inc.php"); ?>
    </div>
    </div>
   
 	<?php include("include_pages/main_rep_inc.php");?>          
<?php if($FILES!=''){  
			foreach($FILES as $no=>$FILE){?>
                <div style="page-break-after:always;"></div>    
                <div class="mainPage" style="margin-top:20px;">
                    <img style="margin-bottom:10px;" src="img/header_img.png"  />
                    <div class="clearfix"></div>
                    <div style="margin-top:10px;">
                        <img style="height:1px" src="img/footer_line1_img.png"  />
                           <h3 class="anh" align="center">
                           		Annexure-<?php echo $FILE['pno'];?>
                           </h3>
                        <img style="height:1px" src="img/footer_line1_img.png"  />
					   <?php if($FILE['title']!==''){ ?>
                                <div align="center">
                                    <?php echo $FILE['title']; ?>
                                </div>
                       <?php } ?>                        
                    </div>    
                    <div class="clearfix"></div>
                    <div class="main" align="center">
                        <img style="width:700px;" src="<?php echo $FILE['proof'];  ?>"  />
                    </div>
                </div>
<?php } 	}

} 
}?>
	<div class="clear"></div> 
</div>  