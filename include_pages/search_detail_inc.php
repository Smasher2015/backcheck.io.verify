<?php 
if(is_numeric($_REQUEST['cid'])){
	$doc = geCrmlInfo($_REQUEST['cid']);
	$aURL="?action=details&cid=$_REQUEST[cid]";
	addActivity('sprofile',$doc['FullName'],$LEVEL,$aURL);
?>
	<div class="innerdiv" style="margin-top:-2px;">
		<div align="left" style="float:right;margin:10px 20px 0 0;">
			   <div id="sh"> 
               		<?php 
						$fname = str_replace(' ','_',$doc['FullName']);
						$URL = SURL."pdf.php?pg=search&id=$_REQUEST[cid]"
					?>
					<a href="javascript:void(0)"  onclick="downloadPDF('<?php echo $URL;?>')" style="border: 0pt none;"> 
						<img border="0" src="images/report.png" style="padding-top:4px;">
					</a>
				</div>
		</div> 
		<h2 class="head-alt"><?php echo $doc['FullName']; ?></h2>
		
		<div class="innercontent">
			<div class="panes" style="margin-top:32px;">                    
					<table width="100%" border="0" >
						 <?php if($doc['FirstName'] != NULL){ ?>
						  <tr>
							<td width="25%" style="border-right-style:hidden;"><strong>First Name</strong></td>
							<td width="75%"><?php echo $doc['FirstName']; ?></td>
						  </tr>
						 <?php } ?>
						 <?php if($doc['MiddleName'] != NULL){ ?>
						  <tr>
							<td style="border-right-style:hidden;"><strong>Middle Name</strong></td>
							<td><?php echo $doc['MiddleName']; ?></td>
						  </tr>
						 <?php } ?>
						 <?php if($doc['LastName'] != NULL){ ?>
						  <tr>
							<td style="border-right-style:hidden;"><strong>Last Name</strong></td>
							<td><?php echo $doc['LastName']; ?></td>
						  </tr>
						 <?php } ?>
						  <tr>
							<td style="border-right-style:hidden;"><strong>Reason For Inclusion </strong></td>
							<td><?php echo $doc['OffenceDescription'];  ?><?php if($doc['OffenceDescription'] != NULL){ echo '/'; }?> <?php echo $doc['Header'];  ?></td>
						  </tr>
						<?php if(($doc['DateofResearch'] != '0000-00-00 00:00:00') || ($doc['DateofResearch']!='')){?>
						  <tr>
							<td  style="border-right-style:hidden;"><strong>Date of Research</strong></td>
							<td><?php 	echo $doc['DateofResearch']; ?></td>
						 </tr> 
						<?php } ?>
						<?php  if(($doc['Nationality'] != '0000-00-00 00:00:00') || ($doc['Nationality']!='')){ ?>
						  <tr>
							<td  style="border-right-style:hidden;"><strong>Nationality</strong></td>
							<td><?php 	echo $doc['Nationality']; ?></td>
							</tr>
						<?php } ?>
						  <tr>
							<td style="border-right-style:hidden;"><strong>Source of Information</strong></td>
							<td><?php echo $doc['Source1'];  ?></td>
						  </tr><?php if($doc['Identifiers'] == NULL) { ?>
						<?php } else { ?>
						  <tr>
							<td style="border-right-style:hidden;"><strong>Identifiers</strong></td>
							<td><?php echo $doc['GIdentifiers']; ?></td>
						  </tr>
						<?php  } ?>
						<?php if($doc['DateofBirth'] != NULL){?>
						  <tr>
							<td style="border-right-style:hidden;"><strong>Date of Incident</strong></td>
							<td><?php echo $doc['DateofIncident']; ?></td>
						  </tr>
						<?php } ?>
						<?php if($doc['Address1'] != NULL){ ?>
						  <tr>
							<td style="border-right-style:hidden;"><strong>Address</strong></td>
							<td><?php echo $doc['Address1'];  ?></td>
						  </tr>
						<?php } ?>
						<?php if($doc['Country1'] != NULL){?>
						  <tr>
							<td style="border-right-style:hidden;"><strong>Country1</strong></td>
							<td><?php echo $doc['Country1'];  ?></td>
						  </tr>
						<?php } ?>
						<?php if($doc['WordSummary1'] != NULL){ ?>
						  <tr>
							<td style="border-right-style:hidden;"><strong>Word Summary</strong></td>
							<td><?php echo $doc['WordSummary1'];  ?></td>
						  </tr>
					   <?php } ?>
					   <?php if($doc['Weblink1'] != NULL){?>
						  <tr>
							<td style="border-right-style:hidden;"><strong>Source Link</strong></td>
							<td>
								<a href="<?php echo $doc['Weblink1']; ?>" target="_blank" title="<?php echo $doc['Weblink1'];  ?>"><?php echo $doc['Weblink1']; ?></a>
							</td>
						  </tr>
						<?php } ?>
					</table>
			</div>
		</div>
	</div>
	
	
	<?php if($doc['RCRN']!=''){
		$dataInfo = geCrmlInfo('',$doc['RCRN']);
		$cCount = mysql_num_rows($dataInfo);
	} else $cCount=0;
	if($cCount > 0 ){ ?>
	<div class="innerdiv clear">
		<h2 class="head-alt">Associated Entity</h2>
		<div class="innercontent">
			<table width="100%" id="alter">
				<thead>
					 <tr >
						<th>Name</th>
						<th>Reason for Inclusion</th>
						<th>Location</th>
					 </tr>
				</thead>
				<tbody>
	<?php while($data = mysql_fetch_array($dataInfo)){ ?>
			<tr onclick="searchDetails(<?php echo $data['id']; ?>,'<?php echo isset($_SESSION['user_id'])?'true':'false'; ?>')" class="phover">
				<td>
			<?php  if($data['FullName'] == NULL) {?>
					  <?php echo $data['Company']; ?><br>
					  <?php echo check_entity($data['Company']);?> Associate Entries.
			<?php }else { ?>
					  <?php echo $data['FullName']; ?>
			<?php } ?>
					</td>
					<td><?php echo $data['OffenceDescription']; ?></td>
					<td><?php echo $data['Country1']; ?></td>
				</tr>
	<?php }  ?>
			</tbody>
			</table>
		</div>
	</div>
<?php } ?>
				
<?php 	$search= new SRC();
		$search->primaryKey="id";
		$search->tableName="medicalstaff";
		$search->srchField="FullName";
		$search->search_text = $doc['FullName'];
		$searchs = $search->searchExact();	
	//$dataInfo = mysql_query("SELECT * FROM medicalstaff where FullName='$doc[FullName]' and id!=$doc[id] limit 0,10");
	if(count($searchs)>1){ ?>
		<div class="innerdiv clear">
				<h2 class="head-alt">Other Possible Matches</h2>
				<div class="innercontent">
					<table width="100%" id="alter">
						<thead>
							<tr class="trhd">
								<th>Name</th>
								<th>Reason for Inclusion</th>
								<th>Location</th>
							 </tr>
						 </thead>
					  <tbody>
	<?php foreach($searchs as $search){ ?>
	<?php   if($search['id']  != $doc['id'] ){ ?>
					  <tr onclick="searchDetails(<?php echo $search['id']; ?>,'<?php echo isset($_SESSION['user_id'])?'true':'false'; ?>')" class="phover">
						<td><?php echo $search['FullName']; ?></td>
						<td><?php echo $search['OffenceDescription']; ?></td>
						<td><?php echo $search['Country1']; ?></td>
					  </tr>
					<?php } ?>
	<?php } ?>
					</tbody>
					</table>
				</div>
			</div>
	<?php } ?>
			

<div class="innerdiv clear" style="background-color:#fff;">
    <h2 class="head-alt">Results from Linkedin</h2>
    <div style="float:right; height:60px; width:100px; padding-right:80px; margin-top:10px;">
        <img src="images/linkedin.png" width="160" height="45" />
    </div>
<?php 	include("include_pages/linkedin_inc.php"); ?> 
    <div class="clear"></div>
</div>
<?php }?>