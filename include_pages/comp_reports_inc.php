<section class="retracted scrollable">
<div class="row">

<div class="col-md-12">
 <div class="manager-report-sec">
         <div class="page-section-title">
        <h2 class="box_head">Select Component</h2>
        </div>
     <div class="panel panel-default panel-block"> 
<div class="list-group">
            <div class="list-group-item">
                <form class="validate_form" method="post" enctype="multipart/form-data">     
                       <fieldset class="label_side">
                                <div style="width:250px;display:inline-block;">
                                <select name="com_check" class="select_box">
                                        <option value="">--All Components--</option>
                                <?php 
									$tbl="ver_checks vc INNER JOIN ver_data vd ON vd.v_id=vc.v_id INNER JOIN checks ck ON vc.checks_id=ck.checks_id";
                                    $twhere = "vd.com_id=$COMINF[id] AND vd.v_status='close' ORDER BY ck.checks_title";
									$ch=$db->select($tbl,"DISTINCT ck.checks_id,ck.checks_title",$twhere);        
                                    while($checks=mysql_fetch_array($ch)){?>
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
                                        $link="?action=excel&efile=data&name=component_wise";
										if(is_numeric($_REQUEST['com_check'])){
											$link = "$link&check=$_REQUEST[com_check]";	
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
<?php include("include_pages/chart_rga_inc.php"); ?>														

<?php 

		include("include_pages/cases-main_inc.php");

?>        
        


