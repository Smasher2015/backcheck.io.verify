<div class="row">
 	<div class="col-md-12">
        <div class="report-sec">
        <div class="panel panel-default panel-block">
        <div class="page-section-title">Bulk Upload</div>  
        <div class="list-group-item">
        
	<div>
    <form method="post" enctype="multipart/form-data" class="label_side" >
    <div>
    <div class="col-md-3">
    <label>Receive Date:</label>
    </div>
    
    <div class="col-md-3">
        <div class="form-group">
        
        <select class="form-control" id="source" name="rcday" >
        <option value="0" >--Day--</option>
    
        <?php
    
            $day = $_REQUEST['rcday'];
    
             for($d=1;$d<=31;$d++){ ?>
    
            <option value="<?php echo ($d<9)?'0'.$d:$d; ?>" <?= ($day==$d)?'selected="selected"':'';?>  >
    
            <?php echo $d; ?>
    
            </option>
    
        <?php } ?>
        </select>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
        <select class="form-control" id="source"  name="rcmonth" >
         <option value="0" >--Month--</option>
    
        <?php
    
             $month = $_REQUEST['rcmonth'];
    
             $tMonths = array("","January","February","March","April","May","June","July","August","September","October","November","December");
    
             for($m=1;$m<=12;$m++){ ?>
    
            <option value="<?php echo ($m<9)?'0'.$m:$m; ?>" <?= ($month==$m)?'selected="selected"':'';?>  >
    
            <?php echo $tMonths[$m]; ?>
    
            </option>
    
        <?php } ?>
    
        </select>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
    
        <select class="form-control" id="source" name="rcyear">
           <option value="0" >--Year--</option>
    
        <?php
    
             $year = $_REQUEST['rcyear'];
    
             $tYear = (date("Y")-2);
    
             for($y=0;$y<3;$y++){ ?>
    
            <option value="<?php echo ($tYear+$y); ?>" <?= ($year==($tYear+$y))?'selected="selected"':'';?> >
    
            <?php echo ($tYear+$y); ?>
    
            </option>
    
        <?php } ?>
    
        </select>
        </div>
    </div>
    </div>
    <div class="clearFix"></div>
    
        <div class="form-group">
        <label>Company Name<?php if($add){ ?><sup class="sreq">*</sup><?php }?>:</label>
        <select class="form-control" id="source" name="comId">
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
        </div>
    
    
                                
                                
                                <?php /*?><fieldset class="label_side">
    
                                <label>Receive Date:</label>
    
                                    <div>
    
                                    <table class="static">
    
                                        <tr>
    
                                            <td>
                                            
                                            
                                            
                                            <select name="rcday" class="select_box  " style="opacity: 0; float:left;" >
    
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
    
                                    </div>             
    
                               </fieldset><?php */?>
    
                                <?php /*?><fieldset class="label_side">
    
                                    <label >Company Name<?php if($add){ ?><sup class="sreq">*</sup><?php }?>:</label>
    
                                    <div>
    
                                    <select name="comId" class="select_box req etitle" title="Select Company" >
    
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
    
                                    </div>
    
                                </fieldset><?php */?>
    
                                <?php /*?><fieldset class="label_side">
    
                                    <label >Select File:<span>Upload excel file only</span></label>
    
                                    <div>
    
                                    <input type="file" name="bulk" />
    
                                    </div>
    
                                </fieldset><?php */?>
                                <div class="form-group">
                                        <label>Select File:<span>Upload excel file only</span></label>
                                        <div>
                                            <div class="fileinput fileinput-new" data-provides="fileinput"><input type="hidden">
                                              <span class="btn btn-primary btn-file"><span class="fileinput-new">Select file</span><span class="fileinput-exists">Change</span><input type="file" name="bulk"></span>
                                              <span class="fileinput-filename"></span>
                                              <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">×</a>
                                            </div>
                                        </div>
                                    </div>
                                
                                <fieldset class="label_side">
    
                                    <label >Add Checks:</label>
    
                                    <div style="height:150px; overflow:auto; margin-bottom:15px;" >
    
                                    <table class="static">
                                    <tbody>
                                    <?php
                                        $where="is_active=1";
                                        $checks= $db->select("checks","*",$where);
                                        while($check = mysql_fetch_array($checks)){ ?>
                                            <tr>
                                                <td><input type="checkbox" name="checks[]" value="<?=$check ['checks_id']?>" style="margin:0;height:auto;" ></td>
                                                <td style="text-align:left; margin-left:30px;">
                                                    <?php echo $check ['checks_title']; ?>
                                                </td>
                                           </tr>
                                        <?php } ?>
                                          
                                    </tbody>
        </table>
    
                                    </div>
    
                                </fieldset>
                                
                                
        
                                 <div class="button_bar clearfix">
                                <button type="submit" class="btn btn-success has_text" name="bulkupload" >
    
                                    <span>Upload</span>
    
                                </button> 
    </div>
     
    
    
    
    </form>
	</div>
</div>
</div>
</div>
</div>
</div>