<?php  include("include/config.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<script type="text/javascript" src="<?php echo SURL; ?>js/jquery/jquery-1.5.1.min.js"></script> 
	<script type="text/javascript" src="<?php echo SURL; ?>js/jQueryRotate.2.1.js"></script>
    <link rel="stylesheet" href="<?php echo SURL; ?>css/new_css.css">  
       
</head>

<body style="padding:0; margin:0" onload="hideLoader()">
    <div id="page"> 
      
        <div> 
            <img src="<?php echo SURL.$_REQUEST['attach'];?>" id="image" style="display:block;width:100%;" />  
        </div> 
        <div class="rotate rLeft" id="rotateBox" style="display:none;">
            <a href="javascript:void(0);" title="Rotate 0&#176" onClick="rotateImg(0)" id="0">[ 0&#176; ]</a> 
            <a href="javascript:void(0);" title="Rotate 90&#176" onClick="rotateImg(90)" id="90">[ 90&#176; ]</a> 
            <a href="javascript:void(0);" title="Rotate 180&#176" onClick="rotateImg(180)" id="180">[ 180&#176; ]</a> 
            <a href="javascript:void(0);" title="Rotate 270&#176" onClick="rotateImg(270)" id="270">[ 270&#176; ]</a> 
        </div>
        
        <div class="rotate rRight" id="zoomBox" style="display:none;"> 
            <a href="javascript:void(0);" title="Zoom In" onClick="zoomImg('p')" id="180">[ + ]</a> 
            <a href="javascript:void(0);" title="Zoom Out" onClick="zoomImg('m')" id="270">[ - ]</a> 
            <a href="javascript:void(0);" title="Reset Zoom" onClick="zoomImg('r')" id="270">[ = ]</a>
        </div>         
    </div>
	<script type="text/javascript">
	var tHeight;
	var tWidth;
	window.onload = function(){    
    	newImg = new Image();
    	newImg =  document.getElementById('image');
    	curHeight = newImg.height;
    	curWidth = newImg.width;
		tWidth   = curWidth;
		tHeight  = curHeight;
		document.getElementById('rotateBox').style.display='block';
		document.getElementById('zoomBox').style.display='block';
		window.top.shwHidLdig('none');
	}
	
	function zoomImg(typ){
		if(typ=='p'){
				curHeight = (curHeight+(curHeight*(5/100)));
				curWidth = (curWidth+(curWidth*(5/100)));
		}else if(typ=='m'){
				curHeight = (curHeight-(curHeight*(5/100)));
				curWidth = (curWidth-(curWidth*(5/100)));			
		}else{
				curHeight = tHeight;
				curWidth  = tWidth; 
		}
		img =  document.getElementById('image');
		img.style.height = curHeight+'px';
    	img.style.width  = curWidth+'px';
	}
	
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
</body>
</html>
