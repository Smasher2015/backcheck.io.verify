<?php


	if(!isset($_POST['sdate']) && !isset($_POST['edate'])){
		$mDate = $db->select("ver_data","MIN(v_date) mi, MAX(v_date) mx");
		$mDate =  mysql_fetch_assoc($mDate);
		$_REQUEST['sdate']= date("j M Y",strtotime($mDate['mi']));
		$_REQUEST['edate']= date("j M Y",strtotime($mDate['mx']));
	}
?>
<section class="retracted scrollable">
<div class="row">
 	<div class="col-md-12">
        <div class="manager-report-sec">
        <div class="page-section-title">
        <h2 class="box_head">Select Date Range</h2>
       </div>
          <div class="panel panel-default panel-block"> 
<div class="list-group">
            <div class="list-group-item">
                <form class="validate_form" name="misreports" method="post" enctype="multipart/form-data">
	<fieldset>
            <div style="display:inline-block;">
               <div class="dataTables_filter">
               <label> Company:
                  <select name="com_select" class="select_box">
                                        <option value="">--Select Company--</option>		
                                         <?php 
									  	if(isset($_POST['com_select'])){
											$company_selected=$db->select('company','DISTINCT name,id','id='.$_POST['com_select']);
											$com_name=mysql_fetch_array($company_selected);
											echo  "<option value=".$_POST['com_select']." selected='selected'>".$com_name['name']."</option>";
											}
									  ?> 	
            <?php

				$companies=$db->select('company','*','is_active=1');        
				 while($checks=mysql_fetch_array($companies)){?>
					  <option value="<?=$checks['id']?>"><?=$checks['name']?></option>	
					 <?php
								}?>
                                </select>
                                </label>
                    </div>
            
            
                <div class="dataTables_filter">
                    <label>To: 
                        <input type="text" value="<?=$_REQUEST['edate']?>" class="datepicker required text datetimepicker-month2" name="edate" >
                    </label>
                </div>
                <div class="dataTables_filter">
                    <label>From:
                        <input type="text"  value="<?=$_REQUEST['sdate']?>" class="datepicker required text datetimepicker-month1" name="sdate">
                    </label>
                </div>     
            </div>
            <span style="padding:15px 20px; display:inline-block">
            <button class="next_step move send_right" type="submit"  name="searchbydate" data-goto="step_3">
                <img height="24" width="24" src="images/icons/small/white/bended_arrow_right.png">
                <span>Filter</span>
            </button>
            </span>
			<span style="padding:22px;float:right;">
            	<?php 
					$link="?action=excel&efile=manager_data&name=risk_wise";
					if(isset($_POST['sdate']) && isset($_POST['edate']) && isset($_POST['com_select'])){
						$com_id=$_POST['com_select'];
						$sdate=changDate($_POST['sdate']);
						$edate=changDate($_POST['edate'],1);
						$link="$link&sdate=$sdate&edate=$edate&com_id=$com_id";
					}		
				?>
                <button class="send_right" type="button"  onclick="export_excel('<?=$link?>','misreports');"  >
                	<img height="24" width="24" src="images/icons/small/grey/download.png">
                	<span>Export MIS</span>
                </button>
            </span>            
     </fieldset>
</form>
                 </div>
        </div>
        </div>
</div>     
</div>
</div>
</section>
    
<script type="text/javascript" src="js/highcharts.js"></script>      
<?php include("include_pages/manager_chart_rga_inc.php"); ?>
                                                
<?php include("include_pages/manager-cases-main_inc.php")?>        
        
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
											  
                                              <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script type="text/javascript">
												$(function () {
												$( ".datetimepicker-month1, .datetimepicker-month2").datepicker({
												dateFormat: 'dd M yy',
												changeMonth: true,
												changeYear: true,
												yearRange: "1980:2015"
												});
												});
												</script>

