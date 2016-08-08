<script type="text/javascript" src="<?php echo SURL; ?>js/jquery/jquery-1.5.1.min.js"></script> 
<script type="text/javascript" src="<?php echo SURL; ?>js/jQueryRotate.2.1.js"></script> 
<div id="page"> 
  
	<div> 
		<img src="<?php echo SURL.$_REQUEST['attach'];?>" alt="" id="image" style="display:block; width:100%;" />  
	</div> 
	<div class="rotate">
		<a href="javascript:void(0);" onClick="rotateImg(0)" id="0">[ 0&#176; ]</a> 
		<a href="javascript:void(0);" onClick="rotateImg(90)" id="90">[ 90&#176; ]</a> 
		<a href="javascript:void(0);" onClick="rotateImg(180)" id="180">[ 180&#176; ]</a> 
		<a href="javascript:void(0);" onClick="rotateImg(270)" id="270">[ 270&#176; ]</a> 
	</div> 
</div>
<script type="text/javascript">

var newImg = new Image();
newImg =  document.getElementById('image');
curHeight = newImg.height;
curWidth = newImg.width;

function rotateImg(dgr){
	$("#image").rotate({angle:dgr});
	switch(dgr){
		case 0:
		case 180:
			newImg.style.height = curHeight;
			newImg.style.width =  curWidth; 	
		break;			
		case 90:
		case 270:
			newImg.style.height = curWidth;
			newImg.style.width = curHeight; 	
		break;
	}
}

</script>
