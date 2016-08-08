
<div id="main_container" class="main_container container_16 clearfix">
				<?php $keyphrase = '3'; include 'includes/navigation.php'?>
       

                               <?php 
  if(isset($error) and $error != "No"){ ?>
                <div class="block">
       <div class="alert  alert_red">
         <img height="24" width="24" src="images/icons/small/white/alarm_bell.png">
         <?php echo $error; ?>
         </div>
                                    </div>
                <?php } ?>
                                             <?php 
  if(isset($success) and $success != ""){ ?>
                <div class="block">
       <div class="alert  alert_green">
         <img height="24" width="24" src="images/icons/small/white/alarm_bell.png">
         <?php echo $success; ?>
         </div>
                                    </div>
                <?php } ?>
             <?php include("includes/cases-main_inc.php")?>
                    
                  </div>
          
             <script type="text/javascript">
	$(".validate_form").validate();
</script>
