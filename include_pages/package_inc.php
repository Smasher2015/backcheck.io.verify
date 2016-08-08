<?php
//unset($_SESSION['vid']);
	if(isset($_REQUEST['case'])){
		$varCheck = $db->select("ver_data","*","v_id=".$_REQUEST['case']);
		if(mysql_num_rows($varCheck)>0){
			$varCheck = mysql_fetch_array($varCheck);
			if(is_numeric($varCheck['pkg_id']) && is_numeric($varCheck['sc_id'])){
				$_REQUEST['package'] = $varCheck['pkg_id'];
				$_REQUEST['screening'] = $varCheck['sc_id'];
				$_SESSION['vid'] = $_REQUEST['case'];
			}
		}
	}
	if(isset($_POST['addbasic'])){
		$verID = subBasic($_POST);
		if($verID){
			$_SESSION['vid']=$verID;
			$_REQUEST['case'] = $verID;
			addChecks($_REQUEST,4);
			echo msg('sec',"New case added [ $_POST[vname] ] Successfully...");
		}else{
			echo msg('err',"Case adding [ $_POST[vname] ] Error!");
		}
	}

	if(isset($_POST['addAttach'])){
		$_REQUEST['case']=$_SESSION['vid'];
		foreach($_REQUEST['checks'] as $check){
			$_REQUEST['check']=$check;
			echo adddata($_REQUEST,4,false);
		}
	}
	
	if(isset($_REQUEST['daction'])){
			if($_REQUEST['daction']=='delete'){
				if(edData($_REQUEST['verData'],$_REQUEST['daction'])){
					echo msg('sec',"File Deleted Successfully");	
				}else{
					echo msg('sec',"File Deletion Error!");																
				}
			}
		} 
	
	$screening = $db->select("screenings","*","sc_id=".$_REQUEST['screening']);
    $screening = mysql_fetch_array($screening); ?>
<form name="addChecks" method="post" enctype="multipart/form-data" >
<div class="innerdiv">
     <h2 class="head-alt"><?php echo $screening['sc_name']; ?></h2>
     <div class="innercontent">
    <p style="margin-bottom:10px;">
		<?php echo mb_convert_encoding($screening['sc_desc'], 'HTML-ENTITIES','UTF-8'); ?>
    </p> 

        <div>
            <?php
                if(isset($_POST['submitInfo'])) echo information($_POST,$_FILES);
                $package = $db->select("packages","*","pkg_id=".$_REQUEST['package']); 
                    $package =mysql_fetch_array($package) ?>
                        <h4 class="subHdr">
                            <?php echo $package['pkg_name']; ?>
                            <div class="rpImgs">
                                <span style="font-size:12px;">
                                    Cost Rs:<?php echo $package['pkg_amt']; ?>/-
                                </span>	
                                <a target="_blank" href="sample_report.php"><img  src="img/samplebutic.png"  /></a>
                            </div>
                        </h4>
                        <ul class="pkgs">
                        <?php 	if($package['pkg_amt']!=0){
									$pkgItems = $db->select("pkg_items","*","pkg_id=".$package['pkg_id']);
								}else{
									$uID = $_SESSION['user_id'];
									$pkgItems = $db->select("default_pkg","*","pkg_id=$package[pkg_id] AND user_id=$uID");	
								}
                                while($pkgItem =mysql_fetch_array($pkgItems)){ ?>
                                    <li class="phover">
                                        <?php $check = getCheck($pkgItem['checks_id']); echo $check['checks_title']; ?>
                                        <input type="hidden" name="checks[]" value="<?php echo $pkgItem['checks_id']; ?>" />
                                        <div class="rpImgs">
                                            <a href="javascript:viod(0);" onclick="showAjax('sample','Demo Report Information','infp=1')">
                                                <img  src="img/infobutic.png"  />
                                            </a>
                                        </div>
                                        <div  class="rpImgs">
                                            Turnaround Time <?php echo $pkgItem['itm_dtime']; ?> Days
                                        </div>
                                            <?php
                                                if(isset($_SESSION['vid'])){ 
												$fields = actionFields('',$pkgItem['checks_id'],4); 
												?>
											<?php if(mysql_num_rows($fields)>0){ ?>
                                                <div>
                                            <?php while($field = mysql_fetch_array($fields)){ 
                                                        if($field['in_id']==5){?>
                                                            <div>
                                                                <label><?php echo $field['fl_title']; ?>:</label>
                                                                <?php echo renderFields($field);  ?>
                                                                <div class="clear" ></div>  
                                                            </div> 
                                                        <?php 
															$asChecks = getCheck($pkgItem['checks_id'],$_SESSION['vid']);
															if(mysql_num_rows($asChecks)>0){
																while($asCheck = mysql_fetch_array($asChecks)){	
																	$attachments = getData($asCheck['as_id']);
																	if(mysql_num_rows($attachments)>0){
																		while($attachment =mysql_fetch_array($attachments)){ ?>    
																			<div style="padding:2px; margin:5px 5px 5px 0;border:#CCC solid 1px;">
																				<a title="<?php echo $attachment['d_mtitle']; ?>" class="multy" target="_blank" href="<?php echo $attachment['d_value']; ?>">
																					<img style="width:24px;" src="img/attachment.png" />
																				</a>
																				<a class="multy" href="javascript:void(0)" onclick="dataActions('frmdlt',<?php echo $attachment['d_id'];?>)">
																					<img style="width:24px;" src="img/delete.png" />	
																				</a>                                                                            
																				<div class="clear" ></div>
																			</div>
															<?php		}
																	}
																}
															}
														}
                                                } ?>
                                                </div>
                                <?php }} ?>
                                            <div class="clear"></div>
                                    </li>
                        <?php 	} ?>
                        </ul>    
                 <?php if(isset($_SESSION['vid'])){ ?>
                     <input type="hidden" name="screening" value="<?php echo $_REQUEST['screening'];?>" />
                     <input type="hidden" name="package" value="<?php echo $_REQUEST['package'];?>" />
                     <input type="submit" class="button btnright" name="addAttach" value="Submit [ Attachments ] >>" >
                 <?php  } ?>
                 <div class="clear"></div>     
        </div>	
                                                                            
    <div>
        <h4 class="subHdr" >Basic Information</h4>
        <?php include("include_pages/add_check_inc.php"); ?>
    </div>
    
	</div>
</div>
</form>
<form style="display:none;" method="post" name="frmdlt" >
        <input type="hidden" name="daction" value="delete"  />
        <input type="hidden" name="verData" value="0"  />
    </form>