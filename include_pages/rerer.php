<?php

$fields = actionFields('',1,4);
?>
<form action="" name="" method="post" enctype="multipart/form-data" >
        <table class="cstm">
            <tbody>
            <?php while($field = mysql_fetch_array($fields)){ ?>
            <tr>
                <td><?php echo $field['fl_title']; ?></td>
                <td><?php echo renderFields($field);  ?></td> 		
            </tr> 
           	<?php } ?>
            </tbody>
        </table>
</form>
