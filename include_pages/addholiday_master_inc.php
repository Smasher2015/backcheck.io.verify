<?php
	if(is_numeric($_REQUEST['hid'])){
		$holiday = getHoliday($_REQUEST['hid']);
		$_REQUEST['country_id'] = $holiday['country_id'];
		$_REQUEST['hol_holiday']  = $holiday['hol_holiday'];
		$_REQUEST['sdate']  =date("j M Y",strtotime($holiday['hol_sdate'])) ;
		$_REQUEST['edate']  =date("j M Y",strtotime($holiday['hol_edate'])) ;
		$_REQUEST['hol_desc']  = $holiday['hol_desc'];
		if($holiday['hol_yrly']==1){
			$_REQUEST['yrly']  = $holiday['hol_yrly'];
			$checked = "checked='checked'";
		}
	}
?>

<section class="retracted scrollable">
  <div class="row">
    <div class="col-md-12">
      <div class="manager-report-sec">
        <div id="filters" class="section" >
        <div class="page-section-title">
			
              <h2 class="box_head"><?=$PTITLE?></h2>
            </div>
          <div class="list-group-item" >
            
    <div class="toggle_container">
        <div class="block">
         	<div id="dt2">
			<form class="mainForm" method="post" enctype="multipart/form-data">
                <fieldset class="label_side">
                        <label>Country:</label>
                        <div>
                            <select class="select_box form-control" name="country_id">
                                <option value="0">--Worldwide--</option>
                                <?php
                                $companys = $db->select("country","*","1=1 ORDER BY printable_name");
                                if(mysql_num_rows($companys)>0){
                                    while($company = mysql_fetch_array($companys)){ ?>
                                        <option value="<?=$company['country_id']?>" 
                                            <?=($company['country_id']==$_REQUEST['country_id'])?'selected="selected"':''?> >
                                            <?=$company['printable_name']?>
                                        </option>
                                <?php }
                                } ?>
                            </select>
                         </div>
                </fieldset>
    
                <fieldset class="label_side">
                        <label>Holiday:</label>
                        <div>
                            <input class="input etitle req etitle form-control" title="Input Holiday" type="text" name="hol_holiday" value="<?=$_REQUEST['hol_holiday']?>" >
                        </div>
                </fieldset>

                <div class="columns clearfix">  
                    <div class="col-lg-4">
                    <fieldset class="label_side">
                        <label>Start Date:</label>
                        <div>
                            <input id="fromdate" class="datetimepicker-month1 form-control" placeholder="Start Date" title="Input Start Date"  type="text" name="sdate"  value="<?=$_REQUEST['sdate']?>"  readonly="readonly"  >
                        </div>
                    </fieldset>
                    </div>
                    <div class="col-lg-4">
                     <fieldset class="label_side">
                            <label>End Date:</label>
                            <div>
                                <input id="todate" class="datetimepicker-month2 form-control" placeholder="End Date" title="Input End Date"  type="text" name="edate"  value="<?=$_REQUEST['edate']?>" readonly="readonly" >
                            </div>
                    </fieldset>
                    </div>
                </div>
                                      
                <fieldset class="label_side">
                        <label>Description:</label>
                        <div>
                            <textarea class="input form-control" type="text"  name="hol_desc"><?=$_REQUEST['hol_desc']?></textarea>
                        </div>
                </fieldset>

                <fieldset class="label_side">
                        <label></label>
                        <div>
                           <label><input type="checkbox" name="yrly" <?php echo $checked;?> /> Add as a yearly public holidays</label>
                        </div>
                </fieldset>
                                
                
    
                 <?php if(isset($_REQUEST['hid'])){?>
                    <input type="hidden" name="hid" value="<?=$_REQUEST['hid']?>"/>
                 <?php }?>

                <div class="button_bar clearfix">
                    <button name="addholiday" type="submit" class="btnright div_icon has_text text_only">
                        <img src="images/icons/small/grey/file_cabinet.png">
                        <span><?=isset($_REQUEST['hid'])?'Save':'Add'?> Public Holiday</span>
                    </button>
                </div>
             
   			 </form>
        	</div>
        </div>
     </div>
</div>

</div>
        </div>
      </div>
	  </div>
     
  <div class="clear"></div>
  
  
  
</section>

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
											  
                                              <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
                                                <script type="text/javascript">
												$(function () {
												$( ".datetimepicker-month1, .datetimepicker-month2").datepicker({
												dateFormat: 'yy-mm-dd',
												changeMonth: true,
												changeYear: true,
												yearRange: "1980:2015"
												});
												});
												</script>

