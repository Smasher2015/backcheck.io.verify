<?php 
/* https://api.pipl.com/search/?email=khalique.ahmed3%40gmail.com&phone=%2B923323602388&first_name=Khalique&last_name=Khan&middle_name=Ahmed&country=Pakistan&state=Sindh&city=Karachi&username=khalique.ahmed3%40gmail.com&age=29&key=CONTACT-PREMIUM-DEMO-7uz36yq8uj1j4hwf7a553wy6 */

function getInfo($url,$data){
	 	 
	 $ch = curl_init();
	//'https://api.pipl.com/search/?email=khalique.ahmed3%40gmail.com&phone=%2B923323602388&first_name=Khalique&last_name=Khan&middle_name=Ahmed&country=Pakistan&state=Sindh&city=Karachi&username=khalique.ahmed3%40gmail.com&age=29&key=CONTACT-PREMIUM-DEMO-7uz36yq8uj1j4hwf7a553wy6'
	echo 'https://api.pipl.com/search/?email=khalique.ahmed3%40gmail.com&phone=%2B923323602388&first_name=Khalique&last_name=Khan&middle_name=Ahmed&country=Pakistan&state=Sindh&city=Karachi&username=khalique.ahmed3%40gmail.com&age=29&key=
CONTACT-PREMIUM-DEMO-axv31y5v3lrj829zv80pt00j';
	
	//echo $query_string; die;
    curl_setopt($ch,CURLOPT_URL, 'https://api.pipl.com/search/?email=khalique.ahmed3%40gmail.com&phone=%2B923323602388&first_name=Khalique&last_name=Khan&middle_name=Ahmed&country=Pakistan&state=Sindh&city=Karachi&username=khalique.ahmed3%40gmail.com&age=29&key=
CONTACT-PREMIUM-DEMO-axv31y5v3lrj829zv80pt00j');
    // Set a referer
   curl_setopt($ch, CURLOPT_HEADER, FALSE);
    // Should cURL return or print out the data? (true = return, false = print)
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
   // curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    // Download the given URL, and return output
    $output = curl_exec($ch);
	$info=json_decode($output);
   $msg=$info;
	//$db->update("bitrix_id='$bitrixuid'","users","user_id=".(int)$user_arr['user_id']."");
    // Close the cURL resource, and free system resources
  curl_close($ch);
   return  $msg;
}
//CONTACT-PREMIUM-DEMO-7uz36yq8uj1j4hwf7a553wy6
$dataaa = getInfo('https://api.pipl.com/search/','email=khalique.ahmed3%40gmail.com&phone=%2B923323602388&first_name=Khalique&last_name=Khan&middle_name=Ahmed&country=Pakistan&state=Sindh&city=Karachi&username=khalique.ahmed3%40gmail.com&age=29&key=
CONTACT-PREMIUM-DEMO-axv31y5v3lrj829zv80pt00j');

var_dump($dataaa);

?>