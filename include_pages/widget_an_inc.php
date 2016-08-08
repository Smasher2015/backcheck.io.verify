<?php include("include_pages/checks_counter_inc.php"); ?>
<?php if($LEVEL==2){?>	
	<div class="widget increase" id="new-hp">
		<a href="?action=assign">
			<span>
				<?=$nAsgchk?>
			</span>
			<p><strong>Checks for </strong>Assign</p>
		</a>
	</div>
	<div class="widget increase" id="new-hp">
		<a href="?action=close&atype=ready">
			<span>
				<?=$admrmks?>
			</span>
			<p><strong>Checks for </strong>Remark</p>
		</a>
	</div>  
	<div class="widget increase" id="new-hp">
		<a href="?action=close&atype=ready">
			<span>
				<?=$ckTosnt?>
			</span>
			<p><strong>Ready </strong>Checks</p>
		</a>
	</div>  
	<div class="widget increase" id="new-hp">
		<a href="?action=close&atype=send">
			<span>
				<?=$cksntdd?>
			</span>
			<p><strong>Sent </strong>Checks</p>
		</a>
	</div>           
<?php } ?>  
	<div class="widget increase" id="new-hp">
		<a href="?action=assigned&atype=case">
			<span>
				<?=$asgnchk?>
			</span>
			<p><strong>Assigned </strong>Checks</p>
		</a>
	</div>   
    <div class="widget increase" id="new-hp">
		<a href="?action=notin&atype=case">
			<span>
				<?=$notinst?>
			</span>
			<p><strong>Not Initiated</strong>Checks</p>
		</a>
	</div>
    <div class="widget increase" id="new-hp">
		<a href="?action=problem&atype=case">
			<span>
				<?=$probchk?>
			</span>
			<p><strong>Problem </strong>Checks</p>
		</a>
	</div>
	<div class="widget increase" id="new-hp">
		<a href="?action=wip&atype=case">
			<span>
				<?=$pendgchk?>
			</span>
			<p><strong>WIP </strong>Checks</p>
		</a>
	</div>    
	<div class="widget increase" id="new-hp">
		<a href="?action=close&atype=case">
			<span>
				<?=$closechk?>
			</span>
			<p><strong>Closed </strong>Checks</p>
		</a>
	</div>    
	<div class="widget increase" id="new-hp">
		<a href="?action=case&atype=add">
			<span>
				<?=$savecass?>
			</span>
			<p><strong>Saved </strong>Cases</p>
		</a>
	</div> 
	<div class="widget increase" id="new-hp">
		<a href="?action=unies&atype=list">
			<span>
				<?=$cntunies?>
			</span>
			<p><strong>Universities </strong>List / Add / Edit</p>
		</a>
	</div>     
<?php if(($_REQUEST['ERR']!='') ||($_REQUEST['SCS']!='')){?>	
    <div class="widget increase" id="new-hp" style="background-color:#FFC;">
		<a href="javascript:void(0)" onclick="showNotific()">
			<span>
				<?=$_REQUEST['CNT']?>
			</span>
			<p><strong>Notification</strong>Message(s)</p>
		</a>
	</div>     
<?php } ?>                                    
