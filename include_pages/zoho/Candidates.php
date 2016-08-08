<a href="<?=ZOHO_URL?>?module=Candidates&mode=add">Add Candidate</a>
<?php
if(isset($_REQUEST['mode'])){
	include_once("include_pages/zoho/managecandidates.php");
} else{
?>
<table>
    <thead>
    	<tr>
        	<td>Candidate ID</td>
            <td>Candidate Name</td>
            <td>Candidate Status</td>
            <td>Updated On</td>
             <td>Source</td>
        </tr>
    </thead><tbody>
<?php
$xmldata=processZohomodulerecords($module);
		      $xmlString = <<<XML
$xmldata 
XML;
        $xml = simplexml_load_string($xmldata);
		//print_r($xmldata);die;
		$table=$module;
        $numberOfRecords = count($xml->result->$table->row);
        /* $records[row value][field value] */
        $records[][] = array();
        for ($i = 0; $i < $numberOfRecords; $i++) {
            $numberOfValues = count($xml->result->$table->row[$i]->FL);
            for ($j = 0; $j < $numberOfValues; $j++){
				//echo (string) $xml->result->$table->row[$i]->FL[$j]['val'];
                switch ((string) $xml->result->$table->row[$i]->FL[$j]['val']) {?><?php
                    /* Get attributes as element indices */
                    case 'CANDIDATEID':
                      echo  "<tr><td>".$records[$i]['CANDIDATEID'] = (string) $xml->result->$table->row[$i]->FL[$j]."</td>";
                        break;
                   
                    case 'Last Name':
                    echo    "<td>".$records[$i]['Last Name'] = (string) $xml->result->$table->row[$i]->FL[$j]."</td>";
                        break;
						 case 'Candidate Status':
                       echo "<td>".$records[$i]['Candidate Status'] = (string) $xml->result->$table->row[$i]->FL[$j]."</td>";
                        break;
                    case 'Last Activity Time':
                   echo     "<td>".$records[$i]['Last Activity Time'] = (string) $xml->result->$table->row[$i]->FL[$j]."</td>";
                        break;
					case 'Source':
                    echo   "<td>". $records[$i]['Source'] = (string) $xml->result->$table->row[$i]->FL[$j]."</td>";
                        break;
                }
				?><?php
            }
        }?>
        </tbody>
        </table>
        <?php
		//end work on module
}
?>