<h1><a href="?action=category">Category List</a></h1>
<?php
	if(isset($_REQUEST['addcategory'])){
		addCategory($_REQUEST);
	}
?>
<ul>
<?php		
		$categorys = $db->select("categorys","*");
		while($category = mysql_fetch_array($categorys)){ ?>
     		   <li>
               		<a href="?action=screening&cat=<?php echo $category['cat_id'];?>">
			   			<?php echo $category['cat_name'];?>
                    </a>
               </li>		
<?php 	} ?>
</ul>
<form enctype="multipart/form-data" method="post">
    <table>
            <tr>
                <td><b>Category:*</b></td>
                <td><input class="input" type="text" name="category" value="" /></td>
            </tr>
            <tr>
                <td colspan="2">
                    <input class="button" type="submit" name="addcategory" value="Add Category >>" >
                </td>
            </tr>
    </table>
</form>