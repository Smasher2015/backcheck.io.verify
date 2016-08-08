<script type="text/javascript">
	function validatePCR(){
		var frm = document.forms['crimeSearch'];
		var val = frm.name.value.replace(/^\s+|\s+$/g,'');	
		if(val=='' || val==frm.name.title){
			alertBox(frm.name.title);
			return false;
		}
		frm.submit();
	}
</script>
<link href="css/crime_search.css" rel="stylesheet" type="text/css" />
<div class="bar_main">
    <div class="logo_bg">
    	<img src="img/crimepk_logo.png" width="180"  />
    </div>   
    <div style="display:inline-block;width:73%;float: right; height:100%; vertical-align:middle;">
       
        <div class="srch_fld">
        <?php $crmTitle="Search by First and Last Name"?>
            <form action="http://crimecheck.pk/search-result.php" method="post" enctype="multipart/form-data" target="_blank" name="crimeSearch">
                <input type="text" class="input_txt auto req title" value="<?=$crmTitle?>" title="<?=$crmTitle?>" name="name" />
                    <div class="submit_sr">
                            <span class="srch" onclick="validatePCR()">&nbsp;</span>
                    </div>
                    <?php if($USER['validation']!=''){ ?>
                    <input type="hidden" name="token" value="<?=$USER['validation']?>" />
                    <?php } ?>
            </form>
        </div>  
         <div style=" padding-top:3px;">
         	<img src="../img/run-free-search.png" width="40%" height="40" />
         </div>
        
    </div> 
</div>