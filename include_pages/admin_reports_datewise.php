<?php
	$COMINF['id']='';
	if(isset($_POST['com_select'])) $COMINF['id']=$_POST['com_select'];

	if(!isset($_POST['sdate']) && !isset($_POST['edate'])){
		$_REQUEST['sdate']= date("j M Y",strtotime('-30 days'));
		$_REQUEST['edate']= date("j M Y",time());
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
<div class="list-group-item">
            <div class="list-group-item">


<form class="validate_form" name="misreports" method="post" enctype="multipart/form-data">



                
				<div class="form-group">
                <label>Company: </label>
				<select name="com_select" class="select_box form-control">

                                        <option value="">--Select Company--</option>			

           			 <?php
					$companies=$db->select('company','*','is_active=1');          

				 while($checks=mysql_fetch_array($companies)){?>

					  <option value="<?=$checks['id']?>" <?php if($checks['id']==$COMINF['id']){?> selected="selected" <?php }?>><?=$checks['name']?></option>	

					 <?php

								}?>

                                </select>
                </div>
				
                <div class="form-group">
                <div class="dataTables_filter">

                    <label>To: </label>

                        <input type="text"  value="<?=$_REQUEST['edate']?>" class="datepicker required text datetimepicker-month2 form-control" name="edate" >

                    

                </div>
				</div>
                <div class="form-group">
                <div class="dataTables_filter">

                    <label>From:</label>

                        <input type="text"  value="<?=$_REQUEST['sdate']?>" class="datepicker required text datetimepicker-month1 form-control" name="sdate">

                    

                </div>     
				</div>
			
            <div class="form-group">
                <label>Status: </label>
				<select name="status" class="select_box form-control">

                                        <option value="">--Select Status--</option>	

 	

            <?php


					if(!isset($_POST['status'])) $_POST['status']='';
					$checksstatus=$db->select('ver_checks','DISTINCT as_vstatus','1=1');          

					while($status=mysql_fetch_array($checksstatus)){?>

					  <option value="<?=$status['as_vstatus']?>" <?php if($status['as_vstatus']==$_POST['status']){?> selected="selected" <?php }?>><?=$status['as_vstatus']?></option>	

					 <?php }?>

                                </select>
            </div>                
            
            
            <div class="list-button-section">

            <button class="next_step move send_right btn filebtn btn-success check_cnic" type="submit"  name="searchbydate" data-goto="step_3">

                <span>Filter</span>

            </button>

			  </div>
</form>

               
	</div>		
    
    
    <span style="float:right; margin-top: 20px;">

            	<?php 

					$link="?action=excel&efile=manager_data&name=data_wise";

					if(isset($_POST['sdate']) && isset($_POST['edate'])&& isset($_POST['com_select'])){

						$com_id=$_POST['com_select'];

						$sdate=changDate($_POST['sdate']);

						$edate=changDate($_POST['edate'],1);
						
						echo "edate:  ".$_POST['edate']." after chng: ".$edate;

						$link="$link&sdate=$sdate&edate=$edate&com_id=$com_id&status=$_POST[status]";
						//echo $link;

					}		

				?>

                <button class="send_right btn filebtn btn-success check_cnic" type="button"  onclick="export_excel('<?=$link?>','misreports')" >

                	<span>Export MIS</span>

                </button>

            </span>
            
            
            <div class="clearfix"></div>
</div>
</div>
</div>
</div>
    

<div class="row">
 	<div class="col-md-12">
        <div class="manager-report-sec">
  <div class="page-section-title">
        <h2 class="box_head"><?=$PTITLE?></h2>
</div>
   <div class="panel panel-default panel-block"> 
<div class="list-group">
   <div class="list-group-item">					

        <div class="block">

               <script type="text/javascript" src="js/highcharts.js"></script>

               <?php include("include_pages/manager_chart_opcl_inc.php"); ?>	

        </div>

    </div>

</div>
        </div>

</div> 
</div>
               
</div>
</section>

			  											

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
