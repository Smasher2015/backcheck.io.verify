		<script type="text/javascript">
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
        <!--<div id="loading_overlay">
			<div class="loading_message round_bottom">
				<img src="images/loading.gif" alt="loading" />
			</div>
		</div>-->
		<?php /*?><div class="Xcluesiv"><a href="http://xcluesiv.com/" >Powered by Xcluesiv Cloud Technology Pte Ltd</a></div><?php */?>
		<?php //include 'includes/template_options.php'?>		
	</body>
</html>