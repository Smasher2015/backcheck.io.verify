<table>
    <thead>
    	<tr>
        	<td>Job Opening ID</td>
            <td>Posting Title</td>
            <td>Assigned Recruiter</td>
            <td>Target Date</td>
             <td>Job Opening Status</td>
             <td>Client Name</td>
        </tr>
    </thead><tbody>
<?php
$xmldata=processZohomodulerecords($module);
		      $xmlString = <<<XML
$xmldata 
XML;
        $xml = simplexml_load_string($xmldata);
		//	print_r($xmldata);
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
                    case 'Job Opening ID':
                      echo  "<tr><td>".$records[$i]['Job Opening ID'] = (string) $xml->result->$table->row[$i]->FL[$j]."</td>";
                        break;
                   
                    case 'Account Manager':
                    echo    "<td>".$records[$i]['Account Manager'] = (string) $xml->result->$table->row[$i]->FL[$j]."</td>";
                        break;
						 case 'Posting Title':
                       echo "<td>".$records[$i]['Posting Title'] = (string) $xml->result->$table->row[$i]->FL[$j]."</td>";
                        break;
                    case 'Target Date':
                   echo     "<td>".$records[$i]['Target Date'] = (string) $xml->result->$table->row[$i]->FL[$j]."</td>";
                        break;
					case 'Job Opening Status':
                    echo   "<td>". $records[$i]['Job Opening Status'] = (string) $xml->result->$table->row[$i]->FL[$j]."</td>";
                        break;
						case 'Client Name':
                   echo     "<td>".$records[$i]['Client Name'] = (string) $xml->result->$table->row[$i]->FL[$j]."</td></tr>";
                        break;
                }
				?><?php
            }
        }?>
        </tbody>
        </table>
        <?php
		//end work on module
		 
?>