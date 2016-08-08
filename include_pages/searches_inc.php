<div class="innerdiv">
     <h2 class="head-alt">Search Results for <?php echo $_REQUEST['name']; ?></h2>
        <div class="innercontent">
            <table class="full" border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr class="trhd">
                   	<th width="5%">&nbsp;</th>
                    <th width="35%">Name</th>
                    <th width="45%">Reason For Inclusion</th>
                    <th width="15%">Location</th>
                </tr>
                <tr>
                    <td colspan="4" style="padding:0">
						<?php 
                            $_REQUEST['case']=1;
                             include("include_pages/get_searches_inc.php");
                        ?>
                    </td>
                </tr>
            </table>
        </div>
</div>