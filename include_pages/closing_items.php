
</div>
<div class="clearFix"></div>

<!--<div class="client_login_footer pages">-->
<div class="client_login_footer pages">
  <div class="container">
    <div class="col-md-9">
    <ul class="links">
        <li><a href="<?php echo COPYRIGHT_URL;?>code-of-conduct/" target="_blank">Code of Conduct</a></li>  
        <li><a href="<?php echo COPYRIGHT_URL;?>cookie-policy/" target="_blank">Cookie Policy</a></li>
        <li><a href="<?php echo COPYRIGHT_URL;?>privacy-policy/" target="_blank">Privacy Policy</a></li>
        <li><a href="<?php echo COPYRIGHT_URL;?>terms-conditions/" target="_blank">Terms &amp; Conditions</a></li> 
        <li><a href="<?php echo COPYRIGHT_URL;?>data-security/" target="_blank">Data Security</a></li>    
        <li> &copy; 2007 - <?=date('Y')?> | Powered by <a href="<?php echo COPYRIGHT_URL;?>">Background Check Pte Ltd</a>  - All rights reserved</li>  
        </ul></div>
   <div class="col-md-3 text-right"> <ul class="scail text-right">
        <li><a href="https://www.facebook.com/pages/Back-Check-Group/1522354821360337" target="_blank"><i class="icon-facebook"></i></a></li>  
        <li><a href="https://twitter.com/BackCheckGroup" target="_blank"><i class="icon-twitter"></i></a></li>
        <li><a href="https://plus.google.com/u/0/110425041799206653677/" target="_blank"><i class="icon-google-plus"></i></a></li>
        <li><a href="https://www.linkedin.com/company/back-check-group" target="_blank"><i class="icon-linkedin2"></i></a></li> 
        <li><a href="https://www.pinterest.com/backcheck3/" target="_blank"><i class="icon-pinterest2"></i></a></li>                
    </ul>
    </div>
    </div>
</div>
</div> 
	<!--<section class="last-footer-sec">
    	<div class="last-footer-white-bg">
        	<div class="container">
            	<div class="row">
                	<div class="col-md-12">
                    	<div class="footer-logos">
                        	<ul>
                            	<li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    	<div class="last-footer-bar"></div>
        <div class="clearFix"></div>
    </section>-->



		
    <!--<div id="loading_overlay">
			<div class="loading_message round_bottom">
				<img src="images/loading.gif" alt="loading" />
			</div>
		</div>-->
        
        
		<!--<script src="scripts/bootstrap.min.js"></script>-->
<style>
.liv_ifram{position: fixed;right: 0;bottom: 0;border: 0;height: 470px;width: 500px;display: block;background:transparent;}	
/*.liv_iframtogg{position: fixed;right: 0;bottom: 0;border: 0;height: 470px;width: 500px;display: block;background: transparent;}
#LiveHelpEmbedded{bottom:0 !important;}
.ifrm_container{position:absolute;}*/

</style>        
 <div class="ifrm_container">       <!-- Proton base scripts: -->
<?php /*?><iframe id="live_ifram" class="liv_ifram" src="<?php echo SURL; ?>livechat.php"></iframe><?php */?>
</div>
      <script src="scripts/main.js"></script>
        <!--<script src="scripts/proton/common.js"></script>-->
      <!--    <script src="scripts/proton/main-nav.js"></script>-->
     <!-- <script src="scripts/proton/user-nav.js"></script>-->
        
        
        
        <!-- Page-specific scripts: -->
<!--      	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>-->
<!--        <script src="scripts/proton/dashboard.js"></script>
-->        <script src="scripts/proton/dashdemo.js"></script>
       
        
        <!-- Bootstrap Tags Input -->
        <!-- http://timschlechter.github.io/bootstrap-tagsinput/examples/ -->
        <script src="<?php echo SURL; ?>scripts/vendor/bootstrap-tagsinput.min.js"></script>
        
    
        <!-- Raphael, used for graphs -->
        <!-- http://raphaeljs.com/ -->
        <script src="scripts/vendor/raphael-min.js"></script>
        
        <!-- Morris graphs -->
        <!-- https://github.com/oesmith/morris.js -->
        <script src="scripts/vendor/morris.min.js"></script>
        
        
        <!-- Page-specific scripts: -->
        <script src="scripts/proton/sidebar.js"></script>
		<script src="scripts/proton/intro.js"></script>

        <script src="scripts/proton/tables.js"></script>
        <script src="scripts/proton/graphsStats.js"></script>
         
        <!-- jsTree -->
        <script src="scripts/vendor/jquery.jstree.js"></script>
        
        <!-- Intro JS -->
        <!-- https://github.com/usablica/intro.js -->
        <script src="scripts/vendor/intro.min.js"></script>

        
        <script src="scripts/vendor/jquery.sparkline.min.js"></script>
        <!-- Data Tables -->
        <!-- http://datatables.net/ -->
        
		<script src="scripts/vendor/jquery.dataTables.min.js"></script>
        
        <!-- Data Tables for BS3 -->
        <!-- https://github.com/Jowin/Datatables-Bootstrap3/ -->
        <!-- NOTE: Original JS file is modified -->
        
		
		<script src="scripts/vendor/datatables.js"></script>
        
        
        
        
        <!-- Select2 For Bootstrap3 -->
        <!-- https://github.com/fk/select2-bootstrap-css -->
        <!--<script src="scripts/vendor/select2.min.js"></script> -->
        
        <!-- Number formating for dashboard demo -->
        <script src="scripts/vendor/numeral.min.js"></script>
        
        <!-- Notifications -->
        <!-- http://pinesframework.org/pnotify/ -->
        <script src="scripts/vendor/jquery.pnotify.min.js"></script>
        <script src="js/jquery.mCustomScrollbar.js"></script>

	<script type="text/javascript">
		
		(function($){
      
   
		 
			<?php if($_REQUEST['CNT']>0){
					if($_REQUEST['TERR']!='') { 
					foreach($_REQUEST['TERR'] as $ERR){?>
					   //proton.dashboard.alerts('<?=$ERR?>','Error!','error');
					   //console.log('<?=$ERR?>');
					    $.jGrowl('<?=$ERR?>', {
						header: 'Error!',
						theme: 'bg-danger'
						});
			<?php 	}}
					if($_REQUEST['TSCS']!='') { 
					foreach($_REQUEST['TSCS'] as $SCS){?>
						 //proton.dashboard.alerts('<?=$SCS?>','Success','success');
						 //console.log('<?=$SCS?>');
						  $.jGrowl('<?=$SCS?>', {
						header: 'Success!',
						theme: 'bg-success'
						});
			<?php 	}}		
				   } ?>  	  
	 
	 })(jQuery);
	
		
        	var input = document.getElementsByTagName('input');
			if(input.length >0){
				for(var indx=0;indx<input.length;indx++){
					if(input.item(indx).type=='file'){
						input.item(indx).onchange = function(){
							validateFileSize(this);
						}
					}
				}
			}
    </script>
	<script >

	function downloadPDF(url){
		
		var level = '<?php echo $LEVEL; ?>';
		var can_download_reports = '<?php echo $COMINF['can_download_reports']; ?>';
		
		if(level=='4' && can_download_reports=='1'){
		alertBox("Your report download feature is disabled due to non payment! <br /><br /> Please contact our  <a href='?action=adsupport&atype=support' target='_blank'>support</a> team.");
		return false; 
		}else{

		try{


			if(document.getElementById('pdfLoader')!= null){


				document.body.removeChild(document.getElementById('pdfLoader'));


			}


		}catch(err){}


		var ifrm = document.createElement('iframe');


		ifrm.style.display='none';

		ifrm.id = 'pdfLoader';

		ifrm.src = url;

		document.body.appendChild(ifrm);


		ifrm.onload = function() {
			var loader = document.getElementById('loading_overlay');

				loader.style.display='none';


				loader.getElementsByTagName('div').item(0).style.display='none';

	   }

			var loader = document.getElementById('loading_overlay');

			loader.style.display='block';

			loader.getElementsByTagName('div').item(0).style.display='block';

	}

	}


</script>
<script>
    (function($){
        $(window).load(function(){
            $(".blk_adv_right").mCustomScrollbar();
        });
    })(jQuery);
	
</script>

    </body>
</html>