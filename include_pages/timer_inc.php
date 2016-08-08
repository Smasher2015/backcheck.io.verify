<?php
if(isset($_SESSION['user_id'])){
	$db = new DB();
	$source=$db->select("activity","max(a_date) time","a_type='login' AND user_id=".$_SESSION['user_id']);
	$source=mysql_fetch_array($source);
	$time = time_dif(date("j-F-Y H:i:s", strtotime($source['time'])),date("j-F-Y H:i:s", time()));

?>
<script language="JavaScript" type="text/javascript">

var sec  = <?php echo $time['seconds'];?>;
var min  = <?php echo $time['minutes'];?>;
var hour = <?php echo $time['hours'];?>;

function stopwatch(text) {
   	sec++;
  	if (sec == 60){sec = 0; min = min + 1; }
  	else{ min = min;}
  	if(min == 60){ min = 0; hour += 1;}
	if (sec<=9) { sec = "0" + sec; }
  document.getElementById("clock").innerHTML = ((hour<=9) ? "0"+hour : hour) + " : " + ((min<=9) ? "0" + min : min) + " : " + sec;
		
	
		 SD=window.setTimeout("stopwatch();", 1000);

		
}

</script>


	<span id="clock"><?php echo $time['hours']." : ".$time['minutes']." : ".$time['seconds'];?></span>
<script type="text/javascript">
	
		stopwatch("start");
	
</script>
<?php } ?>