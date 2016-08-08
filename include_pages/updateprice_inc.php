<script type="text/javascript">
	var client = 0;
	var packge = 0;
	var compnt = 0;
	var monyer = '';

	function showRates(value){
		monyer = value;
		if(client!=0 && packge!=0 && compnt!=0 && monyer!=''){
			var param="client="+client+"&compnt="+compnt+"&packge="+packge+"&monyer="+monyer+"&action=showRates";
			ajaxServices("actions.php",param,'showrates');
		}
	}

	function showPakg(value){
			packge = value;
			showRates(monyer);
	}
	
	function showCompt(value){
			compnt = value;
			showRates(monyer);
	}	

	function showMonths(clid){
			document.getElementById('showrates').innerHTML = '';
			client = clid;
			var param="cntid="+clid+"&ePage=showmonths";
			ajaxServices("actions.php",param,'showMonths');
	}
		
</script>

<section class="retracted scrollable">
  <div class="row">
    <div class="col-md-12">
      <div class="manager-report-sec">
      <div class="page-section-title">
              <h2 class="box_head">Update Package</h2>
            </div>
        <div id="filters" class="section" >
          <div class="list-group" >
          <div class="list-group-item" >
            
            <form action="<?="?action=$action&atype=$aType"?>" class="table-form" method="post">
              <div class="form-group">
                <div class="row">
                  <div class="col-md-3">
                    <label for="basic-input">Select Package:</label>
                  </div>
                  <div class="col-md-9">
                    <select id="pkgid" name="pkgid" class="form-control" onchange="showPakg(this.value)">
                      <option value=""> --------Select Package-------- </option>
                      <?php 	$db = new DB();
                                                $dWhere="pkg_active=1";							
                                                $packages = $db->select("package","*",$dWhere);
                                                $pkgid = (isset($_REQUEST['pkgid']))?$_REQUEST['pkgid']:0;
                                                while($package =mysql_fetch_array($packages)){  ?>
                      <option value="<?=$package['pkg_id']?>" 
														<?=($package['pkg_id']==$pkgid)?'selected="selected"':'';?>>
                      <?=$package['pkg_title']?>
                      </option>
                      <?php	} ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-3">
                    <label>Select Compnent:</label>
                  </div>
                  <div class="col-md-9">
                    <select id="cmpid" name="cmpid" class="form-control" onchange="showCompt(this.value)">
                      <option value=""> --------Select Compnent-------- </option>
                      <?php 	$db = new DB();
                                                $dWhere="cmp_active=1";							
                                                $compnents = $db->select("compnents","*",$dWhere);
                                                $cmpid = (isset($_REQUEST['cmpid']))?$_REQUEST['cmpid']:0;
                                                while($compnent =mysql_fetch_array($compnents)){  ?>
                      <option value="<?=$compnent['cmp_id']?>" 
														<?=($compnent['cmp_id']==$cmpid)?'selected="selected"':'';?>>
                      <?=$compnent['cmp_title']?>
                      </option>
                      <?php	} ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-3">
                    <label>Select Client:</label>
                  </div>
                  <div class="col-md-9">
                    <select id="clntid" name="clntid" class="form-control" onchange="showMonths(this.value)">
                      <option value=""> --------Select Client-------- </option>
                      <?php 	$db = new DB();
                                                $dWhere="is_active=1";							
                                                $coms = $db->select("company","*",$dWhere);
                                                $coid = (isset($_REQUEST['clntid']))?$_REQUEST['clntid']:0;
                                                while($com =mysql_fetch_array($coms)){  ?>
                      <option value="<?=$com['id']?>" <?php echo ($com['id']==$coid)?'selected="selected"':'';?>>
                      <?=$com['name']?>
                      </option>
                      <?php	} ?>
                    </select>
                  </div>
                </div>
              </div>
              <div id="showMonths"> </div>
              <div id="showrates"> </div>
              <div class="form-group">
                <button class="btn btn-lg btn-success " style="float:left;" type="submit" name="updatepackage"> <span>Update Package</span> </button>
              </div>
               
            </form>
            <div style="clear:both;"></div>
            </div>
            
     
              </div>
            </div>
          </div>
        </div>
      </div>
  <div class="clear"></div>
</section>
<section class="retracted scrollable">
  <div class="row">
    <div class="col-md-12">
      <div class="manager-report-sec">
         <div class="page-section-title"> <h2 class="box_head">Monthly Checks </h2></div>
         <div class="list-group-item">
				<div id="tableSortable_wrapper" class="dataTables_wrapper form-inline" role="grid" &gt;<div="">
				<div class="toggle_container">
                  <div id="dt1" class="no_margin">
                    <form class="table-form" action="" method="post" name="assignTask" enctype="multipart/form-data">
                        <table class="table table-bordered table-striped dataTable" id="tableSortable" aria-describedby="tableSortable_info">
                          <thead>
                            <tr>
                              <th>&nbsp;</th>
                              <th>Client Name</th>
                              <th>Month-Year</th>
                              <th>Total Checks</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php 
                            $cols = "p.`id`,p.`name`,DATE_FORMAT(c.as_date,'%M-%Y') AS `date`, COUNT(DATE_FORMAT(c.as_date,'%M-%Y')) AS `checks`,DATE_FORMAT(c.as_date,'%Y-%m') AS `value`";
                            $tbls = "ver_data d INNER JOIN ver_checks c ON d.v_id=c.v_id INNER JOIN company p ON p.id=d.com_id";
                            $wher = "c.as_isdlt=0 AND d.v_isdlt=0 GROUP BY p.name,`date` ORDER BY c.as_date DESC";
                            $db_count = $db->select($tbls,"COUNT(c.as_date) as `cnt`","c.as_isdlt=0 AND d.v_isdlt=0");
                            $db_count =  mysql_fetch_array($db_count);
                            $db_count = $db_count['cnt'];
                            if($db_count>0){
                                include("include_pages/pagination_inc.php");
                                $data = $db->select($tbls,$cols,"$wher $pages->limit");
								$index = 0;
                                while($re = mysql_fetch_array($data)) {  
									$showChk  ="showData(this,'ePage=showcheckwise&date=$re[value]&client=$re[id]&action=$action&atype=$aType','v$index')"; ?>
                            <tr>
                              <td><img style="cursor:pointer;float:left;margin-top:18px;"  onClick="<?=$showChk?>" src="img/plusIcon.gif" ></td>
                              <td ><?=$re['name']?></td>
                              <td ><?=$re['date']?></td>
                              <td ><?=$re['checks']?></td>
                            </tr>
                            <tr style="display:none;">
                              <td colspan="4"></td>
                            </tr>
                            <tr>
                              <td class="inTD" colspan="9" style="display:none;" id="v<?=$index?>"></td>
                            </tr>
                            <?php 
									$index = $index+1;
								} }else{ ?>
                            <tr>
                              <td colspan="4" align="center"><strong>No Record Found</strong></td>
                            </tr>
                            <?php } ?>
                          </tbody>
                        </table>
                    </form>
                    <?php include("include_pages/pager_inc.php"); ?>
                  </div>
				  </div>
				  </div>
                </div>
      </div>
   </div>
 </div>
</section>                