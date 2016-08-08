<script src="js/jquery.ui.widget.js"></script> 
<script src="js/jquery.iframe-transport.js"></script> 
<script src="js/jquery.fileupload.js"></script> 
<script src="js/jquery.fileupload-process.js"></script> 
<script src="js/jquery.fileupload-image.js"></script> 
<script src="js/jquery.fileupload-audio.js"></script> 
<script src="js/jquery.fileupload-video.js"></script> 
<script src="js/jquery.fileupload-validate.js"></script> 
<!--<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>-->
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

<script type="text/javascript">
$(document).ready(function(){

 $("#addCheckFrm").submit(function(e){
	
	 var valid = true;
	 
	 
		
		var myData = $("#addCheckFrm").serialize();
		$("#ajaxLoader").show();
		//$(".error_box").html('<img align="center" src="images/spinners/332.gif" />');
		
		//?action=advanced_bulk&atype=upload
		
	$.ajax({
	url: "?action=advanced_bulk&atype=upload&submit_bulk=yes&ajaxupload2=1",
	
	data:myData,
	type: "POST",
	success: function(res){
		
		$("#ajaxLoader").hide();
 
   
   if(res!='added'){
		 	$("html, body").animate({ scrollTop: $('#error_box').offset().top }, 1000);
			//location.hash = "#error_box";
			//proton.dashboard.errors(res,"Error!");
		 $(".error_box").html('<div class="alert alert-danger alert-styled-left alert-bordered"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="icon-cross"></i></button><span class="text-bold">ERROR  </span>'+res+'</div>');
		
		  valid=false; 
		  return valid;
	
	 }else{
		$(".error_box").html('<div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="icon-cross"></i></button><span class="text-semibold"> SUCCESS</span> Records added successfully.</div>').fadeIn("slow");
		$.jGrowl('Records added successfully.', {
						header: 'SUCCESS!',
						theme: 'bg-success'
						});
		//proton.dashboard.alerts("Records added successfully.","SUCCESS");
		 var param2="action=ePage&ePage=add_rating&getcredits=1&com_id=<?php echo $company_id;?>";
   
		ajaxServices("actions.php",param2,'loadCredits');
			
		
		$(".blnk").each(function(ind,obj){
			
		$(this).val('');
					
		});
		//
		//
		$(".progress-bar-success").removeAttr('style');
		$(".progress-bar-success").text('');
		$(".files").text('');
		$(".error_box").delay(2000).fadeOut('slow');
		$('.jplist-next').trigger('click');
		
		
		
		
	 }
   
   
   
   
   
   
	}
	});
		
return false;		
});



});
	$( document ).on( "click", ".clss_hide_remov", function() {
		var thisCheck = $(this);
			var vals = thisCheck.val();
	  if ( thisCheck.is(':checked') ) {
		  
		$('.clss_hide_remov'+vals).removeAttr('required');
	  }
	  if ( ! (thisCheck.is(':checked')) ) {
		 
		$('.clss_hide_remov'+vals).attr('required','');
	  }
		
	});
		
	$( document ).on( "focus", ".datetimepicker-month", function() {
        var cid = $(this).attr('id');
		
		$("#"+cid).datepicker({
			dateFormat: 'yy-mm-dd',
			changeMonth: true,
			changeYear: true,
			yearRange: "1900:<?php echo date("Y");?>"
			});
			
			
	});	
		 					
		

				
		$(".user_images").each(function(index, element) {
            set_image($(this).data('id'));
        });
		var myCount = '<?php echo $cc;?>';
		function uploadAttach(id){
			
		
			
			var chk = $("#limit_"+id).val();
			
			if(chk==0){
            set_docs($("#"+id).data('id'),$("#"+id).data('count'),$("#"+id).data('check'),$("#"+id).data('ccounter'),$("#"+id).data('attchid'));
			$("#limit_"+id).val(1);
			}
			

      
		}
		function clearFields(){
	document.addCheckFrm.reset();
}
</script> 
<script src="scripts/vendor/bootstrap-datetimepicker.js"></script> 
<script src="scripts/vendor/fileinput.js"></script> 
<script src="scripts/vendor/parsley.min.js"></script> 
<script src="scripts/vendor/parsley.extend.min.js"></script> 
<script type="text/javascript">
function checkCnic(vl,ur,div_cl,len,att,chk){
    //images/spinners/332.gif
       
    var response = false;
	if(vl.length >= len){
		$("."+div_cl).html('<img align="right" src="images/spinners/3.gif" />');
        $.ajax({
	url: "actions.php",
	data:'ePage=add_rating&'+ur+'='+vl+'&chk='+chk,
	type: "POST",
	success: function(res){
    if(res=='not-found'){
		$('.'+div_cl).html('<ul  class="parsley-error-list"><li class="required" style="display: list-item; color:green;"><i class="icon-ok-circle"></i></li></ul>');
		//$('.'+att).removeAttr('onclick');
		//$('.'+att).attr('type','submit');
		valDate(att);
		return true;

	}else{
		
		$('.'+div_cl).html('<ul  class="parsley-error-list"><li class="required" style="display: list-item;"><i class="icon-cross-circle"></i> '+res+'</li></ul>');
		//$('.'+att).attr('onclick','stopThis()');
		//$('.'+att).attr('type','button');
		
		
		return false;
	}
	},
	error: function(){
    alert('failure');
	}
	
	
	});
	}else{
	$('.'+div_cl).html('');
	//$('.check_cnic').removeAttr('onclick');	
	}

    return response;
        
}

function stopThis(){
	$('.cnic').focus();
	return false;
}

$(document).ready(function() {  
        $("#thisdiv").niceScroll({cursorcolor:"#00F"});
    });
	

</script> 
