<?php
	$source=$db->select("activity","a_sion btime,is_break","user_id=$_SESSION[user_id] AND a_date=(SELECT MAX(a_date) FROM activity WHERE user_id=$_SESSION[user_id] AND a_type='login')");
	$source=mysql_fetch_array($source);
	$btime = explode(":",$source['btime']); 
	$isBreak = $source['is_break']; 
?>

<span id="break"><?="$btime[0] : $btime[1] : $btime[2]"?></span>

<script language="JavaScript" type="text/javascript">

<?php if($isBreak=='0'){?>
	var stsp=false;
	var bsec  = <?=(int)$btime[2]?>;
	var bmin  = <?=(int)$btime[1]?>;
	var bhour = <?=(int)$btime[0]?>;
	setCookie('bTime',((bhour<=9) ? "0"+bhour : bhour) + ":" + ((bmin<=9) ? "0" + bmin : bmin) + ":" + bsec,1);
<?php }else{ ?>
	var stsp=true;
	var ctTime = getCookie('bTime')
	ctTime = ctTime.split(':');
	var bsec  = parseInt(ctTime[2]);
	var bmin  = parseInt(ctTime[1]);
	var bhour = parseInt(ctTime[0]);
	document.getElementById('break').innerHTML= ((bhour<=9) ? "0"+bhour : bhour) + " : " + ((bmin<=9) ? "0" + bmin : bmin) + " : " + bsec;
	var stth = document.getElementById('ssbTimer');
	breakTimer(stth);
<?php } ?>

var bTimer;
var sTimer;
function upSetbreak(){
	var param="ePage=breakTime&break=1&time=" + getCookie('bTime');
	ajaxServices("actions.php",param,'');
}
		
function breakTimer(th){
		if(!stsp){
			th.innerHTML = 'Break  Stop';
			var param="ePage=breakTime&break=1";
			$("#statusBox").html("Break");
			ajaxServices("actions.php",param,'',startBreak);
			sTimer =  window.setInterval("upSetbreak();", 20000);
			stsp=true;
				
		}else{
			stsp=false;
			var param="ePage=breakTime&break=0&time=" + getCookie('bTime');
			ajaxServices("actions.php",param,'');
			th.innerHTML = 'Break Start';
			$("#statusBox").html("Working");
			if(bTimer!==undefined) clearTimeout(bTimer);
			if(sTimer!==undefined) clearInterval(sTimer);
		}
}

function startBreak() {
		bsec++;
		if (bsec == 60){bsec = 0; bmin = bmin + 1; }
		else{ bmin = bmin;}
		if(bmin == 60){ bmin = 0; bhour += 1;}
	
		if (bsec<=9) { bsec = "0" + bsec; }
		var time = ((bhour<=9) ? "0"+bhour : bhour) + " : " + ((bmin<=9) ? "0" + bmin : bmin) + " : " + bsec;
		document.getElementById("break").innerHTML = time
		document.getElementById("break").innerHTML
		bTimer = window.setTimeout("startBreak();", 1000);
		time = ((bhour<=9)?"0"+bhour:bhour) + ":" + ((bmin<=9)?"0" + bmin:bmin) + ":" + bsec;
		setCookie('bTime',time,1);
}

function getCookie(c_name){
	var i,x,y,ARRcookies=document.cookie.split(";");
	for (i=0;i<ARRcookies.length;i++){
		x=ARRcookies[i].substr(0,ARRcookies[i].indexOf("="));
		y=ARRcookies[i].substr(ARRcookies[i].indexOf("=")+1);
		x=x.replace(/^\s+|\s+$/g,"");
		  if (x==c_name){
			return unescape(y);
		  }
	 }
}

function setCookie(c_name,value,exdays){
	var exdate=new Date();
	exdate.setDate(exdate.getDate() + exdays);
	var c_value=value + ((exdays==null) ? "" : "; expires="+exdate.toUTCString());
	document.cookie=c_name + "=" + c_value;
}

</script>