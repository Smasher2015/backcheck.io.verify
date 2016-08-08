
				<!-- Content area -->
				<div class="content">
  				<div class="page-header">
                    <div class="page-header-content">
                        <div class="page-title2">
                    	<h4><i class="icon-arrow-left52 position-left"></i> Over All Activities</h4>
                    </div>
                    </div>
                    </div>
					<!-- Timeline -->
					<div class="timeline timeline-center content-group" id="mainforscroll">
						<div class="timeline-container" id="datascroll" >

					<div class="timeline-row post-full">
								<div class="timeline-icon">
									<div class="bg-blue">
										<i class="icon-stack"></i>
									</div>
								</div>

								<div class="panel panel-flat timeline-content">
									
									<div class="panel-body">
                                    	<form  method="post" id="addCheckFrm"  >

<div class="form-group">
                <div class="row">
  <?php
if($LEVEL == 2)
{
?>               
                  <div class="col-md-6">
                       <label class="col-md-4">Select Client:</label>
                    <select id="comid" name="comid" class="select" onchange="document.getElementById('addCheckFrm').submit();">
                      <option value=""> --------Select Client-------- </option>
                      <?php 	$db = new DB();
                                                $dWhere="1=1 order by name asc";							
                                                $coms = $db->select("company","*",$dWhere);
                                              //   echo "select * from company where $dWhere";
                                                $coid = (isset($_REQUEST['comid']))?$_REQUEST['comid']:0;
                                                while($com =mysql_fetch_array($coms)){  ?>
                      <option value="<?=$com['id']?>" <?php if($_REQUEST['comid'] != ""){ echo ($com['id']==$_REQUEST['comid'])?'selected="selected"':'';}else{echo ($com['id']==1)?'selected="selected"':'';}?>>
                      <?=$com['name']?>
                      </option>
                      <?php	} ?>
                    </select>
                  </div>
                  
    <?php
}
 
   ?>  
   					 <?php  
									$company_id = $COMINF['id'];
									if(in_array($company_id,unserialize(CHECK_COMIDS))){
									$userInf = getUserInfo($_SESSION['user_id']); 
									if($userInf['is_subuser']==0){ ?>
				 	
				  
							   
							
							 
								  
							
   
   
   
   
   
                    
                  
                  <div class="col-md-6">
                       <label class="col-md-4">Select Location:</label>
                    <select id="locid" name="locid" class="select" onchange="document.getElementById('addCheckFrm').submit();">
                      <option value="0"> --------Select Location-------- </option>
                     
                     
                     <?php 
							
							$where = " com_id=$COMINF[id] AND status=0 ORDER BY location ASC";
							
							$getuLocations = $db->select("users_locations","*",$where);
							
							while($rsLocations = mysql_fetch_array($getuLocations)){ ?>
						
							<option value='<?=$rsLocations['loc_id']?>' <?php echo chk_or_sel($_REQUEST['locid'],$rsLocations['loc_id'],'selected'); ?> >
							<?php echo $rsLocations['location'];?>
							</option>
							
							<?php } ?>
                     
                     
                     
                    </select>
                  </div>
                  
                  
                  	<?php 
								}
								}
								  ?>
   
   
                  
                  
                
           
        
                  <div class="col-md-6">
                    <label class="col-md-4">Select Activity Type:</label>
                    <select id="a_type" name="a_type" class="select col-md-8" onchange="document.getElementById('addCheckFrm').submit();">
                      <option value="0"> --------Select Activity Type-------- </option>
                      <?php 	$db = new DB();  
                                                $dWhere="1=1 AND a_type <> 'logout' order by a_type asc";							
                                                $coms = $db->select("activity","DISTINCT(a_type)",$dWhere);
                                              //   echo "select * from company where $dWhere";
                                                $coid = (isset($_REQUEST['a_type']))?$_REQUEST['a_type']:0;
                                                while($com =mysql_fetch_array($coms)){  ?>
                      <option value="<?=$com['a_type']?>" <?php echo ($com['a_type']==$_REQUEST['a_type'])?'selected="selected"':'';?>>
                      <?php echo ucwords($com['a_type']);?>
                      </option>
                      <?php	} ?>
                    </select>
                  </div>
                </div>
				</div>       
              </form>
                                    </div>
								</div>
							</div>




							 
<?php
//echo ' locid '.$_REQUEST['locid'].' comid '.$_REQUEST['comid'];

if($_REQUEST['locid'] != '' && $_REQUEST['locid'] != '0')
{


$allids = getUseridsByLocationId($_REQUEST['locid'],$_REQUEST['comid']);
//var_dump($allids);
if(count($allids)>0){
$user_loc_ids = implode(",",$allids);
$as_uadd = " and vc.as_uadd IN ($user_loc_ids)";
$for_subuser = ""; 
}
 
 
}

 
                        if($LEVEL==4)
						{  
							$forclient = "$COMINF[id]"; 
							$for_subuser = "act.user_id=$_SESSION[user_id] AND "; 
						}
						else 
						{
							if($_REQUEST['comid'] != "")
							{
							$company_id = $_REQUEST['comid'];
							$forclient = "$company_id";
							}
							else{$forclient = "1";}
						}
						if(isset($_REQUEST['a_type']) && ($_REQUEST['a_type'] != '0') && ($_REQUEST['a_type'] != 'login') && ($_REQUEST['a_type'] != 'logout'))
						{
							$particular_activity = "a_type = '$_REQUEST[a_type]' AND";
						}
						else{$particular_activity = "";}
						 
						
						$tbls = "activity as act INNER JOIN ver_data as vd ON act.v_id=vd.v_id INNER JOIN ver_checks as vc ON act.v_id=vc.v_id";
						$cols = "*";
						
						// THIS FOR LOAD MORE BUTTON START //
						
						$whre2 = "vd.com_id=$forclient AND $particular_activity  vd.v_isdlt=0 AND vc.as_isdlt=0 $whr order by act.a_date DESC";
						$activityquery2 = $db->select($tbls,$cols,$whre2);
						$totalentries = @mysql_num_rows($activityquery2);
						
						
						// THIS FOR LOAD MORE BUTTON  END //
						
						
						$whre = "vd.com_id=$forclient AND $for_subuser $particular_activity act.ext_id <> '' AND vd.v_isdlt=0 AND vc.as_isdlt=0 $as_uadd $whr order by act.a_date DESC LIMIT 0,50";
						//echo "SELECT * FROM $tbls where $whre";
						$activityquery = $db->select($tbls,$cols,$whre);
						
						
						
 						if(@mysql_num_rows($activityquery)>0){
						$count = 1;	
                        while($rec = mysql_fetch_array($activityquery))
                        {  
                            
					 // $act_count = @mysql_num_rows($db->select("activity","a_id","a_id=$rec[a_id] AND is_read=0"));
					 // if( $act_count>0){
					//  $db->update("is_read=1","activity","a_id=$rec[a_id]");
					 // }
					  //if($rec['ext_id']){
                      $getVerdata = getVerdata($rec['v_id']);
                      $getCheck = getCheck('',$rec['v_id'],$rec['ext_id']); 
                       
                        $checks = $db->select("checks","*","checks_id = $getCheck[checks_id]");
                        $check =  mysql_fetch_assoc($checks);	
                        $checkName = $check['checks_title'];
                            //checks_id 
                            if($rec['a_actn'] == 'remark')
                            {
                                $detail = "Manager Remarks On ".$checkName.".";
								$icon_class = "icon-user-tie";
								$icon_class_bg = "bg-indigo-300";
                            }
                            else if($rec['a_actn'] == 'close')
                            {
                                if($rec['a_type'] == 'case')
                                {
                                    $detail = $getVerdata['v_name']." Case Close.";
                                }
                                else
                                {
                                    $detail = $checkName." check Close.";
                                }
								$icon_class = "icon-user-tie";
								$icon_class_bg = "bg-success-300";
                            }
                            else if($rec['a_actn'] == 'edit')
                            {
                                $detail = $checkName." Work in progress.";
								$icon_class = "icon-info3";
								$icon_class_bg = "bg-slate-300";
                            }
                            else if($rec['a_type'] == 'pdf')
                            {
                                $detail = $getVerdata['v_name']." Case Report Download.";
								$icon_class = "icon-file-pdf";
								$icon_class_bg = "bg-teal-300";
								$checkName = 'Applicant '.$getVerdata['v_name'];
                            }
                            else if($rec['a_type'] == 'notification')
                            {
                                $detail =  str_replace("id ".$rec['v_id'],$getVerdata['v_name'],$rec['a_info']);
								$icon_class = "icon-googleplus5";
								$icon_class_bg = "bg-brown-300";
								$checkName = 'Applicant '.$getVerdata['v_name'];
                            }
                            else if($rec['a_type'] == 'qastatus')
                            {
                                $detail = $rec['a_info'];
								$icon_class = "icon-search4";
								$icon_class_bg = "bg-pink-300";
                            }
							else if($rec['a_type'] == 'insufficient')
                            {
                                $detail = $rec['a_info'];
								$icon_class = "icon-search4";
								$icon_class_bg = "bg-warning-300";
                            }
                            /*else if($rec['a_type'] == 'login')
                            { 
								$getuser = getUserInfo($rec['user_id']);
                                $detail = $getuser['first_name'].' '.$getuser['last_name']." Login";
								$icon_class = "icon-checkmark4";
								$icon_class_bg = "bg-info-400";
                            }*/
                            else
                            { 
                                $detail = "No Content Available";
								$icon_class = "icon-checkmark4";
								$icon_class_bg = "bg-info-300";
                            }
                     
                            $time_diff = time_ago(strtotime($rec['a_date']));
							
							
						if ($count % 2 == 0)
						{$odd_even_class = "post-even";}
						else{$odd_even_class = "";}	
						?>
                         <div class="timeline-row <?=$odd_even_class?>">
								<div class="timeline-icon">
									<div class="<?=$icon_class_bg?>">
										<i class="<?=$icon_class?>"></i>
									</div>
								</div>

								<div class="timeline-time">
									<a href="?action=details&case=<?php echo $rec['v_id'].'&_pid=81#check_tab_'.$rec['ext_id'];?>" target="_blank"><?=$checkName?></a>  
									<span class="text-muted"><?=$time_diff?></span>
								</div>

								<div class="panel panel-flat timeline-content <?=$icon_class_bg?>">
									<div class="panel-heading">
										<span class="panel-title"><?=$detail?></span>
									</div>									
								</div>
							</div>
                            
                        
                            
                            
                            
                            <div class="timeline-date text-muted">
                            
<?php
$timestamp = date("Y.m.d H:i",strtotime($rec['a_date']));

$today = new DateTime(); // This object represents current date/time
$today->setTime( 0, 0, 0 ); // reset time part, to prevent partial comparison

$match_date = DateTime::createFromFormat( "Y.m.d H:i", $timestamp );
$match_date->setTime( 0, 0, 0 ); // reset time part, to prevent partial comparison

$diff = $today->diff( $match_date );
$diffDays = (integer)$diff->format( "%R%a" ); // Extract days count in interval

switch( $diffDays ) {
    case 0:
        echo "Today";
        break;
    case -1:
        echo "Yesterday";
        break;
    /*case +1:
        echo "//Tomorrow";
        break;*/
    default:
        echo $timestamp;
}

?>                                
                            
                            </div>
                        <?php
                        //}
						$count++;
						}
 		 			
						// while end
						}
						
						
						if($LEVEL==2)
						{  
							if($_REQUEST['comid'] != "")
							{
							$company_id = $_REQUEST['comid'];
							 
							}
							else{
								$company_id = "1";
							}
							$forcom_or_user = "u.com_id = $company_id";
						 
						}
						else
						{
							$forcom_or_user = "act.user_id = $_SESSION[user_id]";
						}
						
						$tbls_login = "activity as act INNER JOIN users as u ON act.user_id=u.user_id";
						$cols_login = "*";
						$whre_login = "act.a_type = 'login' and $forcom_or_user order by a_date DESC LIMIT 0,20";
						 
						$activityquery_login = $db->select($tbls_login,$cols_login,$whre_login);
						// echo "SELECT * FROM $tbls_login where $whre_login";
						 if(@mysql_num_rows($activityquery_login)>0){
						$counts = 1;	
                        while($rec = mysql_fetch_array($activityquery_login))
                        {  
						 $time_diff = time_ago(strtotime($rec['a_date']));
						if($counts == 1){$last_login = "Last ";}else{$last_login = '';}
                                $detail = $last_login."Login at".$time_diff;
								$icon_class = "icon-checkmark4";
								$icon_class_bg = "bg-info-300";
                            
                      
                           
							
							
						if ($counts % 2 == 0)
						{$odd_even_class = "post-even";}
						else{$odd_even_class = "";}	
						?>
                         <div class="timeline-row <?=$odd_even_class?>">
								<div class="timeline-icon">
									<div class="<?=$icon_class_bg?>">
										<i class="<?=$icon_class?>"></i>
									</div>
								</div>

								<div class="timeline-time">
									<a href="javascript:void(0);"><?=$rec['first_name'].' '.$rec['first_name']?></a>  
									<span class="text-muted"><?=$time_diff?></span>
								</div>

								<div class="panel panel-flat timeline-content <?=$icon_class_bg?>">
									<div class="panel-heading">
										<span class="panel-title"><?=$detail?></span>
									</div>									
								</div>
							</div>
                            <div class="timeline-date text-muted"><?php
$timestamp = date("Y.m.d H:i",strtotime($rec['a_date']));

$today = new DateTime(); // This object represents current date/time
$today->setTime( 0, 0, 0 ); // reset time part, to prevent partial comparison

$match_date = DateTime::createFromFormat( "Y.m.d H:i", $timestamp );
$match_date->setTime( 0, 0, 0 ); // reset time part, to prevent partial comparison

$diff = $today->diff( $match_date );
$diffDays = (integer)$diff->format( "%R%a" ); // Extract days count in interval

switch( $diffDays ) {
    case 0:
        echo "Today";
        break;
    case -1:
        echo "Yesterday";
        break;
    /*case +1:
        echo "//Tomorrow";
        break;*/
    default:
        echo $timestamp;
}

?>      </div>
                        <?php
                         
						$counts++;
						}
 		 			
						// while end for login
						 
												
						
						
						
						
						
						
						
						
						
						
						
						}
						else{
							echo "No Activity Generated";  
						}
 
						?>
                        <div id="loadmoreresponse"></div>
                        <div id="nomoreresult" style="display:none">No More Activities</div>
 					 <?php if($totalentries>50){ ?>
<button type="button" class="btn filebtn btn-success float-left check_cnic" id="load_more">Load More</button><?php } ?>


							<!-- Schedule -->
							 
							<!-- /schedule -->

						</div>
				    </div>
      
    <script type="text/javascript">
	var cur_index=0;
	var cur_index2=0;
	var a_type = $("#a_type").val();
	var locid = $("#locid").val();

	cur_index=parseInt(cur_index)+50;
	cur_index2=parseInt(cur_index2)+20;
	var screen_height = $('body').height();
	var cury = $(window).scrollTop();
	var screen = $(window).height();
	$('#load_more').click(function(){
      
	 $.ajax({
			type: 'POST',
            url: "actions.php",
            data: 'ePage=add_rating&activities_list=yes&limit='+cur_index+'&limitlogin='+cur_index2+'&compid=<?=$forclient?>&a_type='+a_type+'&locid='+locid,
            success: function(result){
                cur_index +=50;
                cur_index2 +=20;
                screen_height = $('body').height();
				//console.log(result);
				if(result == ''){$('#load_more').hide();$('#nomoreresult').show();}
				
                $( "#loadmoreresponse" ).fadeIn( 400 ).append(result);
				    
            }
        });
});
  	</script>


        

					<!-- Footer -->
					 
					<!-- /footer -->

				</div>
				<!-- /content area -->