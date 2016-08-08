<?php 
include("include/config.php");
if(isset($_SESSION['username'])){
	$path = "pdf_files/".$_REQUEST['path'];
	if(file_exists($path)){
		if ($fd = fopen ($path , "r")){
		$fsize = filesize($path );
		$path_parts = pathinfo($path );
		$ext = strtolower($path_parts["extension"]);
	   
		header("Content-type: application/pdf"); // add here more headers for diff. extensions
		header("Content-Disposition: attachment; filename=\"".$path_parts["basename"]."\""); // use 'attachment' to force a download
		  
		header("Content-length: $fsize");
		header("Cache-control: private"); //use this to open files directly
		while(!feof($fd)) {
			$buffer = fread($fd, 2048);
			echo $buffer;
		}
	}
		fclose ($fd);
	if($LEVEL==2 || $LEVEL==4){	
		if(isset($_REQUEST['ascase'])){
			if($LEVEL==2) $where="as_mdnld=1"; else $where="as_cdnld=1";
			updateCheck($_REQUEST['ascase'],$where,'Report Downloaded');
		}else if(isset($_REQUEST['case'])){
			if($LEVEL==2) $where="v_mdnld=1"; else $where="v_cdnld=1";
			updateData($_REQUEST['case'],$where,'Report Downloaded');
		}
	}

		
		if(!isset($_REQUEST['ascase'])) $_REQUEST['ascase']=0;
		addActivity('pdf','',$LEVEL,'',$_REQUEST['case'],$_REQUEST['ascase']);
		exit;
	}
}
	echo "'<script type=\"text/javascript\">window.top.alertBox('You Have No Access!')</script>";
?>
