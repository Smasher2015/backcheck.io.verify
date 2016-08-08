<div class="rightWidget">
  <h2 style="color: antiquewhite;">Recent Cases Progress</h2>
  <?php
  
  $twhere="v_status!='Not Assign'";
  $torder="v_date DESC LIMIT 5";
  
  $topcase = client_case_info($twhere,$torder);
 
  foreach($topcase['data'] as $cases)
  {
	  $twhere='c.v_id='.$cases['v_id'];
 ?> 
 <h5 style="color: antiquewhite;" > <?php echo $cases["v_name"]; ?></h5>

<?php

	 $tcheck = client_checks_info($twhere);
	 
	
	
	 //foreach($tcheck as $checks)
	 //{		 
  ?>
  <div class="form-group">
                                    
			<?php 
		
		while($rs = mysql_fetch_assoc($tcheck))
		  {
			  
	  
	  //var_dump($rs);
	  
		  $asStatus = $rs['as_status'];
		   $checks_title = $rs['checks_title'];
		  if($asStatus=="Not Assign"){
			  $asStatus_ = "Pending";
			  $width_ = 25;
			  $cl = rand(10,100);
			  			  
		  }else if($asStatus=="Open"){
			  $asStatus_ = "In Progress";
			  $width_ = 50;
			  $cl = rand(10,100);
			  			  
		  }else if($asStatus=="Problem"){
			  $asStatus_ = "QC";
			  $width_ = 75;
			  $cl = rand(10,100);
			  			  
		  }else if($asStatus=="Close"){
			  $asStatus_ = "Completed";
			  $width_ = 100;
			  $cl = rand(10,100);
			  		  
		  }
	  ?>
			  
	<?php /* 	  <div class="progress-bar progress-bar-success" style="width: <?php echo $width_;?>%;  background-color:#aece<?php echo $cl;?>">
                <span class="sr-only"><?php echo $width_;?>% <?php echo $checks_title;?> (<?php echo $asStatus_;?>)</span>
          </div> */ ?>
		  
		  

	<?php if($asStatus=="Open"){ ?>
		  <a class="ctooltips" href="#">
		  <div class="progress progress-thin">
                                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $width_ ?>%;" data-original-title="" title="">
                                           <span>Status:<?php echo $asStatus ?>  Progress:<?php echo $width_ ?>%</span>
                                        </div>
                                    </div>
									</a>
		   <?php } ?>
		   
	<?php if($asStatus=="Not Assign"){ ?>
		  <a class="ctooltips" href="#">
		  <div class="progress progress-thin">
                                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $width_ ?>%;" data-original-title="" title="">
                                           <span>Status:<?php echo $asStatus ?>  Progress:<?php echo $width_ ?>%</span>
                                        </div>
                                    </div>
									</a>
		   <?php } ?>
		   
	<?php if($asStatus=="Problem"){ ?>
		  <a class="ctooltips" href="#">
		  <div class="progress progress-thin">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $width_ ?>%;" data-original-title="" title="">
                                           <span>Status:<?php echo $asStatus ?>  Progress:<?php echo $width_ ?>%</span>
                                        </div>
                                    </div>
									</a>
		   <?php } ?>

		<?php if($asStatus=="Close"){ ?>
		  <a class="ctooltips" href="#">
		  <div class="progress progress-thin">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $width_ ?>%;" data-original-title="" title="">
                                           <span>Status:<?php echo $asStatus ?>  Progress:<?php echo $width_ ?>%</span>
                                        </div>
                                    </div>
									</a>
		   <?php } ?>		
		   
		  <?php } ?>
		  
                                        
                                      
                                   
                                </div>
  <?php
	}
  //}
  ?></div>