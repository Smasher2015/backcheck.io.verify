<section class="retracted scrollable">
            <div class="report-sec">
            <div class="page-section-title">
            <h2 class="box_head">Section Search Filters</h2>
            </div>
            <div class="panel panel-default panel-block">	
            <div id="filters" class="section" >
            
            <div class="panel panel-default panel-block">
            	<div class="list-group">
                <div class="list-group-item">
            <form class="table-form" method="post">
            <div style="float:left; margin-top:20px;">
            <fieldset class="mrg-bottom custom-input float-left search-width">
            <div class="form-group ">
            <?php $tSstr=(isset($_REQUEST['sstr']))?$_REQUEST['sstr']:''?>
            <input type="text" class="form-control" name="sstr" value="<?=$tSstr?>" placeholder="Search by Candidate Name / ID#" >
            </div>
            </fieldset>
            <fieldset class="mrg-bottom custom-input float-left search-width">
            <div class="form-group ">	
            <select name="clntid" class="form-control select_box full_width">
            <option value=""> ----------- Client [ All ] ----------- </option>
            <?php 	$db = new DB();
            if($_SESSION['user_id']==50 || $_SESSION['user_id']==83){
            $dWhere="id=20";
            }else $dWhere="is_active=1";							
            $coms = $db->select("company","*",$dWhere,'','ORDER BY name ASC');
            $coid = (isset($_REQUEST['clntid']))?$_REQUEST['clntid']:0;
            while($com =mysql_fetch_array($coms)){  ?>
            <option value="<?=$com['id']?>" <?php echo ($com['id']==$coid)?'selected="selected"':'';?>>
            <?=$com['name']?>
            </option>
            <?php	} ?>
            </select>
            </div> 
            </fieldset>	
			
			<?php if($_REQUEST['action']!='cases' && $_REQUEST['atype']!='list'){?>
			<fieldset class="mrg-bottom custom-input float-left search-width">
            <div class="form-group ">	
            <select name="s_checks_id" class="form-control select_box full_width">
            <option value=""> -----------Select Component ----------- </option>
            <?php 
													 
													 $checks = $db->select("checks","*","is_active=1");
													 if(mysql_num_rows($checks)>0){
						
															while($check = mysql_fetch_array($checks)){?>
																<option value="<?=$check['checks_id']?>" <?php echo ($check['checks_id']==$_REQUEST['s_checks_id'])?'selected="selected"':'';?>><?=$check['checks_title']?></option>
															<?php }
													 }
											?>
            </select>
            </div> 
            </fieldset>
			<?php } ?>
			 <button class="btn filebtn btn-success float-left" style="float:left;" type="submit" name="Search_btn">
            <span>Search</span>
            </button>	
            </div>
           
            </form>
            <div class="clear"></div>
            </div>
            </div>
            </div>
            
            </div>
            </div>
            <div class="clear"></div>
            </div>
</section> 