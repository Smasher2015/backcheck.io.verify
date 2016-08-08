<div class="box grid_16">

       <?php /*?> <h2 class="box_head"><?=$PTITLE?></h2><?php */
	   $company_id = ($LEVEL==4)?$COMINF[id]:96;
	   function getClientPoc($company_id,$whr){
	   global $db;
	   $data = array();
	   $whr = ($whr!="")?" AND $whr ":"";
	   
	   $sel = $db->select("clients_poc","*","com_id=$company_id $whr");
	   
	   if(@mysql_num_rows($sel)>0){
		while($rs = @mysql_fetch_assoc( $sel)){
		$data[] = $rs;
		}   
	   }
	 
	   return $data;
	   }
	   $data = getClientPoc($company_id,"poc_designation='finance'");
	   ?>

       

        <div class="toggle_container">

           <form action="" method="post" enctype="multipart/form-data">
                <div class="dataFields">
                        <div class="col-md-6">
                        <div class="form-group">
                            <label>Name:</label>
                            <input type="text" class="form-control" name="poc_name" value="<?php echo $data[0]['poc_name']; ?>" />
                            <div class="clear" ></div>
                        </div>
                        </div>
                         
                         <div class="col-md-6">
                        <div class="form-group">
                             <label>Email:</label>
                            <input type="text" class="form-control" name="poc_email" value="<?php echo $data[0]['poc_email']; ?>" />
                            <div class="clear" ></div>
                        </div> </div>   
                        
                         <div class="col-md-6">
                        <div class="form-group">
                             <label>Phone:</label>
                             <input type="text" class="form-control" name="poc_phone" value="<?php echo $data[0]['poc_phone']; ?>" />
                            <div class="clear" ></div>
                        </div></div>             
                        
                         
						
							<div class="col-md-12">
                          <button class="btn bg-success pull-right" type="submit" name="update_billing_contact"><i class="icon-reset position-left"></i> Update Billing Contact</button>
                            
                            <div class="clear" ></div>
                        </div>						
                        
                        <div class="clear"></div>
                </div>
            </form>          
        

        <div class="clear"></div>

        </div>

</div>

