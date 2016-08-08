<div class="row">
                            	
	<div class="col-lg-12">
		<ul class="panel stats">
		 <li>
			<?php 
			// Due for download box count			
			include("basic_dashboard/due_for_download_box_count.php");
			?>
	    </li>
        <li>
		<?php // Ready For Download box count 
		include("basic_dashboard/ready_for_download_box_count.php");
		?>
		</li>
        <li>
		<?php // Overdue checks box count
		include("basic_dashboard/overdue_checks_box_count.php");
		?>
	    </li>
		 <li>
		  <?php // Applicants Invite / Join box count 
		include("basic_dashboard/pending_actions_box_count.php");
		?>
	    </li>
         <li>
		 <?php // Applicants Invite / Join box count 
		include("basic_dashboard/applicants_invite_box_count.php");
		?>

	    </li>
        
                                
                                </ul>
                            </div>
                            
                            </div>