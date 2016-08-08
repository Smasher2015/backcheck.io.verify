<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php 
$opSide = true;
include("include_pages/head_inc.php");
if(isset($_REQUEST['key'])){
	if($_REQUEST['key']!=''){
		if(isset($_REQUEST['subdovalidate'])){
			$erMsg = doActivation($_POST);
		}
		$userInfo = getUserInfo('',$_REQUEST['key']);
		if($userInfo['is_vld']!=0){
			$action='login';	
		}
	}
}
if(!isset($action)) $action='login';
?>
</head>
<body style="margin:0;padding:0">
<?php include("include_pages/boxex_inc.php");?>
    <div class="mainCnt" id="mainCnt">
        <div class="logimBg" id="logimBg">
            <div id="loginCnt" style="display:table;height:600px;width:100%;#position:relative;">
                <div style="display:table-cell; vertical-align:middle;">
                    <div class="loginbox">
                            <?php
                                switch($action){
                                    case'login':
                                        include('include_pages/login_inc.php');			
                                    break;
                                    case'register':
                                        //include('include_pages/register_inc.php');			
                                    break;
                                    case'contactus':
                                        include('include_pages/contactus_inc.php');			
                                    break;	
                                    case'changepass':
                                        include('include_pages/changepass_inc.php');			
                                    break;																	
                                } 
                             ?>
                           <div class="clear"></div>  
                    </div>
                </div>
            </div>
        </div>
		<script type="text/javascript">
			function adjustSize(){ 
				var size = windowSize();
				document.getElementById('logimBg').style.height=size[1]+'px';
				document.getElementById('loginCnt').style.height=size[1]+'px';
			}
			adjustSize();
			window.onload = function (){
				window.onresize = adjustSize();
			}  
        </script>        
    </div>
</body>
</html>