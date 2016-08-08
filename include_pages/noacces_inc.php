<?php include 'includes/document_head.php'?>
<div id="wrapper">	
    <div class="isolate">
        <div id="login_box" class="center" style="display:none;">
            <img src="images/logo.png" width="420" style="margin-left:7%;" />
            <div class="main_container clearfix">
                <div class="box">
                    <div class="block">
                        <h3 style="text-align:center;margin:10px;">Invalid Parameters, You have no access!</h3>
                    </div>
                </div>  
            </div>
        </div>
    </div>
</div>
	
<script type="text/javascript">
	$(".validate_form").validate();
	function getpass(){
		var elm = document.getElementById('getpass');
		if(elm.style.display=='none'){
			elm.style.display='block';	
		}else{
			elm.style.display='none';	
		}
		
	}
</script>

<?php include 'includes/closing_items.php'?>