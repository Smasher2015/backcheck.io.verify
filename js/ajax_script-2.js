var rpsTt='';
function ajaxServices(url,param,contentID,callBackFun){
	document.getElementById('ajaxLoader').style.display = 'block';
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
		  	document.getElementById('ajaxLoader').style.display = 'none';
			if(xmlhttp.responseText=='noAccess' || xmlhttp.responseText=='u error'){
					if(xmlhttp.responseText=='u error') alertBox('Updation Error!');
					else alertBox('You Have no Access!');
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



function ajaxFileUpload(url,file,contentID,callBackFun){
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
		document.getElementById(contentID).innerHTML=xmlhttp.responseText;
		document.getElementById('ajaxLoader').style.display = 'none';
		if(callBackFun !== undefined) callBackFun();
		}
	}
	xmlhttp.open("POST",url,true);
	xmlhttp.setRequestHeader("Cache-Control", "no-cache");
	xmlhttp.setRequestHeader("X-File-Name", file.fileName);
	xmlhttp.setRequestHeader("X-File-Size", file.fileSize);
	xmlhttp.setRequestHeader("Content-Type", "multipart/form-data");
	xmlhttp.send(file);
}

function trim(str){
	return str.replace(/^\s\s*/, '').replace(/\s\s*$/, '');
}

function editFiled(th,varId,ac){
	if(ac===undefined) ac='';
	var spanInput = th.parentNode.getElementsByTagName('span').item(0);
	var spanText = th.parentNode.getElementsByTagName('span').item(1);
	var value = document.getElementById(spanText.id+'_txt').value;
	
	switch(spanText.style.display){
		case 'block':
				spanText.style.display = 'none';
				spanInput.style.display = 'block';
		break;
		case 'none':
				spanInput.style.display = 'none';
				spanText.style.display = 'block';
				Encoder.EncodeType = "entity";
				var txt= trim(Encoder.htmlDecode(spanText.innerHTML));
				value = value.replace('&',' and ');
				
				if(confirm("Are You Sure! \n Do You Want to Replace [ "+txt+" ]\n With [ "+value+" ]")){
					ajaxServices("updatefields.php","id="+varId+"&val="+value+"&col="+spanText.id+"&pan="+ac,spanText.id);
				}
		break;
	}
}

function sndClsReport(col,value,varId){
	var calBack= function(){
		ajaxServices("get_info.php","case=sntRpt",'_srp');
	};
	ajaxServices("checklist.php","id="+varId+"&q="+col+"&val="+value,'inf_'+varId,calBack);
}

function showInfo(mun){
	var prdType = document.getElementById(mun).parentNode;
	var dtype =prdType.style.display;
	switch(dtype){
		case 'none':
			prdType.removeAttribute('style');
		break;	
		case '':
			prdType.setAttribute('style','display:none');
		break;
	}
}

function removeCase(varID){
	if(confirm("Are You Sure! \n Do You Want to Remove this Case")){
		ajaxServices("get_info.php","case=rmcas&id="+varID,'_'+varID+'_');
	}
}