<?php
	if(!isset($_POST['sdate']) && !isset($_POST['edate'])){
		$mDate = $db->select("ver_data","MIN(v_date) mi, MAX(v_date) mx","com_id=$COMINF[id]");
		$mDate =  mysql_fetch_assoc($mDate);
		$_REQUEST['sdate']= date("j M Y",strtotime($mDate['mi']));
		$_REQUEST['edate']= date("j M Y",strtotime($mDate['mx']));
	}
?>
<div class="box grid_16">
        <h2 class="box_head">Select Date Range</h2>
        <a href="#" class="grabber">&nbsp;</a>
        <a href="#" class="toggle">&nbsp;</a>
        <div class="toggle_container">
                <div class="section">
                <form class="validate_form" name="misreports" method="post" enctype="multipart/form-data">
	<fieldset>
            <div style="display:inline-block;">
                <div class="dataTables_filter">
                    <label>To: 
                        <input type="text" readonly="readonly" value="<?=$_REQUEST['edate']?>" class="datepicker required text" name="edate" >
                    </label>
                </div>
                <div class="dataTables_filter">
                    <label>From:
                        <input type="text" readonly="readonly" value="<?=$_REQUEST['sdate']?>" class="datepicker required text" name="sdate">
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
					$link="?action=excel&efile=data&name=risk_wise";
					if(isset($_POST['sdate']) && isset($_POST['edate'])){
						$sdate=changDate($_POST['sdate']);
						$edate=changDate($_POST['edate'],1);
						$link="$link&sdate=$sdate&edate=$edate";
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

    
<script type="text/javascript" src="js/highcharts.js"></script>      
<?php include("include_pages/chart_rga_inc.php"); ?>
                                                
<?php include("include_pages/cases-main_inc.php")?>        
        


