<?php

	$mnth = (isset($_REQUEST['mnth']))?$_REQUEST['mnth']:date("m");
	$yr = (isset($_REQUEST['yr']))?$_REQUEST['yr']:date("Y");
	$monthNum  = $mnth;
	$Fmonth = date('F', mktime(0, 0, 0, $monthNum, 10));
	$company_id = ($LEVEL!=4)?(isset($_REQUEST['client_id']))?$_REQUEST['client_id']:1:$COMINF['id'];
	$comWhere = ($LEVEL!=4)?" AND com_id=$company_id ":"";

?>
	<div class="page-container">

		<!-- Page content -->
		<div class="page-content">

		

			<!-- Main content -->
			<div class="content-wrapper">
            
<div class="content">
    	<div class="page-header">
            <div class="page-header-content">
                <div class="page-title2">
                	<h1>Support Tickets </h1>
        </div></div></div>
     
				<?php if($LEVEL==4 || $LEVEL==5){ include("include_pages/support_section_dash.php"); }?>
  </div>

</div>
</div>
</div>

<script>
var request_id = <?php echo ($_REQUEST['isfaq']!=0)?$_REQUEST['isfaq']:0; ?>;
$(document).ready(function() {
	 $('#question').hide();
	 $('#isFaq').change(function () {
        if (this.checked){ 
           $('#question').show('slow');
		}
        else{ 
            $('#question').hide('slow');
		}
    });
	if(request_id!=0){
		$('#question').show('slow');
	}
	
});
</script>