<?php
	$add=true;$edit=false;

	if(is_numeric($_REQUEST['case'])){
		$vdta = getVerdata($_REQUEST['case']);
		if($vdta) $add=false;
	}
	
	if(is_numeric($_REQUEST['id'])){

		$vdta = getVerdata($_REQUEST['id']);	

		if($vdta){

			$edit=true;

			$_REQUEST['vname'] = $vdta['v_name'];
			
			$_REQUEST['sid'] = $vdta['v_id'];

			$_REQUEST['vid']   = $vdta['emp_id'];

			$_REQUEST['refid']   = $vdta['v_refid'];

			$_REQUEST['vfname'] = $vdta['v_ftname'];

			$_REQUEST['vnic'] = $vdta['v_nic'];

			$_REQUEST['comId'] = $vdta['com_id'];

			if($vdta['v_dob']!='0000-00-00'){

				$_REQUEST['day']  = date("d",strtotime($vdta['v_dob']));

				$_REQUEST['month']= date("m",strtotime($vdta['v_dob']));

				$_REQUEST['year']= date("Y",strtotime($vdta['v_dob']));

			}else {$_REQUEST['day']='';$_REQUEST['month']='';$_REQUEST['year']='';}

			

			if($vdta['v_recdate']!='0000-00-00'){

				$_REQUEST['rcday']  = date("d",strtotime($vdta['v_recdate']));

				$_REQUEST['rcmonth']= date("m",strtotime($vdta['v_recdate']));

				$_REQUEST['rcyear']= date("Y",strtotime($vdta['v_recdate']));

			}else {$_REQUEST['rcday']='';$_REQUEST['rcmonth']='';$_REQUEST['rcyear']='';}			

		}
	
	}

?>
<script type="text/javascript">
	function get_orderid(ths){
		var cid = ths.options[ths.selectedIndex].value;
		if(cid!=''){
			/*var icallBack = function(){
				$( ".content_accordion" ).accordion({
					collapsible: true,
					active:false,
					header: 'h3.bar',
					autoHeight:false,
					event: 'mousedown',
					icons:false,
					animated: true
				});

				$(".box").animate({
						opacity: 1
						}, function(){
							$(".block").animate({
							opacity: 1
						});
				});
			};*/
			
			var callBack = function (){
					ajaxServices("actions.php",'action=get_orderchecks&cid='+cid,'components');
			};
			
			ajaxServices("actions.php",'action=get_orderid&cid='+cid,'sorder',callBack);
		}
	}
	
</script>
<?php if($edit){ ?>
<div class="row">
 	<div class="col-md-12">
        <div class="manager-report-sec">
        <div class="page-section-title">
        	
                            <h2 class="box_head"><?=(isset($_REQUEST['id']))?'Edit':'Add'?> Case</h2>
        </div>  
            <div class="panel panel-default panel-block">
            	<div class="list-group">
            		<div class="list-group-item">                             
                        <form method="post" enctype="multipart/form-data" class="label_side" >
                        <div class="form-group">
                        <label for="basic-input">Basic Input</label>
                        <input id="basic-input" class="form-control" placeholder="Placeholder Text">
                        </div>

                        
                        <h2 class="box_head">Case Infomation </h2>
                         <div class="form-group">
                        
                            <label >Client<?php if($add){ ?><sup class="sreq">*</sup><?php }?>:</label>
                        
                            <div>
                        
                            <?php if($add && !$edit){ ?>
                        
                            <select name="comId" class="form-control" title="Select client" onchange="get_orderid(this)" >
                        
                                    <option value="">--Select Client --</option>
                        
                            <?php 	
                        
                                    if($_SESSION['user_id']==50 || $_SESSION['user_id']==83){
                        
                                        $dWhere="id=20";
                        
                                    }else $dWhere="is_active=1";										
                        
                                    $coms = $db->select("company","*",$dWhere);
                        
                                    $coid = (isset($_REQUEST['comId']))?$_REQUEST['comId']:0;
                        
                                    while($com =mysql_fetch_array($coms)){  ?>
                        
                                        <option value="<?php echo $com['id']; ?>" <?php echo ($com['id']==$coid)?'selected="selected"':'';?>>
                        
                                            <?php echo $com['name'] ?>
                        
                                        </option>
                        
                            <?php	} ?>
                        
                            </select>
                        
                            <?php }else{ ?>
                                <input type="hidden" value="<?=$_REQUEST['comId']?>" name="comId"   />
                                <?php
                                $conInf = getcompany($vdta['com_id']);
                        
                                $conInf = mysql_fetch_array($conInf);
                        
                                echo $conInf['name'];				
                        
                        }?> 
                        
                            </div>
                        
                        </div>
                        
                        <div class="form-group">
                        
                            <label>Sales Order#:<span>Auto generate</span></label>
                        
                            <div id="sorder"><?php if($add && !$edit){  
                                if(isset($_REQUEST['comId'])){
                                     $_REQUEST['cid'] = $_REQUEST['comId'];
                                     echo get_case_id();
                                }
                            }else echo $vdta['v_bcode']; ?></div>
                        
                        </div>
                        
                        <div class="form-group">
                        
                            <label>Components:</label>
                        
                            <div id="components">
                            <?php if($add && !$edit){
                                    if(isset($_REQUEST['comId'])) get_orderchecks();
                                  }else{
                                    $_REQUEST['cid']=$vdta['com_id'];
                                    $cases = checkDetails($vdta['v_id']);
                                    if($cases){
                                        while($case = mysql_fetch_array($cases)){
                                            echo "<div><strong>".$case['checks_title']."</strong></div>";
                                        }
                                    }
                                    //get_orderchecks();
                                  } ?>
                            </div>
                        
                        </div>
                                                    
                        <div class="form-group">
                        
                            <label>Employee Name <?php if($add){ ?><sup class="sreq">*</sup><?php }?>:</label>
                        
                            <div>
                        
                            <?php if($add){ ?>
                        
                            <input class="req input etitle form-control" placeholder="Employee Name " title="Input Candidate Name" type="text" name="vname" value="<?=$_REQUEST['vname']?>" >
                        
                            <?php }else echo $vdta['v_name']; ?>
                        
                            </div>
                        
                        </div>
                        
                        <div class="form-group">
                        
                            <label>Father's Name<?php if($add){ ?><sup class="sreq">*</sup><?php }?>:</label>
                        
                            <div>
                        
                                <?php if($add){ ?>
                        
                                <input class="req input etitle form-control" placeholder="Father's Name" title="Input Candidate Father's Name" type="text" name="vfname" value="<?=$_REQUEST['vfname']?>" >
                        
                                <?php }else echo $vdta['v_ftname']; ?>
                        
                            </div>
                        
                       </div>
                        
                        <div class="form-group">
                        
                            <label>N.I.C<?php if($add){ ?><sup class="sreq">*</sup><?php }?>:</label>
                        
                            <div>
                        
                            <?php if($add){ ?>
                        
                            <input class="req input etitle form-control" placeholder="N.I.C" title="Input Candidate N.I.C" type="text" name="vnic" value="<?=$_REQUEST['vnic']?>" >
                        
                            <?php }else echo $vdta['v_nic']; ?>
                        
                            </div>
                        
                         </div>
                        
                        <div class="form-group">
                        
                            <label>Employee ID<?php if($add){ ?><sup class="sreq">*</sup><?php }?>:</label>
                        
                            <div>
                        
                            <?php if($add){ ?>
                        
                            <input class="req input etitle form-control" placeholder="Employee ID" title="Input Candidate ID" type="text" name="vid" value="<?=$_REQUEST['vid']?>" >
                        
                            <?php }else echo $vdta['emp_id']; ?>
                        
                            </div>
                        
                         </div>
                        
                       <div class="form-group">
                        
                            <label>Reference ID:</label>
                        
                            <div>
                        
                            <?php if($add){ ?>
                        
                            <input class="input form-control" placeholder="Reference ID:" type="text" name="refid" value="<?=$_REQUEST['refid']?>" >
                        
                            <?php }else echo $vdta['v_refid']; ?>
                        
                            </div>
                        
                        </div>
                        
                         <?php if($add){ ?>
                            <?php }else{ ?>
                                <div class="form-group">
                                    <label>Tracking#:</label>
                                    <div>
                                         <?=bcplcode($vdta['v_id'])?>
                                    </div>
                                </div>                                    
                            <?php }?>
                        
                        
                         <div class="form-group">
                            <label>Important:</label>
                            <div>
                            <?php if($add){ ?>
                                <input type="checkbox" <?=($vdta['v_imp']==1)?'checked="checked"':'';?> name="imp" value="1" >
                            <?php }else echo ($vdta['v_imp']==1)?'Yes':'No'; ?>
                            </div>
                        </div>
                        
                       <div class="form-group">
                        
                        <label>Receive Date:</label>
                        
                         <div>
                        
                        <?php if($add){ ?>
                        
                            <table class="static">
                        
                                <tr>
                        
                                    <td><select name="rcday" class="select_box  " style="opacity: 0; float:left;" >
                        
                                <option value="0" >--Day--</option>
                        
                                <?php
                        
                                    $day = $_REQUEST['rcday'];
                        
                                     for($d=1;$d<=31;$d++){ ?>
                        
                                    <option value="<?php echo ($d<9)?'0'.$d:$d; ?>" <?= ($day==$d)?'selected="selected"':'';?>  >
                        
                                    <?php echo $d; ?>
                        
                                    </option>
                        
                                <?php } ?>
                        
                            </select></td>
                        
                                    <td><select class="select_box" name="rcmonth" style="float:left;">
                        
                                <option value="0" >--Month--</option>
                        
                            <?php
                        
                                 $month = $_REQUEST['rcmonth'];
                        
                                 $tMonths = array("","January","February","March","April","May","June","July","August","September","October","November","December");
                        
                                 for($m=1;$m<=12;$m++){ ?>
                        
                                <option value="<?php echo ($m<9)?'0'.$m:$m; ?>" <?= ($month==$m)?'selected="selected"':'';?>  >
                        
                                <?php echo $tMonths[$m]; ?>
                        
                                </option>
                        
                            <?php } ?>
                        
                        </select></td>
                        
                                    <td><select class="select_box" name="rcyear" style="float:left;">
                        
                                <option value="0" >--Year--</option>
                        
                                <?php
                        
                                     $year = $_REQUEST['rcyear'];
                        
                                     $tYear = (date("Y")-2);
                        
                                     for($y=0;$y<3;$y++){ ?>
                        
                                    <option value="<?php echo ($tYear+$y); ?>" <?= ($year==($tYear+$y))?'selected="selected"':'';?> >
                        
                                    <?php echo ($tYear+$y); ?>
                        
                                    </option>
                        
                                <?php } ?>
                        
                            </select></td>
                        
                                </tr>
                        
                            </table>
                        
                        <?php }else {
                        
                                if($vdta['v_recdate']!='0000-00-00')	
                        
                                echo date("j-F-Y",strtotime($vdta['v_recdate']));
                        
                                else echo 'N/A';
                        
                              } ?> 
                        
                         </div>             
                        
                        </div>
                        
                        
                        
                        <div class="form-group">
                        
                        <label>Date of Birth:</label>
                        
                         <div>
                        
                        <?php if($add){ ?>
                        
                            <table class="static">
                        
                                <tr>
                        
                                    <td><select name="day" class="select_box  " style="opacity: 0; float:left;" >
                        
                                <option value="0" >--Day--</option>
                        
                                <?php
                        
                                    $day = $_REQUEST['day'];
                        
                                     for($d=1;$d<=31;$d++){ ?>
                        
                                    <option value="<?php echo ($d<9)?'0'.$d:$d; ?>" <?= ($day==$d)?'selected="selected"':'';?>  >
                        
                                    <?php echo $d; ?>
                        
                                    </option>
                        
                                <?php } ?>
                        
                            </select></td>
                        
                                    <td><select class="select_box" name="month" style="float:left;">
                        
                                <option value="0" >--Month--</option>
                        
                            <?php
                        
                                 $month = $_REQUEST['month'];
                        
                                 $tMonths = array("","January","February","March","April","May","June","July","August","September","October","November","December");
                        
                                 for($m=1;$m<=12;$m++){ ?>
                        
                                <option value="<?php echo ($m<9)?'0'.$m:$m; ?>" <?= ($month==$m)?'selected="selected"':'';?>  >
                        
                                <?php echo $tMonths[$m]; ?>
                        
                                </option>
                        
                            <?php } ?>
                        
                        </select></td>
                        
                                    <td><select class="select_box" name="year" style="float:left;">
                        
                                <option value="0" >--Year--</option>
                        
                                <?php
                        
                                     $year = $_REQUEST['year'];
                        
                                     $tYear = (date("Y")-15);
                        
                                     for($y=0;$y<70;$y++){ ?>
                        
                                    <option value="<?php echo ($tYear-$y); ?>" <?= ($year==($tYear-$y))?'selected="selected"':'';?> >
                        
                                    <?php echo ($tYear-$y); ?>
                        
                                    </option>
                        
                                <?php } ?>
                        
                            </select></td>
                        
                                </tr>
                        
                            </table>
                        
                        <?php }else {
                        
                                if($vdta['v_dob']!='0000-00-00')	
                        
                                echo date("j-F-Y",strtotime($vdta['v_dob']));
                        
                                else echo 'N/S';
                        
                              } ?> 
                        
                         </div>             
                        
                         </div> 
                        
                        
                        
                        
                        
                        <?php if(!$add){ ?>  
                        
                       <div class="form-group">
                        
                            <label>RISK LEVEL:</label>
                        
                            <div><?=$vdta['v_rlevel'].' [ '.$vdta['v_status'].' ]'; ?></div>
                        
                        </div> 
                        
                        <?php }?>                                    
                        
                        
                        
                        
                        
                        <?php if($add){ ?>
                        
                        <div class="button_bar clearfix">
                        
                        <?php if($edit){?>
                        
                        <input type="hidden" name="id" value="<?=$_REQUEST['id']?>" >
                        
                        <input type="hidden" name="edit" value="" >
                        
                        <?php } ?>
                        
                        <button type="submit" class=" btnright div_icon has_text" name="addbasic" >
                        
                            <span><?=($edit)?'Save':'Add'?> Case </span>
                        
                        </button> 
                        
                        </div>
                        
                        <?php } ?>
                        
                        
                        
                        <?php if(isset($_REQUEST['case'])){ ?>   
                        
                        <div class="button_bar clearfix">
                        
                        <button class="btnright div_icon has_text"
                        
                        onclick="showAjax('addchecks','Add Checks','case=<?php echo $_REQUEST['case']; ?>'); return false;" >
                        
                        <span>Add Checks</span>
                        
                        </button>  
                        
                        </div>      
                        
                        <?php } ?>
                        
                        
                        
                        <?php if(!$add){ ?>
                        
                        <div class="box grid_16">
                        
                        <h2 class="box_head">Case Attachments</h2>
                        
                        <a href="#" class="grabber">&nbsp;</a>
                        
                        <a href="#" class="toggle">&nbsp;</a>
                        
                        <div class="toggle_container">
                        
                        <div class="block">
                        
                        <?php include("include_pages/adddata_inc.php"); ?>
                        
                        </div>
                        
                        </div>
                        
                        </div>
                        
                        <?php }?>
                        
                        </form>
					</div>
                </div>
            </div>
		</div>
	</div>
</div>


<?php  
}
  if($add){?>

		<div class="row">
               
                <div class="col-md-12">
                	<div class="manager-report-sec">
                     <div class="page-section-title">
                            <h2 class="box_head">Case Listing</h2>
                          </div>  
					<div class="panel panel-default panel-block">
                    	<div id="data-table" class="panel-heading datatable-heading">
                         
                    	</div>
                <table class="table table-bordered table-striped" id="tableSortable">

            <thead>

                <tr>

                    <th>&nbsp;</th>

                    <th>ID #</th>
					
                    <th>Tracking#</th>
                    
                    <th>Candidate Name</th>

                    <th>Father's Name</th>

                    <th>Check(s)</th>

                    <th>Client Name</th>

                    <th>Verification Status</th>

                    <th>&nbsp;</th>

                </tr>

            </thead>

            <tbody>

            <?php 

				if($_SESSION['user_id']==50 || $_SESSION['user_id']==83){

					$dWhere="d.com_id=20 AND v_status<>'Close'";

				}else $dWhere="v_status<>'Close'";			
                $tbls = "ver_data d INNER JOIN company p ON p.id=d.com_id";
                $data = $db->select($tbls,"*","$dWhere AND v_isdlt=0 $SSTR ORDER BY d.v_id DESC");

                while($re = mysql_fetch_array($data)) {?>

                <tr class="gradeX" >

                	<td></td>

                    <td >

                        <?=$re['emp_id']?>

                    </td>

                    <td >

                        <?=bcplcode($re['v_id'])?>

                    </td>
                    


                    <td >

                        <a href="<?="?action=case&atype=add/edit&case=$re[v_id]"?>">

							<?=$re['v_name']?>

                        </a>

                    </td>

                    <td >

                        <?=$re['v_ftname']?>

                    </td>

                    <td >

                        <?php

                        $dChks = $db->select("ver_checks","COUNT(v_id) cnt","v_id=$re[v_id] AND as_isdlt=0");

                        $dChks = mysql_fetch_array($dChks);

                        echo $dChks['cnt'];

                        ?>

                    </td>

                    <td>

                        <?=$re['name']?>

                    </td>

                    <td>

                        <?php echo $re['v_rlevel'].' [ '.$re['v_status'].' ]'; ?> 

                     </td>

                    <td>

                       <?php /*?> <img class="edit" onclick="submitLink('id=<?=$re['v_id']?>&edit')" src="images/icons/small/grey/create_write.png" />  <?php */?> 
                        <i onclick="submitLink('id=<?=$re['v_id']?>&edit')" class="icon-edit"  title="Edit" ></i>     

                    </td>

                </tr>        

            <?php }?>

            </tbody>

        </table>
        			</div>
                    </div>

            </div>

		</div>


 <script src="scripts/proton/tables.js"></script>

<?php }?>



				<!--<div class="panel panel-default panel-block">
                    	<div id="data-table" class="panel-heading datatable-heading">
                            <h4 class="section-title">Data Table</h4>
                    	</div>
	                    <table class="table table-bordered table-striped" id="tableSortable">
	                        <thead>
	                            <tr>
	                                <th>Rendering engine</th>
	                                <th>Browser</th>
	                                <th>Platform(s)</th>
	                                <th>Engine version</th>
	                                <th>CSS grade</th>
	                            </tr>
	                        </thead>
	                        <tbody>
	                            <tr class="gradeX">
	                                <td>Trident</td>
	                                <td>
	                                    Internet
	                                    Explorer 
	                                    4.0
	                                </td>
	                                <td>Win 95+</td>
	                                <td class="center">4</td>
	                                <td class="center">X</td>
	                            </tr>
	                            <tr class="gradeC">
	                                <td>Trident</td>
	                                <td>Internet
	                                    Explorer 5.0</td>
	                                <td>Win 95+</td>
	                                <td class="center">5</td>
	                                <td class="center">C</td>
	                            </tr>
	                            <tr class="gradeA">
	                                <td>Trident</td>
	                                <td>Internet
	                                    Explorer 5.5</td>
	                                <td>Win 95+</td>
	                                <td class="center">5.5</td>
	                                <td class="center">A</td>
	                            </tr>
	                            <tr class="gradeA">
	                                <td>Trident</td>
	                                <td>Internet
	                                    Explorer 6</td>
	                                <td>Win 98+</td>
	                                <td class="center">6</td>
	                                <td class="center">A</td>
	                            </tr>
	                            <tr class="gradeA">
	                                <td>Trident</td>
	                                <td>Internet Explorer 7</td>
	                                <td>Win XP SP2+</td>
	                                <td class="center">7</td>
	                                <td class="center">A</td>
	                            </tr>
	                            <tr class="gradeA">
	                                <td>Trident</td>
	                                <td>AOL browser (AOL desktop)</td>
	                                <td>Win XP</td>
	                                <td class="center">6</td>
	                                <td class="center">A</td>
	                            </tr>
	                            <tr class="gradeA">
	                                <td>Gecko</td>
	                                <td>Firefox 1.0</td>
	                                <td>Win 98+ / OSX.2+</td>
	                                <td class="center">1.7</td>
	                                <td class="center">A</td>
	                            </tr>
	                            <tr class="gradeA">
	                                <td>Gecko</td>
	                                <td>Firefox 1.5</td>
	                                <td>Win 98+ / OSX.2+</td>
	                                <td class="center">1.8</td>
	                                <td class="center">A</td>
	                            </tr>
	                            <tr class="gradeA">
	                                <td>Gecko</td>
	                                <td>Firefox 2.0</td>
	                                <td>Win 98+ / OSX.2+</td>
	                                <td class="center">1.8</td>
	                                <td class="center">A</td>
	                            </tr>
	                            <tr class="gradeA">
	                                <td>Gecko</td>
	                                <td>Firefox 3.0</td>
	                                <td>Win 2k+ / OSX.3+</td>
	                                <td class="center">1.9</td>
	                                <td class="center">A</td>
	                            </tr>
	                            <tr class="gradeA">
	                                <td>Gecko</td>
	                                <td>Camino 1.0</td>
	                                <td>OSX.2+</td>
	                                <td class="center">1.8</td>
	                                <td class="center">A</td>
	                            </tr>
	                            <tr class="gradeA">
	                                <td>Gecko</td>
	                                <td>Camino 1.5</td>
	                                <td>OSX.3+</td>
	                                <td class="center">1.8</td>
	                                <td class="center">A</td>
	                            </tr>
	                            <tr class="gradeA">
	                                <td>Gecko</td>
	                                <td>Netscape 7.2</td>
	                                <td>Win 95+ / Mac OS 8.6-9.2</td>
	                                <td class="center">1.7</td>
	                                <td class="center">A</td>
	                            </tr>
	                            <tr class="gradeA">
	                                <td>Gecko</td>
	                                <td>Netscape Browser 8</td>
	                                <td>Win 98SE+</td>
	                                <td class="center">1.7</td>
	                                <td class="center">A</td>
	                            </tr>
	                            <tr class="gradeA">
	                                <td>Gecko</td>
	                                <td>Netscape Navigator 9</td>
	                                <td>Win 98+ / OSX.2+</td>
	                                <td class="center">1.8</td>
	                                <td class="center">A</td>
	                            </tr>
	                            <tr class="gradeA">
	                                <td>Gecko</td>
	                                <td>Mozilla 1.0</td>
	                                <td>Win 95+ / OSX.1+</td>
	                                <td class="center">1</td>
	                                <td class="center">A</td>
	                            </tr>
	                            <tr class="gradeA">
	                                <td>Gecko</td>
	                                <td>Mozilla 1.1</td>
	                                <td>Win 95+ / OSX.1+</td>
	                                <td class="center">1.1</td>
	                                <td class="center">A</td>
	                            </tr>
	                            <tr class="gradeA">
	                                <td>Gecko</td>
	                                <td>Mozilla 1.2</td>
	                                <td>Win 95+ / OSX.1+</td>
	                                <td class="center">1.2</td>
	                                <td class="center">A</td>
	                            </tr>
	                            <tr class="gradeA">
	                                <td>Gecko</td>
	                                <td>Mozilla 1.3</td>
	                                <td>Win 95+ / OSX.1+</td>
	                                <td class="center">1.3</td>
	                                <td class="center">A</td>
	                            </tr>
	                            <tr class="gradeA">
	                                <td>Gecko</td>
	                                <td>Mozilla 1.4</td>
	                                <td>Win 95+ / OSX.1+</td>
	                                <td class="center">1.4</td>
	                                <td class="center">A</td>
	                            </tr>
	                            <tr class="gradeA">
	                                <td>Gecko</td>
	                                <td>Mozilla 1.5</td>
	                                <td>Win 95+ / OSX.1+</td>
	                                <td class="center">1.5</td>
	                                <td class="center">A</td>
	                            </tr>
	                            <tr class="gradeA">
	                                <td>Gecko</td>
	                                <td>Mozilla 1.6</td>
	                                <td>Win 95+ / OSX.1+</td>
	                                <td class="center">1.6</td>
	                                <td class="center">A</td>
	                            </tr>
	                            <tr class="gradeA">
	                                <td>Gecko</td>
	                                <td>Mozilla 1.7</td>
	                                <td>Win 98+ / OSX.1+</td>
	                                <td class="center">1.7</td>
	                                <td class="center">A</td>
	                            </tr>
	                            <tr class="gradeA">
	                                <td>Gecko</td>
	                                <td>Mozilla 1.8</td>
	                                <td>Win 98+ / OSX.1+</td>
	                                <td class="center">1.8</td>
	                                <td class="center">A</td>
	                            </tr>
	                            <tr class="gradeA">
	                                <td>Gecko</td>
	                                <td>Seamonkey 1.1</td>
	                                <td>Win 98+ / OSX.2+</td>
	                                <td class="center">1.8</td>
	                                <td class="center">A</td>
	                            </tr>
	                            <tr class="gradeA">
	                                <td>Gecko</td>
	                                <td>Epiphany 2.20</td>
	                                <td>Gnome</td>
	                                <td class="center">1.8</td>
	                                <td class="center">A</td>
	                            </tr>
	                            <tr class="gradeA">
	                                <td>Webkit</td>
	                                <td>Safari 1.2</td>
	                                <td>OSX.3</td>
	                                <td class="center">125.5</td>
	                                <td class="center">A</td>
	                            </tr>
	                            <tr class="gradeA">
	                                <td>Webkit</td>
	                                <td>Safari 1.3</td>
	                                <td>OSX.3</td>
	                                <td class="center">312.8</td>
	                                <td class="center">A</td>
	                            </tr>
	                            <tr class="gradeA">
	                                <td>Webkit</td>
	                                <td>Safari 2.0</td>
	                                <td>OSX.4+</td>
	                                <td class="center">419.3</td>
	                                <td class="center">A</td>
	                            </tr>
	                            <tr class="gradeA">
	                                <td>Webkit</td>
	                                <td>Safari 3.0</td>
	                                <td>OSX.4+</td>
	                                <td class="center">522.1</td>
	                                <td class="center">A</td>
	                            </tr>
	                            <tr class="gradeA">
	                                <td>Webkit</td>
	                                <td>OmniWeb 5.5</td>
	                                <td>OSX.4+</td>
	                                <td class="center">420</td>
	                                <td class="center">A</td>
	                            </tr>
	                            <tr class="gradeA">
	                                <td>Webkit</td>
	                                <td>iPod Touch / iPhone</td>
	                                <td>iPod</td>
	                                <td class="center">420.1</td>
	                                <td class="center">A</td>
	                            </tr>
	                            <tr class="gradeA">
	                                <td>Webkit</td>
	                                <td>S60</td>
	                                <td>S60</td>
	                                <td class="center">413</td>
	                                <td class="center">A</td>
	                            </tr>
	                            <tr class="gradeA">
	                                <td>Presto</td>
	                                <td>Opera 7.0</td>
	                                <td>Win 95+ / OSX.1+</td>
	                                <td class="center">-</td>
	                                <td class="center">A</td>
	                            </tr>
	                            <tr class="gradeA">
	                                <td>Presto</td>
	                                <td>Opera 7.5</td>
	                                <td>Win 95+ / OSX.2+</td>
	                                <td class="center">-</td>
	                                <td class="center">A</td>
	                            </tr>
	                            <tr class="gradeA">
	                                <td>Presto</td>
	                                <td>Opera 8.0</td>
	                                <td>Win 95+ / OSX.2+</td>
	                                <td class="center">-</td>
	                                <td class="center">A</td>
	                            </tr>
	                            <tr class="gradeA">
	                                <td>Presto</td>
	                                <td>Opera 8.5</td>
	                                <td>Win 95+ / OSX.2+</td>
	                                <td class="center">-</td>
	                                <td class="center">A</td>
	                            </tr>
	                            <tr class="gradeA">
	                                <td>Presto</td>
	                                <td>Opera 9.0</td>
	                                <td>Win 95+ / OSX.3+</td>
	                                <td class="center">-</td>
	                                <td class="center">A</td>
	                            </tr>
	                            <tr class="gradeA">
	                                <td>Presto</td>
	                                <td>Opera 9.2</td>
	                                <td>Win 88+ / OSX.3+</td>
	                                <td class="center">-</td>
	                                <td class="center">A</td>
	                            </tr>
	                            <tr class="gradeA">
	                                <td>Presto</td>
	                                <td>Opera 9.5</td>
	                                <td>Win 88+ / OSX.3+</td>
	                                <td class="center">-</td>
	                                <td class="center">A</td>
	                            </tr>
	                            <tr class="gradeA">
	                                <td>Presto</td>
	                                <td>Opera for Wii</td>
	                                <td>Wii</td>
	                                <td class="center">-</td>
	                                <td class="center">A</td>
	                            </tr>
	                            <tr class="gradeA">
	                                <td>Presto</td>
	                                <td>Nokia N800</td>
	                                <td>N800</td>
	                                <td class="center">-</td>
	                                <td class="center">A</td>
	                            </tr>
	                            <tr class="gradeA">
	                                <td>Presto</td>
	                                <td>Nintendo DS browser</td>
	                                <td>Nintendo DS</td>
	                                <td class="center">8.5</td>
	                                <td class="center">C/A<sup>1</sup></td>
	                            </tr>
	                            <tr class="gradeC">
	                                <td>KHTML</td>
	                                <td>Konqureror 3.1</td>
	                                <td>KDE 3.1</td>
	                                <td class="center">3.1</td>
	                                <td class="center">C</td>
	                            </tr>
	                            <tr class="gradeA">
	                                <td>KHTML</td>
	                                <td>Konqureror 3.3</td>
	                                <td>KDE 3.3</td>
	                                <td class="center">3.3</td>
	                                <td class="center">A</td>
	                            </tr>
	                            <tr class="gradeA">
	                                <td>KHTML</td>
	                                <td>Konqureror 3.5</td>
	                                <td>KDE 3.5</td>
	                                <td class="center">3.5</td>
	                                <td class="center">A</td>
	                            </tr>
	                            <tr class="gradeX">
	                                <td>Tasman</td>
	                                <td>Internet Explorer 4.5</td>
	                                <td>Mac OS 8-9</td>
	                                <td class="center">-</td>
	                                <td class="center">X</td>
	                            </tr>
	                            <tr class="gradeC">
	                                <td>Tasman</td>
	                                <td>Internet Explorer 5.1</td>
	                                <td>Mac OS 7.6-9</td>
	                                <td class="center">1</td>
	                                <td class="center">C</td>
	                            </tr>
	                            <tr class="gradeC">
	                                <td>Tasman</td>
	                                <td>Internet Explorer 5.2</td>
	                                <td>Mac OS 8-X</td>
	                                <td class="center">1</td>
	                                <td class="center">C</td>
	                            </tr>
	                            <tr class="gradeA">
	                                <td>Misc</td>
	                                <td>NetFront 3.1</td>
	                                <td>Embedded devices</td>
	                                <td class="center">-</td>
	                                <td class="center">C</td>
	                            </tr>
	                            <tr class="gradeA">
	                                <td>Misc</td>
	                                <td>NetFront 3.4</td>
	                                <td>Embedded devices</td>
	                                <td class="center">-</td>
	                                <td class="center">A</td>
	                            </tr>
	                            <tr class="gradeX">
	                                <td>Misc</td>
	                                <td>Dillo 0.8</td>
	                                <td>Embedded devices</td>
	                                <td class="center">-</td>
	                                <td class="center">X</td>
	                            </tr>
	                            <tr class="gradeX">
	                                <td>Misc</td>
	                                <td>Links</td>
	                                <td>Text only</td>
	                                <td class="center">-</td>
	                                <td class="center">X</td>
	                            </tr>
	                            <tr class="gradeX">
	                                <td>Misc</td>
	                                <td>Lynx</td>
	                                <td>Text only</td>
	                                <td class="center">-</td>
	                                <td class="center">X</td>
	                            </tr>
	                            <tr class="gradeC">
	                                <td>Misc</td>
	                                <td>IE Mobile</td>
	                                <td>Windows Mobile 6</td>
	                                <td class="center">-</td>
	                                <td class="center">C</td>
	                            </tr>
	                            <tr class="gradeC">
	                                <td>Misc</td>
	                                <td>PSP browser</td>
	                                <td>PSP</td>
	                                <td class="center">-</td>
	                                <td class="center">C</td>
	                            </tr>
	                            <tr class="gradeU">
	                                <td>Other browsers</td>
	                                <td>All others</td>
	                                <td>-</td>
	                                <td class="center">-</td>
	                                <td class="center">U</td>
	                            </tr>
	                        </tbody>
	                    </table>
		            </div>-->

