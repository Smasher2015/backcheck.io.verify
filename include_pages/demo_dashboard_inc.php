<?php
	$today = date("Y-m-d");
	$location_users = '';
	$date_range = 'Last Six Months';
	$_REQUEST['date_range']=(!isset($_REQUEST['date_range']))?'last_six_months':$_REQUEST['date_range'];
	
	if($LEVEL==4){
		
		$uids = getUseridsLocation();
		if(!empty($uids)){
		$location_users = " AND v_uadd IN (".implode(",",$uids).") ";	
		}
	}

	$mnth = (isset($_REQUEST['mnth']))?$_REQUEST['mnth']:date("m");
	$yr = (isset($_REQUEST['yr']))?$_REQUEST['yr']:date("Y");
	$monthNum  = $mnth;
	$Fmonth = date('F', mktime(0, 0, 0, $monthNum, 10));
	$company_id = ($LEVEL!=4)?(isset($_REQUEST['client_id']))?$_REQUEST['client_id']:1:$COMINF['id'];
	$comWhere = ($LEVEL!=4)?" AND vd.com_id=$company_id ":"";
	
		
	$before15Days = date("Y-m-d", strtotime($today . "-2 week"));
	$before30Days = date("Y-m-d", strtotime($before15Days . "-2 week"));
	$oneMonth = date("Y-m-d", strtotime($today . "-1 month"));
	$sixMonths = date("Y-m-d", strtotime($today . "-6 month"));
	$last_month = date("Y-m",strtotime("first day of last month"));
	$this_month = date("Y-m");
	$this_week = date("Y-m-d",strtotime("this week"));
	$last_week_end = date("Y-m-d",strtotime("- 1 week"));
	
	$oneMonthUrl = SURL."?action=advance&atype=search&from_dt=$oneMonth&to_dt=$today&search_status=1&client_id[]=$company_id";
	$sixMonthUrl = SURL."?action=advance&atype=search&from_dt=$sixMonths&to_dt=$today&search_status=1&client_id[]=$company_id";
	
	$dateRange = " AND DATE(as_addate)  BETWEEN '$oneMonth' AND '$today' ";
	if(isset($_REQUEST['date_range'])){
	$date_range = $_REQUEST['date_range'];
	switch($date_range){
	case 'this_month':	
	
	$dateRange = " AND DATE_FORMAT(as_addate,'%Y-%m') = '$this_month' ";
	break;
	case 'last_month':	
	
	$dateRange = " AND DATE_FORMAT(as_addate,'%Y-%m') = '$last_month' ";
	break;
	case 'this_week':	
	
	$dateRange = " AND DATE_FORMAT(as_addate,'%Y-%m-%d') BETWEEN '$this_week' AND '$today'";
	break;
	case 'last_week':	
	
	$last_week_start = date("Y-m-d",strtotime("last week"));
	case 'last_six_months':	
	$dateRange = " AND DATE_FORMAT(as_addate,'%Y-%m-%d') BETWEEN '$sixMonths' AND '$today'";
	break;
	
	default: 
	$dateRange = " AND DATE(as_addate)  BETWEEN '$oneMonth' AND '$today' ";
	$date_range = 'One Month From Today';
	} // switch
	} // if
	
	$date_range_title = str_replace('_',' ',ucwords($date_range));

?>

<style>
/*.sidebar {background-color: #333;}
.navigation>li.active>a, .navigation>li.active>a:hover, .navigation>li.active>a:focus {
    background-color: #C31E24;
    color: #fff;
}
.panel{border-radius:0;}
.media-left{display: inline-block;}
.bgc-gray{background-color: #fbfbfb !important;}
.bgc-pink{background-color: #fff7f8 !important;}
.bgc-blue{background-color: #eef7fa !important;}
.case_activity{background: #fff;}
.credit_chrt .chart div{width:100% !important;}
.credit_chrt .chart canvas{width:100% !important;}
.credit_chrt .chart div.echarts-tooltip{width:auto !important;}
.has-fixed-height{height:360px !important;}

.credit_chrt .chart div{width:100% !important;}
.credit_chrt .chart canvas{width:100% !important;}
.credit_chrt .chart div.echarts-tooltip{width:auto !important;}
.has-fixed-height{height:360px !important;}*/

</style>


	<!-- Page container -->
	<div class="page-container">

		<!-- Page content -->
		<div class="page-content">
			<!-- Main content -->
			<div class="content-wrapper">
				
                <div class="page-header">
					<div class="page-header-content">
						<div class="page-title">
							<h1><span class="text-semibold">Dashboard</span></h1>
						</div>

						<!--<div class="heading-elements">
							<div class="heading-btn-group">
                                                                        
                                <a href="javascript:;" class="btn btn-link btn-float has-text sidebar-control sidebar-secondary-hide hidden-xs"><i class="icon-gear text-primary"></i><span>Setting</span></a>
                                <a href="javascript:;" class="btn btn-link btn-float has-text" data-toggle="modal" data-target="#openticket"><i class="icon-ticket text-primary"></i> <span>New Support</span></a>
                               <a href="javascript:;" class="btn btn-link btn-float has-text LiveHelpButton" id="LiveHelpStatusDefault" name="LiveHelpStatusDefault"><i class="icon-bubbles6 text-primary LiveHelpStatus" id="LiveHelpStatusDefault"></i><span>Live chat</span></a>                                
							</div>
						</div>-->
					   <?php
                        include("headers_right_menu_inc.php");
						?>

				</div>
				</div>
                
				<!-- Content area -->
				<div class="content easy-dash">
					<?php
$userid = $_SESSION['user_id'];

$client_agreement = $db->select("client_agreement_confg","*","agr_receiver = $userid AND is_expired = '0' AND is_user_login = '1'");
if(mysql_num_rows($client_agreement))
{
?>
                    <div class="alert bg-info-400 " >
										<button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
										<span class="text-semibold">Notification!</span> Please update your password to secure your account. For update <a href="?action=profile&atype=view" class="alert-link">Click Here</a>
								    </div>
 <?php
 }
 ?> <?php 
  $comInfo = getcompany($COMINF['id']);
	$comInfo = @mysql_fetch_array($comInfo);
 
 $client_agreement2 = $db->select("client_agreement_confg","*","agr_receiver = $userid AND is_expired = '0'");
 if(mysql_num_rows($client_agreement2))
{
if($comInfo['is_agreed'] == 0 && $LEVEL == 4)
{
?>
<script>
 
$(document).ready(function(){
$("#open_agr_sec").trigger("click");

});
 window.onload = function(){
 
        $('body').width($('body').width());
        $('body').css('overflow', 'hidden');
        $('#shadow').css('display', 'block');
    
};$('#close_sec').click(function(){
        $('body, #shadow').removeAttr('style')
    })
/*$(window).ready(function(){
	

    $('#open_agr_sec').click(function(){
        $('body').width($('body').width());
        $('body').css('overflow', 'hidden');
        $('#shadow').css('display', 'block');
    })
    $('#close_sec').click(function(){
        $('body, #shadow').removeAttr('style')
    })
})
*/
</script>  
<a id='open_agr_sec' href="#">X</a>


<div id="shadow">
    <div id="popup">
	<form method="post">
	Please accept the agreement.
	<input class="coupon_question" type="checkbox" name="coupon_question"   onchange="valueChanged()"/>
	<input  type="submit" name="agr_accptnc"  class="disabled" id="close_sec"  value="Agree" />
   
    </form>
	</div>
</div><style>
#shadow{
    display: none;
    position: fixed;
    top:0;
    bottom: 0;
    width: 100%;
    height:100%;
    background-color: rgba(0,0,0,0.6);
}

#popup{
    padding: 20px;
    position: absolute;
    top:50%;
    left: 50%;
    background-color: white;
}

.disabled {
   pointer-events: none;
   cursor: default;
}
</style>

<script>
 function valueChanged(){
    if($('.coupon_question').is(":checked"))   
       { 
	   $("#close_sec").removeClass('disabled');
	    
	   }  
    else {
       // alert("Please accept term and conditions.");
	   $("#close_sec").addClass('disabled');
	    
	}
 }
 
 
</script>


<?php
 }
  }
 ?>


 
                    <?php include("include_pages/top_count_boxes_dash_basic.php"); ?>   
                    
                    	<!-- Basic area chart -->
					<div class="panel panel-flat" style="margin-bottom: 40px;">
						<div class="panel-heading">
							<h5 class="panel-title text-semibold">TAT Report (<?php echo $date_range_title;?>)</h5>
							<div class="heading-elements">
								<ul class="icons-list">
			                		<li><a data-action="collapse"></a></li>
			                		<li><a data-action="reload"></a></li>
			                	</ul>
		                	</div>
						</div>

						<div class="panel-body">
							<div class="chart-container">
								<div class="chart" style="height:300px;" id="basic_area"></div>
							</div>
						</div>
					</div>
					<!-- /basic area chart -->
                         
				
					<?php include("basic_dashboard/checks_timeline_dash_basic.php"); ?> 				
					

						
					


				
                
                </div>
				<!-- /content area -->

			</div>
			<!-- /main content -->
            
            
            <div class="sidebar sidebar-secondary sidebar-default">
				<div class="sidebar-content">

					<!-- Sidebar tabs -->
					<div class="tabbable sortable ui-sortable">
						<ul class="nav nav-lg nav-tabs nav-justified">
							<li class="active">
								<a href="#components-tab" data-toggle="tab">
									<i class="icon-grid-alt"></i>
									<span class="visible-xs-inline-block position-right">Components</span>
								</a>
							</li>

							<li>
								<a href="#forms-tab" data-toggle="tab">
									<i class="icon-menu6"></i>
									<span class="visible-xs-inline-block position-right">Forms</span>
								</a>
							</li>
                            
                            <li>
								<a href="javacript:;" id="cross" data-toggle="tab">
									<i class="icon-arrow-right7"></i>
								</a>
							</li>
                            
						</ul>

						<div class="tab-content">
							<div class="tab-pane active no-padding" id="components-tab">

								<!-- Block buttons -->
								<div class="sidebar-category">
									<div class="category-title">
										<span>Dashboard Mood</span>
										<ul class="icons-list">
											<li><a href="#" data-action="collapse"></a></li>
										</ul>
									</div>

									<div class="category-content">
										<div class="row">
											<div class="col-xs-6">
												<button class="btn bg-info-400 btn-block btn-float btn-float-lg" type="button"><i class="icon-git-branch"></i> <span>Basic</span></button>
											</div>
											
											<div class="col-xs-6">
											
											

												<button class="btn bg-red btn-block btn-float btn-float-lg" type="button" data-popup="tooltip" title="" data-placement="bottom" data-container="body" data-original-title="Advance Dashboard Coming Soon..." aria-expanded="true"><i class="icon-stats-bars"></i> <span>Advance</span></button>
												
											</div>
										</div>
									</div>
								</div>
								<!-- /block buttons -->


							</div>

							<div class="tab-pane no-padding" id="forms-tab">

								<!-- Sidebar search -->
								<div class="sidebar-category">
									<div class="category-title">
										<span>Search Filter</span>
										<ul class="icons-list">
											<li><a href="#" data-action="collapse"></a></li>
										</ul>
									</div>

									<div class="category-content">
										<form name="frm_date_range" id="frm_date_range" method="post" class="main-search">
											<!-- <div class="form-group">
												<input type="search" class="form-control" placeholder="Search">
												<div class="form-control-feedback">
													<i class="icon-search4 text-size-base text-muted"></i>
												</div>
											</div>-->
                                            
					<div class="form-group">
						<label>Select Time Period For Timeline And Chart</label>
											
					<select class="select" name="date_range" onchange="document.frm_date_range.submit();">
					<option value="last_six_months" <?php echo chk_or_sel($_REQUEST['date_range'],'last_six_months','selected');?>>Last Six Months</option>
					<option value="" <?php echo chk_or_sel($_REQUEST['date_range'],'','selected');?>>One Month From Today</option>					
					<option value="this_month" <?php echo chk_or_sel($_REQUEST['date_range'],'this_month','selected');?>>This Month</option>
					 <option value="last_month" <?php echo chk_or_sel($_REQUEST['date_range'],'last_month','selected');?>>Last Month</option>
					 <option value="this_week" <?php echo chk_or_sel($_REQUEST['date_range'],'this_week','selected');?>>This Week</option>
					 <option value="last_week" <?php echo chk_or_sel($_REQUEST['date_range'],'last_week','selected');?>>Last Week</option>
					 
				  
					</select>
											
												
					</div>
                                            
                                            
                                            
										</form>
									</div>
								</div>
								<!-- /sidebar search -->
								<?php if($LEVEL!=4) { ?>
								<div class="sidebar-category">
									<div class="category-title">
										<span>Select Client</span>
										<ul class="icons-list">
											<li><a href="#" data-action="collapse"></a></li>
										</ul>
									</div>

									<div class="category-content">
										<form name="frm_client" id="frm_client" method="post" class="main-search">
											<div class="form-group">
                                            <label>Select</label>
										<select  name="client_id" class="select" id="client_id_db" onchange="document.frm_client.submit()">
									  <option value=""> Select Client </option>
									  <?php 
									  $clients = $db->select("company","name,id","is_active=1 ORDER BY name ASC");
									  while($client = @mysql_fetch_assoc($clients)){ 
									   ?>
									  <option value="<?php echo $client['id'];?>" <?php echo chk_or_sel($client['id'],$company_id,'selected');?>>
									 <?php echo $client['name'];?>
									  </option>
									  <?php } ?>
									</select>
												
											</div>
										</form>
									</div>
								</div>
								<?php } else{?>
								<input type="hidden" id="client_id_db"	value="<?php echo $COMINF['id'];?>">
								<?php } ?>


							</div>

							

							
						</div>
					</div>
				</div>
			</div>
            
            
            

		</div>
		<!-- /page content -->
<?php include("basic_dashboard/dash_chart.php");?>
	
 <script type="text/javascript">
		
		function submitFrm(frmid){
				
				document.frmid.submit();
				
			}
			
		function setLocation(){
			
			document.frm_loc.submit();
			
		}
		function saveFilter(filter_what,filter_by,div_class){
			//alert(id);
			//images/spinners/3.gif
			 $("."+div_class).html('<li><img align="center" src="images/spinners/3.gif" /></li>');
			$.ajax({
url: "actions.php",
data:'ePage=add_rating&filter_what='+filter_what+'&filter_by='+filter_by,
type: "POST",
success: function(res){
if(res=='inserted' || res=='updated'){
	
$.ajax({
url: "actions.php",
data:'ePage=filtered_data&filter_what='+filter_what,
type: "POST",
success: function(rs){

if(filter_what=='by_risk'){
	var myarr = rs.split(";");
	
	var amber 		= myarr[0];
	var red 		=  myarr[1];
	var green 		= myarr[2];
					
proton.dashboard.drawByRisk(amber,red,green);

}else if(filter_what=='by_status'){
	$("."+div_class).html(rs);
	//var dt = $("."+div_class).html();
	//console.log(dt);
	 //Highcharts.data(dt);
	 
	 Highcharts.data({
	csv: $("."+div_class).html(),
	itemDelimiter: '\t',
	parsed: function (columns) {

		var brands = {},
			brandsData = [],
			versions = {},
			drilldownSeries = [];

		// Parse percentage strings
		columns[1] = $.map(columns[1], function (value) {
			if (value.indexOf('%') === value.length - 1) {
				value = parseInt(value);
			}
			return value;
		});

		$.each(columns[0], function (i, name) {
			var brand,
				version;

			if (i > 0) {
				
				// Remove special edition notes
				name = name.split(' -')[0];

				// Split into brand and version
				version = name.match(/([0-9]+[\.0-9x]*)/);
				if (version) {
					version = version[0];
				}
				brand = name.replace(version, '');
				
				// Create the main data
				if (!brands[brand]) {
					brands[brand] = columns[1][i];
				} else {
					brands[brand] += columns[1][i];
				}

				// Create the version data
				if (version !== null) {
					if (!versions[brand]) {
						versions[brand] = [];
					}
					versions[brand].push(['v' + version, columns[1][i]]);
				}
				
			}

		});

		$.each(brands, function (name, y) {
			brandsData.push({
				name: name,
				y: y,
				drilldown: versions[name] ? name : null
			});
		});
		$.each(versions, function (key, value) {
			drilldownSeries.push({
				name: key,
				id: key,
				data:  parseInt(value)

				
			});
		});

		// Create the chart
		$('#container_st').highcharts({
			credits: {
				enabled: false
			},
			chart: {
				type: 'column'
			},
			title: {
				text: ''
			},
			subtitle: {
				text: ''
			},
			xAxis: {
				allowDecimals: false,
				type: 'category'
			},
			yAxis: {
				allowDecimals: false,
				title: {
					text: ''
				}
			},
			legend: {
				enabled: false
			},
			plotOptions: {
				series: {
					borderWidth: 0,
					dataLabels: {
						enabled: true,
						format: '{point.y:.0f}'
					}
				}
			},
			colors: [
				'#00b9f7',
				'#8DC655',
				'#FFC943',
				'#e8511a'
			],

			tooltip: {
				headerFormat: '<span style="font-size:11px"><b>{point.y:.0f}</b> {series.name}</span><br>',
				pointFormat: '<span style="color:{point.color}">{point.name}</span>'
			},

			series: [{
				
				name: 'Check(s)',
				colorByPoint: true,
				data: brandsData
			}],
			drilldown: {
				series: drilldownSeries
			}
		});
	}
});
	 
	 
	 
	 
	 
	
}else{
$("."+div_class).html(rs);	
}	
	


}


});






	
}else{
	$("."+div_class).html('');
	alert(res);
	
}
},
error: function(){
alert('failed to load request');
}


});
			
			
		}

		
	

	   // make an ajax call to your server and fetch the next 100, then update
      //some vars
	   var frm=0;
	var to=20;
	$(function() {
	  $(window).scroll(function() {
		  
   if($(window).scrollTop() + $(window).height() == $(document).height()) {
	  
	
      // console.log("bottom!");
  frm=parseInt(frm)+20;
   to=parseInt(to)+20;
   $('.no-recordss').show(); 
  // $('.no-recordss').html('loading...'); 
 	$('.no-recordss').html('<span class="btn bg-grey"><i class="icon-spinner4 spinner"></i> Loading</span>'); 
    
	    $.ajax({
			type: 'POST',
            url: "actions.php",
            data: 'ePage=add_rating&loadmore_timeline_dash=1&company_id=<?php echo $company_id;?>&dateRange=<?php echo urlencode($dateRange);?>&limit_pg='+frm+','+to,
            success: function(result){
				//console.log(result);
				
                //cur_index +=10;
                //screen_height = $('body').height();
				
				
				if(result == 'No More Records')
				{   
					//console.log(result);
					$('.no-recordss').addClass('panel'); 
					//$('.no-recordss').addClass('bg-info-400'); 
//No more records to load
					$('.no-recordss').fadeIn( 400 ).html('<div class="panel-body"><span style="color: #999; font-weight: 500; font-size: 17px;">No More records to load</span></div>'); 
				}else{
				$('.no-recordss').hide(); 
                $( "#loadmore_timeline_dash" ).fadeIn( 400 ).append(result);
				afterAjaxPrintLetterIcon('timeline-row','timeline-time','letter-icon');
				}
            }
        });
		 }
});
	});
		
 		
       



 </script>