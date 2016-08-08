<?php
if($_REQUEST['id']==3){
	$arr=array(1,2,3);
	echo json_encode($arr);
	exit;
}
 ?>

<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
<script type="text/javascript">
function approve_task(id){
           var surl = "http://backcheck.io/verify/resp_bitrix.php?action=checkapproved&bitrixtid="+id;
	  
            $.ajax({
                type: 'GET',
                url: surl,
                crossDomain: true,
                contentType: "application/json; charset=utf-8",
                data: { UserID: 1234 },
                dataType: "jsonp"
               
            });

}
function test(){
	alert("sdsdv");
}
</script>
<a href="javascript:void(0)" onclick="approve_task(38210)">Test Cross Domain</a>