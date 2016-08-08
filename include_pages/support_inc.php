<div class="innerdiv">
     <h2 class="head-alt">Contact Support</h2>
        <div class="innercontent">
        <?php
			if(isset($_REQUEST['subcontactus'])){
				$_REQUEST['_id'] = -4;	
				addComments($_REQUEST,"support");
			}
 			include('include_pages/contactus_inc.php'); 
 		?>
        </div>
</div>