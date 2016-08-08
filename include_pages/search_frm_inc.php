<div style="margin:auto; width:1000px; background-image:url(images/brc-bg.png); -moz-border-radius:5px; -webkit-border-radius:5px; border-radius:5px;">     
     <form action="?action=search" method="post" name="abc"> 
     	<div style="margin:auto;"> 
            <div class="srcnt">
                <div class="mainsearch">
                    <input type="text" name="name" title="Search by First and Last Name..." size="71" value="Search by First and Last Name..." id="name" class="mainsrch req auto" style="color:#999;">
                </div>
                <div class="mainsrcbtn"> 
                    <a onClick="validate_form(abc);">
                    <img border="0" onmouseout="document.sub_srch.src='images/src_orange.png'" src="images/src_orange.png" alt="Submit this form" onmouseover="document.sub_srch.src='images/src_red.png'" name="sub_srch">
                </a>
                </div>  
                <div class="mainsearch2">
                    <div style="padding-top:10.5px; float:left; padding-left:20px;">
                        <input name="type" type="radio" value="like" checked />Wildcard Search
                        <input name="type" type="radio" value="exact"  />Exact Search
                    </div>
                </div>
            </div>
             <div class="clear"></div>
		</div>
	</form>
    <div class="clear"></div>
</div>

<form style="display:none" name="searchFrom" action="?action=details" method="post" enctype="multipart/form-data" target="_blank">
	<input type="hidden" value="" name="cid" />
</form>
