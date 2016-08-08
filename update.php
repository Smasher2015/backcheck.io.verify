<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<style type="text/css">
#lbPDF{
	width:400px;
	background-color: #DADADA;
	position:absolute;
	-moz-border-radius: 5px;
	-webkit-border-radius:5px;
	border-radius:5px;
	-moz-box-shadow: 10px 10px 10px 0 #7C7C7C;
	-webkit-box-shadow: 10px 10px 10px 0 #7C7C7C;
	box-shadow: 10px 10px 10px 0 #7C7C7C;
		z-index:110;
}
</style>

<script type="text/javascript">
var rpsTt='';
var progress=0;
function ajaxCallBack(url,param,contentID,callBackFun,sldr){
	if(sldr === undefined) sldr=true;
	if (window.XMLHttpRequest){
	  	xmlhttp=new XMLHttpRequest();
		if(xmlhttp.overrideMimeType){
			 xmlhttp.overrideMimeType('text/html');
		}
	}else if(window.ActiveXObject){
		try{
				xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		}catch(e){
			   try{
					xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			   }catch(e){}
	   }  
	}
	xmlhttp.onreadystatechange=function(){
	  if (xmlhttp.readyState==4 && xmlhttp.status==200){
			if(xmlhttp.responseText=='noAccess' || xmlhttp.responseText=='u error'){
					if(xmlhttp.responseText=='u error') alert('Updation Error!');
					else alert('You Have no Access!');
			}else{
				if(contentID!=''){
					document.getElementById(contentID).innerHTML=xmlhttp.responseText;
				}else rpsTt = xmlhttp.responseText;
				if(callBackFun !== undefined) callBackFun();
			}
		}
	}

	xmlhttp.open("POST",url,true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.setRequestHeader("Content-length", param.length);
	xmlhttp.setRequestHeader("Connection", "close");
	xmlhttp.send(param);
}

function roundNumber(num,dec) {
	var result = Math.round(num*Math.pow(10,dec))/Math.pow(10,dec);
	return result;
}

function updateProgress(){
	document.getElementById('pCount').innerHTML = progress +'%';
	document.getElementById('pBar').style.width = progress+'%';
}

function updateData(){
	var callBack = function (){
		if(progress<100){
			if(rpsTt=='err'){
				alert('Updation Error!');
			}else{
				if(rpsTt!='N/A' && rpsTt!=''){
					var params = rpsTt.split('|');
					progress= roundNumber((params[2]/params[1])*100,2);
					updateProgress();
					ajaxCallBack('updateData.php','vid='+params[0]+'&uvl='+params[3],'',callBack,false);
				}
			}
		}
	}	
	ajaxCallBack('updateData.php','','',callBack,false);
}

</script>
</head>

<body onload="updateData()" >
<div id="showPDFLoader" style="display:block; z-index: 150; position: absolute; top: 35%; left: 35%;">
    <div id="lbPDF" style="display:block; text-align:center;">
        <div>
            <div style="margin-bottom:10px; margin-top:10px;">
                <div>
                <h4 id="hText">Please Wait: Updating Data</h4> 
                    <div style="margin-top:5px; border:#00C solid 1px; width:90%;margin:0 auto">
                        <div id="pCount" style="font-size:20px; font-weight:bold;color:#FFF;position:absolute;margin:5px 0 0 160px">0%</div>
                        <div id="pBar" style="height:30px; width:0;background-color:#03F"></div>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </div>
</div>
</body>
</html>