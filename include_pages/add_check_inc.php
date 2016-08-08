<form method="post" enctype="multipart/form-data">
<?php if(is_numeric($_REQUEST['case'])){
		$verdata = getVerdata($_REQUEST['case']); ?>
        <h4 class="subHdr" >Basic Information</h4>
        <table style="width:100%;">
            <tr>
                <td><b>Candidate Name:</b></td>
                <td><?php echo $verdata['v_name']; ?></td>
            </tr>
            <tr>
                <td><b>Candidate ID:</b></td>
                <td><?php echo $verdata['emp_id']; ?></td>
            </tr>    
            <tr>
                <td><b>Falabeler's Name:</b></td>
                <td><?php echo $verdata['v_ftname']; ?></td>
            </tr>
            <tr>
                <td><b>N.I.C:</b></td>
                <td><?php echo $verdata['v_nic']; ?></td>
            </tr>
            <tr>
                <td><b>Date of Birth:</b></td>
                <td><?php echo date("j-F-Y", strtotime($verdata['v_dob'])); ?></td>
            </tr>        
        </table>
        <h4 class="subHdr" >Upload Checks Information</h4>
        <div>
        	<?php
				include("include_pages/adck_cl_inc.php");
			?>
        </div>
<?php }else{ ?>
		<h4 class="subHdr" >Basic Information</h4>
        <div class="dataFields">
            <div>
                <label >Candidate Name:</label>
                <input class="input req" type="text" name="vname" value="" >
                 <div class="clear" ></div>
            </div>
            <div>
                <label >Candidate ID:</label>
                <input class="input" type="text" name="vid" value="" >
                <div class="clear" ></div>
            </div>        
            <div>
                <label>Falabeler's Name:</label>
                <input class="input req" type="text" name="vfname" value="" >
                <div class="clear" ></div>
            </div>
            <div>    
                <label>N.I.C:</label>
                <input class="input req" type="text" name="vnic" value="" >
                <div class="clear" ></div>
            </div>
            <div>    
                <label>Date of Birth:</label>
                <?php include("include_pages/date_inc.php"); ?>
                <div class="clear" ></div>                                       
            </div> 
            <div class="clear" ></div>
        </div>
        <div>
            <table>
                <thead>
                    <tr>
                        <th >&nbsp;</th>
                        <th >Screenings</th>
                        <th >Prices</th>
                        <th >Date</th>
                    </tr>
                </thead>
                <tbody>
            <?php	
                    $comInfo = companyInfo($_SESSION['user_id']);
                    $comID = $comInfo['id'];
                    $quotes = $db->select("quotes qt INNER JOIN screenings sc ON sc.sc_id=qt.sc_id","DISTINCT *","com_id=$comID AND qt.qt_sent=1");
                    if(mysql_num_rows($quotes)>0){
                    while($quote = mysql_fetch_array($quotes)){ ?>
                        <tr class="shover">
                            <td style="text-align:center;" >
                                <a href="javascript:void(0)">
                                    <?php 
                                        $param="action=page&page=quotesinfo&qid=$quote[qt_id]&type=done";
                                        $dId  = "v$quote[qt_id]";
                                    ?>
                                    <img onClick="showData(this,'<?php echo $param; ?>','<?php echo $dId;?>')" src="img/plusIcon.gif" >
                                    <input type="radio" class="req" name="qid"  value="<?php echo $quote['qt_id']; ?>" />
                                </a>                   
                            </td>
                            <td style="text-align:left;"><?php echo $quote['sc_name']; ?></td>
                            <td style="text-align:left;">
                                <?php echo ($quote['qt_price']!='' && $quote['qt_price']!=0)?$quote['qt_price']:'N/A'; ?>
                            </td>
                            <td><?php echo date("j-F-Y",strtotime($quote['qt_date'])); ?></td>                
                        </tr> 
                        <tr style="display:none;">
                            <td colspan="4"></td>
                        </tr>
                        <tr >
                            <td class="inTD" colspan="4" style="display:none;" id="v<?php echo $quote['qt_id']; ?>"></td>
                        </tr>               
            <?php 	} 
                    }else{ ?>
                        <tr>
                            <td colspan="4"><h1 align="center">No Quote Found</h1></td>
                        </tr>
                    <?php }?>
                </tbody>
            </table>            
        </div>        
<?php } ?>
        <div>
            <?php if(!is_numeric($_REQUEST['case'])){ ?>            	
                <input type="submit" class="button btnright" name="addbasic" value="Submit [ Basic Infomation ] >>" >
            <?php }else{ ?>
                <input type="submit" class="button btnright" name="addAttach" value="Submit [ Attachments ] >>"  />
            <?php }?>
            <div class="clear" ></div>
        </div>
 </form>
 