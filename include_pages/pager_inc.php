<div class="dataTables_wrapper">
	<?php if($db_count >9){?>
        <div class="dataTables_paginate paging_bs_normal">	
        	<div class="dataTables_info">Showing <?=$pages->current_page?> to <?=$pages->default_ipp?> of <?=$db_count?> entries</div>	                       
            <div class="dataTables_info vpagination">
				<?=$pages->display_pages()?>
            </div>
                   
        </div>	
    <?php } ?> 
     <div class="clear"></div> 
</div>