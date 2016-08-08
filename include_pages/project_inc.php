<div class="box grid_16">
                        <h2 class="box_head">Add Project</h2>
                        <a href="#" class="grabber">&nbsp;</a>
                        <a href="#" class="toggle">&nbsp;</a>
                        <div class="toggle_container">	
    <form class="cstm" action="" name="" method="post" >
    
										<fieldset class="label_side">
											<label>Select Company:</label>
											<div>
												<select class="req select_box full_width" title="Select Company" name="com_id">
													<option value="" <?php if(!isset($_REQUEST['com_id'])) echo 'selected="selected"'; ?> >--Select Company--</option>
                        <?php
						if($_SESSION['user_id']==50 || $_SESSION['user_id']==83){
								$dWhere="id=20";
						}else $dWhere="";							
						$companys = $db->select("company","*",$dWhere);
						if(mysql_num_rows($companys)>0){
							while($company = mysql_fetch_array($companys)){ ?>
                        		<option value="<?php echo $company['id']; ?>" 
									<?php if(isset($_REQUEST['com_id'])) if($company['id']==$_REQUEST['com_id']) echo 'selected="selected"'; ?>>
									<?php echo $company['name']; ?>
                                </option>
                        <?php }
						} ?>
												</select>				
											</div>
										</fieldset>
                                        
                            <fieldset class="label_side">
									<label>Project Name:</label>
									<div>
										<input class="req input etitle" title="Input Project Name" type="text" name="prname" value="<?=$_REQUEST['prname']?>" >
									</div>
								</fieldset>
							<fieldset class="label_side">
									<label>POC Name:</label>
									<div>
										<input class="req input etitle" title="Input POC Name" type="text" name="poname" value="<?=$_REQUEST['poname']?>" >
									</div>
								</fieldset>
							<fieldset class="label_side">
									<label>POC Contact:</label>
									<div>
										<input class="req input etitle" title="Input POC Contact" type="text" name="pocont" value="<?=$_REQUEST['pocont']?>" >
									</div>
								</fieldset>
							<fieldset class="label_side">
									<label>Primary Analyst:</label>
									<div>
										<input class="req input etitle" title="Input Primary Analyst" type="text" name="priran" value="<?=$_REQUEST['priran']?>" >
									</div>
								</fieldset>
							<fieldset class="label_side">
									<label>Secondary Analyst:</label>
									<div>
										<input class="req input etitle" title="Input Secondary Analyst" type="text" name="secran" value="<?=$_REQUEST['secran']?>" >
									</div>
								</fieldset>
							<fieldset class="label_side">
									<label>Notes:</label>
									<div>
										<textarea class="input" name="notes" ><?=$_REQUEST['notes']?></textarea>
									</div>
								</fieldset>
							      <div class="button_bar clearfix">   
                	<button class="btnright div_icon has_text text_only" style="float:right;"  type="submit" name="addProject">
                    <span>Add Project</span>
                    </button>
                    </div>
        
    </form>
</div>
</div>

<div class="box grid_16 tabs">		
        <h2 class="box_head">Project Listing</h2>
        <a href="#" class="grabber">&nbsp;</a>
        <a href="#" class="toggle">&nbsp;</a>
        <div class="toggle_container">
            <div class="block">
             <div id="dt2">              
<table class="display datatable"> 
    <thead>
        <tr>
            <th>Company Name</th>
            <th>Project Name</th>
            <th>POC Name</th>
            <th>POC Contact</th>
            <th>Primary Analyst</th>
            <th>Secondary Analyst</th>
        </tr>
    </thead>
    <tbody>
<?php	$projects= $db->select("projects p INNER JOIN company c ON c.id=p.com_id","*");
        if(mysql_num_rows($projects)>0){
        while($project = mysql_fetch_array($projects)){ ?>
            <tr>
                <td><?=$project['name']?></td>
                <td><?=$project['pro_name']?></td>
                <td><?=$project['pro_cperson']?></td>
                <td><?=$project['pro_contact']?></td>
                <td><?=$project['pro_panlst']?></td>
                <td><?=$project['pro_sanlst']?></td>
            </tr>	    
    <?php }}?>
    </tbody>
</table>
    </div>
            </div>
        </div>
    </div>
