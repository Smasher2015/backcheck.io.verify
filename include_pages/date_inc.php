<?php
	if(isset($DATE)){
		$day   = (int)date('d',strtotime($DATE));
		$year  = (int)date('Y',strtotime($DATE));
		$month = (int)date('m',strtotime($DATE));
	}else{
		$day=0; $year=0; $month=0;
	}
?>
<table>
    <tr>
    	<td>Day:</td>
        <td>
            <select class="input req" name="day">
                <option value="0" >--Day--</option>
                <?php
                     for($d=1;$d<=31;$d++){ ?>
                    <option value="<?php echo ($d<9)?'0'.$d:$d; ?>" <?= ($day==$d)?'selected="selected"':'';?>  >
                    <?php echo $d; ?>
                    </option>
                <?php } ?>
            </select>
    	</td>
    </tr>
    <tr>
        <td>Month:</td>
        <td>
            <select class="input req" name="month">
                <option value="0" >--Month--</option>
                <?php
                     $tMonths = array("","January","February","March","April","May","June","July","August","September","October","November","December");
                     for($m=1;$m<=12;$m++){ ?>
                    <option value="<?php echo ($m<9)?'0'.$m:$m; ?>" <?= ($month==$m)?'selected="selected"':'';?>  >
                    <?php echo $tMonths[$m]; ?>
                    </option>
                <?php } ?>
            </select>
        </td>
    </tr>
    <tr>
        <td>Year:</td>
        <td>
            <select class="input req" name="year">
                <option value="0" >--Year--</option>
                <?php
                     $tYear = (date("Y")-15);
                     for($y=0;$y<70;$y++){ ?>
                    <option value="<?php echo ($tYear-$y); ?>" <?= ($year==($tYear-$y))?'selected="selected"':'';?> >
                    <?php echo ($tYear-$y); ?>
                    </option>
                <?php } ?>
            </select>
        </td>
    </tr>

</table>
