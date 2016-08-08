<script type="text/javascript" >

$(document).ready(function() {
    $('.select_box').change(function(){
	
//   alert(document.getElementById('select_box').value);
   var c_value=document.getElementById('select_box').value;
   document.getElementById('hdfield').value=c_value;
  //  alert(document.getElementById('hdfield').value);
			
    });
});

</script>


<div class="box grid_16">
        <h2 class="box_head">Select Component</h2>
        <a href="#" class="grabber">&nbsp;</a>
        <a href="#" class="toggle">&nbsp;</a>
        <div class="toggle_container">
                <div class="section">
                <form class="validate_form" method="post" enctype="multipart/form-data"> 
                <input type="hidden" id="hdfield" name="hdfield" /> 
             
                
                       <fieldset >
                       
                    <div style="width:250px;display:inline-block;">
                  <select name="com_select" id="select_box" class="select_box" onChange="this.form.submit()">
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
				 while($checks=mysql_fetch_array($companies)){
						if(isset($_POST['com_select']))
						{
							if($_POST['com_select']==$checks['id'])
							{
								
							}
							 else
							 {
					 ?>
					  <option value="<?=$checks['id']?>"><?=$checks['name']?></option>	
					 <?php
							 }
						}
						else
						{ 
					 ?>
					  <option value="<?=$checks['id']?>"><?=$checks['name']?></option>	
					 <?php
						}
					 
					
								}?>
                                </select>
                    </div>
              
                                <div style="width:250px;display:inline-block;">
                                <select name="com_check" class="select_box">
                                        <option value="">--All Components--</option>
                                <?php 
									$tbl="ver_checks vc INNER JOIN ver_data vd ON vd.v_id=vc.v_id INNER JOIN checks ck ON vc.checks_id=ck.checks_id";
                                    $twhere = "vd.com_id=".$_POST['com_select']." AND vd.v_status='close' ORDER BY ck.checks_title";
									$ch=$db->select($tbl,"DISTINCT ck.checks_id,ck.checks_title",$twhere);        
                                    while($checks=mysql_fetch_array($ch)){
										
										?>
                                           <option value="<?=$checks['checks_id']?>" <?=($checks['checks_id']==$_REQUEST['com_check'])?'selected="selected"':''?> >
                                            <?php echo mb_convert_encoding($checks['checks_title'], 'HTML-ENTITIES','UTF-8');?>
                                           </option>
                                <?php } ?>
                                </select>
                                </div>
                                <span style="padding:15px 20px; display:inline-block">
                                    <button class="next_step move send_right" type="submit"  name="cmpfltr" data-goto="step_3">
                                        <img height="24" width="24" alt="Bended Arrow Right" src="images/icons/small/white/bended_arrow_right.png">
                                        <span>Filter</span>
                                    </button>
                                </span>
                                <span style="padding:22px;float:right;">
                                    <?php 
                                        $link="?action=excel&efile=manager_data&name=component_wise";
										if(is_numeric($_REQUEST['com_check'])&&is_numeric($_POST['com_select'])){
											$com_id=$_POST['com_select'];
											$link = "$link&check=$_REQUEST[com_check]&com_id=$com_id";	
										}		
										
								//		  action=excel&efile=data&name=component_wise&check=1	
                                    
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
<?php include("include_pages/manager_chart_rga_inc.php"); ?>														

<?php 

		include("include_pages/manager-cases-main_inc.php");

?>        
        


