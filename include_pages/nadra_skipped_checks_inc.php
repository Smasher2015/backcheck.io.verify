<?php 
$tcheck = array();

$selChecks = $db->select("ver_data vd INNER JOIN ver_checks vc ON vd.v_id=vc.v_id","*","user_id=262 AND as_status!='Close' AND as_vstatus!='QC' AND is_skipped=1");
if(mysql_num_rows($selChecks)>0){
	$_REQUEST="";
	$c=0;
while($rsChecks = mysql_fetch_assoc($selChecks)){
	$c++;
	$_REQUEST['case'] = $rsChecks['v_id'];
	$_REQUEST['ascase']= $rsChecks['as_id'];

	//$tcheck = checkAction(0,$_REQUEST);
	$tcheck['t_id']=36;
	$tcheck['t_title']="Case Information";
	$tcheck['t_name']="checksub";
	
	
	$csSts = strtolower(trim($rsChecks['as_status']));
	$as_qastatus = strtolower(trim($rsChecks['as_qastatus']));
	$csrmk = strtolower(trim($rsChecks['as_remarks']));
	if(is_array($tcheck)){
		$fields = actionFields($tcheck['t_id'],9); 
		if(mysql_num_rows($fields)>0){ 
		?>
<!-- this is upper section !-->
 <section class="retracted"  >
  <div class="row">
    <div class="col-md-12">
	
	<?php include("include_pages/nadra_basic_info_inc.php");?>
	
	
	
      
    </div>
  </div>
</section>
<!-- this is upper section !-->
<?php 
	}
	}
		


}
}else{ ?>

<section class="retracted">
  <div class="row">
    <div class="col-md-12">
      <div class="report-sec">
        <div class="panel panel-default panel-block">
          <div class="page-section-title">
            <h2 class="box_head">
              Nadra Checks Submission
            </h2>
          </div>
		 </div>
		 <p>No checks available.</p>
	  </div>
	</div>
  </div>
</section>
 

<?php } ?>






<SCRIPT language='JavaScript'>
 function submitSkipForm(){
if(confirm("Are you sure want back this check to quene ?")){
    document.skip_check.action = '<?php echo SURL.'?action='.$_REQUEST['action'];?>';
    document.skip_check.method = 'post';
    document.skip_check.submit() ;
	}
    }
    
</SCRIPT>

