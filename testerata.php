<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<style>
p{margin: 10px;
	padding: 5px;}
#finalResult{
	list-style-type: none;
	margin: 10px;
	padding: 5px;
	width:300px;
}
.items {height:500px; overflow:scroll;}
</style>
<script type="text/javascript" src="http://www.technicalkeeda.com/js/javascripts/plugin/jquery.js"></script>
<script type="text/javascript" src="http://www.technicalkeeda.com/js/javascripts/plugin/json2.js"></script>
 <script type="text/javascript">
$(document).ready(function(){
    function lastAddedLiveFunc()
    {
/*        $('div#lastPostsLoader').html('<img src="bigLoader.gif"/>');

        $.get("testerata_ajax.php" ,function(data){
            if (data != "") {
                //console.log('add data..');
                $(".items").append(data);
            }
            $('div#lastPostsLoader').empty();
        });
*/   
	
  $.ajax({
  type: 'POST',
  url: 'http://backcheck.io/verify/testerata_ajax.php',
  data: {
    'case':'14545' 
  },
  success: function (response) 	
	{ $(".items").append(response);}
	
	// $('div#lastPostsLoader').empty();
	
	});
	
	 };
	
	
	

    //lastAddedLiveFunc();
   // $(".items").scroll(function(){




      //  var wintop = $(window).scrollTop(), docheight = $(document).height(), winheight = $(window).height();
      //  var  scrolltrigger = 0.95;

       // if  ((wintop/(docheight-winheight)) > scrolltrigger) {
         //console.log('scroll bottom');
         
       // }
    //});
	  $(".items").scroll(function(){
	
	  var elmnt = document.getElementById("sss");
    var x = elmnt.scrollLeft;
    var y = elmnt.scrollTop;
 if(y == 327){ lastAddedLiveFunc();}
console.log(y);
  });

	
	
});

</script>
</head>
<body>		
<ul class="items" id="sss"  >
   <li>content</li>
   <li>content</li>
   <li>content</li>
   <li>content</li>
   <li>content</li>
   <li>content</li>
   <li>content</li>
   <li>content</li>
   <li>content</li>
   <li>content</li>
   <li>content</li>
   <li>content</li>
   <li>content</li>
   <li>content</li>
   <li>content</li>
   <li>content</li>
   <li>content</li>
   <li>content</li>
   <li>content</li>
   <li>content</li>
   <li>content</li>
   <li>content</li>
   <li>content</li>
    <li>content</li>
   <li>content</li>
   <li>content</li>
   <li>content</li>
   <li>content</li>
   <li>content</li>
   <li>content</li>
   <li>content</li>
   <li>content</li>
   <li>content</li>
   <li>content</li>
   <li>content</li>
   <li>content</li>
   <li>content</li>
   <li>content</li>
   <li>content</li>
   <li>content</li>
   <li>content</li>
   <li>content</li>
   <li>content</li>
   <li>content</li>
   ...
</ul>
<div id="lastPostsLoader"></div>	
	
</body>
</html>