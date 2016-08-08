<?php
function trafic_source()
{
	$sql_sources = "SELECT `hosts`, COUNT(`hosts`) AS thosts FROM stats WHERE (`hosts`!='' AND `hosts`!='0' AND `hosts`!='BackgroundChecksWiki') GROUP BY `hosts` ORDER BY thosts DESC";
	$res_sources = mysql_query($sql_sources);
	return $res_sources;
}

function time_agoa($date,$granularity=2) {
    $date = strtotime($date);
    $difference = time() - $date;
    $periods = array('decade' => 315360000,
        'year' => 31536000,
        'month' => 2628000,
        'week' => 604800, 
        'day' => 86400,
        'hour' => 3600,
        'minute' => 60,
        'second' => 1);
    foreach ($periods as $key => $value) {
        if ($difference >= $value) {
            $time = floor($difference/$value);
            $difference %= $value;
            $retval .= ($retval ? ' ' : '').$time.' ';
            $retval .= (($time > 1) ? $key.'s' : $key);
            $granularity--;
        }
        if ($granularity == '0') { break; }
    }
    return '  '.$retval.' ago';      
}

function rel_time($from, $to = null)
 {
  $to = (($to === null) ? (time()) : ($to));
  $to = ((is_int($to)) ? ($to) : (strtotime($to)));
  $from = ((is_int($from)) ? ($from) : (strtotime($from)));

  $units = array
  (
   "year"   => 29030400, // seconds in a year   (12 months)
   "month"  => 2419200,  // seconds in a month  (4 weeks)
   "week"   => 604800,   // seconds in a week   (7 days)
   "day"    => 86400,    // seconds in a day    (24 hours)
   "hour"   => 3600,     // seconds in an hour  (60 minutes)
   "minute" => 60,       // seconds in a minute (60 seconds)
   "second" => 1         // 1 second
  );

  $diff = abs($from - $to);
  $suffix = (($from > $to) ? ("from now") : ("ago"));

  foreach($units as $unit => $mult)
   if($diff >= $mult)
   {
    $and = (($mult != 1) ? ("") : ("and "));
    $output .= ", ".$and.intval($diff / $mult)." ".$unit.((intval($diff / $mult) == 1) ? ("") : ("s"));
    $diff -= intval($diff / $mult) * $mult;
   }
  $output .= " ".$suffix;
  $output = substr($output, strlen(", "));

  return " ".$output;
 }
 

function page_title($file){
	$result = mysql_query("SELECT * FROM page_info where pagename='$file'");
	while($row = mysql_fetch_array($result))
	{
	 return $row['title'];
    }
    }

	function users($email) {
	$sqlb = "SELECT * FROM users WHERE username ='$email'"; 
	$resultb = mysql_query($sqlb);
	$rowb = mysql_fetch_array($resultb);
	 return $rowb;
	}

	$ip  = $_REQUEST['ip'];
	$user   = $_REQUEST['user'];
	$emaila   = $_REQUEST['email'];
	$country  = $_REQUEST['country'];
	$browsera = $_REQUEST['browsera'];
	$os  = $_REQUEST['os'];
	$days = $_REQUEST['days'];
	$days1 = $_REQUEST['days1'];
	$months = $_REQUEST['months'];
	$months1 = $_REQUEST['months1'];
	$years = $_REQUEST['years'];
	$years1 = $_REQUEST['years1'];

	if($days == NULL & $days == NULL){
	$dayss = "01";
	$dayss1 = "01";
	} else {
	$dayss = $_REQUEST['days'];
	$dayss1 = $_REQUEST['days1'];
	}

	if($months == NULL & $months1 == NULL){
	$monthss = "01";
	$monthss1 = "01";
	} else {
	$monthss = $_REQUEST['months'];
	$monthss1 = $_REQUEST['months1'];
	}
	if($years1 < $years ) {
	$error = "Please select correct years in perfect order.";
	}
	$date = "$years-$monthss-$dayss";
	$date1 = "$years1-$monthss1-$dayss1";

    if($years == NULL & $years1 == NULL) {
    $dateq = "";
	} else {
	$dateq = "and date BETWEEN '$date' AND '$date1'";
	}

	if($dateq == NULL) {
	$pglm = "";
	} else {
	$pglm = "&days=$dayss&days1=$dayss1&months=$monthss&months1=$monthss1&years=$years&years1=$years1";
	}

    if($ip == NULL) {
	$ipq = "";
	} else {
	$ipq = "and ip ='$ip'";
	}

    if($user == NULL) {
	$userq = "";
	} else {
	$userq = "and username ='$user'";
	}

    if($country == NULL) {
	$countryq = "";
	} else {
	$countryq = "and country='$country'";	
	}

    if($os == NULL) {
	$osq = "";
	} else {
	$osq = "and platform ='$os'";
	}

	 if($browsera == NULL) {
	$browseraq = "";
	} else {
	$browseraq = "and browser='$browsera'";
	}

    /*if($email == NULL) {
	$emailq = "and email like '%'";
	} else {
	$emailq = "and email='$email'";
	}
	&email=$emaila*/

    $pgl = "ip=$ip&user=$user&country=$country&os=$os&browsera=$browsera$pglm";
	$queryq = "$ipq $countryq $userq $osq $emailq $browseraq $dateq";

	$tbl_name="stats";		//your table name
	// How many adjacent pages should be shown on each side?
	$adjacents = 3;
	
	$sql_max = "SELECT MAX(id) as maxid FROM stats";
	$res_max = mysql_query($sql_max);
	$row_max = mysql_fetch_assoc($res_max);
	$trecord = $row_max['maxid']-3000;
	
	/* 
	   First get total number of rows in data table. 
	   If you have a WHERE clause in your query, make sure you mirror it here.
	*/
	$query = "SELECT COUNT(id) as num FROM $tbl_name where id>$trecord $queryq";
	$total_pages = mysql_fetch_array(mysql_query($query));
	$total_pages = $total_pages[num];
	/* Setup vars for query. */
	$targetpage = "logs.php"; 	//your file name  (the name of this file)
	$limit = 50; 								//how many items to show per page
	$page = $_GET['page'];
	if($page) 
		$start = ($page - 1) * $limit; 			//first item to display on this page
	else
		$start = 0;								//if no page var is given, set start to 0
	/* Get data. */
	$sql = "SELECT * FROM $tbl_name where id>$trecord $queryq ORDER BY id DESC LIMIT $start, $limit";
	$result = mysql_query($sql);
	/* Setup page vars for display. */
	if ($page == 0) $page = 1;					//if no page var is given, default to 1.
	$prev = $page - 1;							//previous page is page - 1
	$next = $page + 1;							//next page is page + 1
	$lastpage = ceil($total_pages/$limit);		//lastpage is = total pages / items per page, rounded up.
	$lpm1 = $lastpage - 1;						//last page minus 1
	/* 
		Now we apply our rules and draw the pagination object. 
		We're actually saving the code to a variable in case we want to draw it more than once.
	*/

	$pagination = "";
	if($lastpage > 1)
	{	
		$pagination .= "<ul id=\"pagination\">";
		//previous button
		if ($page > 1) 
			$pagination.= "<li><a href=\"$targetpage?page=$prev&$pgl\">« previous </a></li>";
		else
			$pagination.= "<li class=\"previous-off\">« previous</li>";	
		//pages	
		if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
		{	
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				if ($counter == $page)
					$pagination.= "<li class=\"active\">$counter</li>";
				else
					$pagination.= "<li><a href=\"$targetpage?page=$counter&$pgl\">$counter</a></li>";					
			}
		}
		elseif($lastpage > 5 + ($adjacents * 2))	//enough pages to hide some
		{
			//close to beginning; only hide later pages
			if($page < 1 + ($adjacents * 2))		
			{
				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
				{
					if ($counter == $page)
						$pagination.= "<li class=\"active\">$counter</li>";
					else
						$pagination.= "<li><a href=\"$targetpage?page=$counter&$pgl\">$counter</a></li>";					
				}
				$pagination.= "<li>...</li>";
				$pagination.= "<li><a href=\"$targetpage?page=$lpm1&$pgl\">$lpm1</a></li>";
				$pagination.= "<li><a href=\"$targetpage?page=$lastpage&$pgl\">$lastpage</a></li>";		
			}
			//in middle; hide some front and some back
			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
			{
				$pagination.= "<li><a href=\"$targetpage?page=1&$pgl\">1</a></li>";
				$pagination.= "<li><a href=\"$targetpage?page=2&$pgl\">2</a></li>";
				$pagination.= "<li>...</li>";
				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<li class=\"active\">$counter</li>";
					else
						$pagination.= "<li><a href=\"$targetpage?page=$counter&$pgl\">$counter</a></li>";					
				}
				$pagination.= "<li>...</li>";
				$pagination.= "<li><a href=\"$targetpage?page=$lpm1&$pgl\">$lpm1</a></li>";
				$pagination.= "<li><a href=\"$targetpage?page=$lastpage&$pgl\">$lastpage</a></li>";		
			}
			//close to end; only hide early pages
			else
			{
				$pagination.= "<li><a href=\"$targetpage?page=1&$pgl\">1</a></li>";
				$pagination.= "<li><a href=\"$targetpage?page=2&$pgl\">2</a></li>";
				$pagination.= "<li>...</li>";
				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<li class=\"active\">$counter</li>";
					else
						$pagination.= "<li><a href=\"$targetpage?page=$counter&$pgl\">$counter</a></li>";					
				}
			}
		}
		//next button
		if ($page < $counter - 1) 
			$pagination.= "<li><a href=\"$targetpage?page=$next&$pgl\">next »</a></li>";
		else
			$pagination.= "<li class=\"next-off\">next »</li>";
		$pagination.= "</ul>\n";		
	}
	
?>

<div class="manager-report-sec">
<div class="box grid_16">
<div class="list-group-item">
<div class="page-section-title">
<h2 class="box_head">Portal Stats</h2>
</div>
</div>
<div class="list-group-item">
<div id="tableSortable_wrapper" class="dataTables_wrapper form-inline" role="grid" &gt;<div="">
<div class="toggle_container">
  <div id="dt1" class="no_margin">
   <table class="table table-bordered table-striped dataTable" id="tableSortable" aria-describedby="tableSortable_info">
      <thead>
        <tr class="full">
           <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="tableSortable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Title: activate to sort column descending" style="width: 111px;">Arrival</th>
          <th valign="top">Country</th>
          <th valign="top">Browser</th>
          <th valign="top">OS</th>
          <th valign="top">IP Address</th>
          <th valign="top">Long description</th>
          <th valign="top">Action</th>
        </tr>
      </thead>
      <tbody>
               <?php
							 	
								$resulta = mysql_query("SELECT * FROM `stats` where asound='1' and id>$trecord ORDER BY `id` DESC LIMIT 0,10");
								$num_rows = mysql_num_rows($resulta);
								if($num_rows > 0 ){
								$resulte = mysql_query("SELECT * FROM `stats` where asound='1' and id>$trecord ORDER BY `id` DESC LIMIT 0,10");
								while($row = mysql_fetch_array($resulte))
								{
								$csid  = $row['id'];
								 mysql_query("UPDATE stats SET asound = '0' WHERE id  = '$csid'");
								}					
								}

                                while($row = mysql_fetch_array($result))

                                {

                                $refer = str_replace(APP_URL, "", $row['refer']);

                                $pagename = str_replace(APP_URL, "", $row['pagename']);

                                $pagename = str_replace("/", "", $row['pagename']);

                            ?>
        <tr class="full">
          <td valign="top"><div align="center"><img src="images/arr.png" alt="" title="Arrival" width="32" border="0" height="32" /></div></td>
          <td valign="top"><div align="center"><img src="images/flags/<?php if($row['country']!=''){ echo ucwords($row['country']); }else { echo "unrecognized"; }?>.png" / title="<?php echo $row['country']; ?>" /></div></td>
          <td valign="top"><div align="center"><img src="images/browser/<?php echo $row['browser'];?>.png" width="36" height="36" /></div></td>
          <td valign="top"><div align="center"><img src="images/os/<?php echo $row['platform'];?>.png" width="24" height="24" /></div></td>
          <td valign="top"><div align="center"><?php echo $row['ip'];?></div></td>
          <td valign="top"><?php 

                                        if($row['email'] == NULL){

                                        echo "Guest ";

                                        } else {
		
										 $user = users($row['username']);
						

                                        echo '<a href="/?action=users&atype=add/edit&edit=yes&uid='.$user['user_id'].'">'.ucwords($user['first_name']).' '.ucwords($user['last_name']).'</a>';

                                        }

                                        ?>
            <?php
										if($row['refer']!='')
										{
										?>
            arrived from <a href="<?php echo $row['refer']; ?>"><?php echo str_replace("http://verify.backgroundcheck365.com/","",$row['refer']); ?></a>
            <?php
										}
										else
										{ 
										echo ucwords($row['pagename']);
										echo " arrived Directly"; }
										?>
            on <a href="<?php echo $row['cpage']; ?>"><?php echo ucwords($row['pagename']); ?> Page</a> <?php echo time_agoa($row['date']); ?></td>
          <td valign="top"><?php echo ucwords($row['action']); ?></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>
</div>
</div>
</div>
</div>