<section class="retracted scrollable">
  <div class="row">
    <div class="col-md-12">
      <div class="manager-report-sec">
        <div id="filters" class="section" >
        <div class="page-section-title">
			
              <h2 class="box_head"><?=$PTITLE?></h2>
            </div>
          <div class="list-group-item" >
            

    <div class="toggle_container">

        <div class="block">

         	<div id="dt2">
 <div class="panel panel-default panel-block">
                        <table class="table table-bordered table-striped" id="">
            	

                    <thead>

                        <tr>

                            <th width="0"></th>

                            <th>Holiday</th>

                            <th>Country Name</th>

                            <th>Description</th>

							<th>Start Date</th>

                            <th>End Date</th>

                            <th>Actions</th>

                        </tr>

                    </thead>

                    <tbody>

                <?php	$levels= $db->select("holiday_master","*","1=1 ORDER BY hol_sdate DESC");

                        if(mysql_num_rows($levels)>0){

                        while($level = mysql_fetch_array($levels)){ ?>

                            <tr>

                                <td></td>

                                <td><?=trim($level['hol_holiday'])?></td>

                                <td><?php 

									if($level['country_id']==0){

										echo 'Worldwide';

									}else{

										$cname = getCountry($level['country_id']);

										echo $cname['printable_name'];

									}

									?></td>

                                <td><?=trim($level['hol_desc'])?></td>

                                <td><?=date((($level['hol_yrly']==0)?"j-M-Y":"j-F"),strtotime($level['hol_sdate']))?></td>

                                <td><?=date((($level['hol_yrly']==0)?"j-M-Y":"j-F"),strtotime($level['hol_edate']))?></td>

                                <td align="center">

                                    <?php   $link="?action=addholiday&atype=master&hid=$level[hol_id]";?>                    

             						<a href="<?=$link?>&edit" ><img src="images/icons/small/grey/pencil.png"  class="edits" title="Edit" /></a>

                                </td>

                            </tr>	    

                    <?php }} ?>

                    </tbody>

                 </table>

        	</div>
			</div>

        </div>

     </div>

</div>

 </div>
        </div>
      </div>
	  </div>
     
  <div class="clear"></div>
  
  
  
</section>

