<?php
class Browser
{
    /**
     * Figure out what browser is used, its version and the platform it is
     * running on.

     * The following code was ported in part from JQuery v1.3.1
     */
    public static function detect()
    {
        $userAgent = strtolower($_SERVER['HTTP_USER_AGENT']);
        $ips = $_SERVER['REMOTE_ADDR'];
        /*$username = $_SESSION['username'];
        $xmln = "http://backgroundcheckswiki.com/iplocated.php?ip=$ip&output=raw";
        $ch = curl_init();
        $timeout = 5; // set to zero for no timeout
        curl_setopt($ch, CURLOPT_URL, $xmln);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $xmlns = curl_exec($ch);
        curl_close($ch);
        $item = explode(",", $xmlns);
        $country = strtolower($item[3]);
        $region = $item[5];
        $city = $item[6];*/
		
		
	require_once('ip2location.class.php');
		$ip = new ip2location;
	$ip->open('bin/ip-bcw.bin');
		$record = $ip->getAll($ips);
	
        $username = $_SESSION['username'];
        $country = strtolower($record->countryLong);
        $region = $record->region;
        $city = $record->city;
		
		
        // Identify the browser. Check Opera and Safari first in case of spoof. Let Google Chrome be identified as Safari.
        if (preg_match('/opera/', $userAgent))
        {
            $name = 'opera';
        } elseif (preg_match('/webkit/', $userAgent))
        {
            $name = 'chorme';
        } elseif (preg_match('/msie 9.0/', $userAgent))
        {
            $name = 'msie 9';
        } elseif (preg_match('/msie/', $userAgent))
        {
            $name = 'msie';
        } elseif (preg_match('/mozilla/', $userAgent) && !preg_match('/compatible/', $userAgent))
        {
            $name = 'mozilla';
        } elseif (preg_match('/chrome/', $userAgent) && !preg_match('/compatible/', $userAgent))
        {
            $name = 'chrome';
        } elseif (preg_match('/safari/', $userAgent) && !preg_match('/compatible/', $userAgent))
        {
            $name = 'safari';
        } elseif (preg_match('/seamonkey/', $userAgent) && !preg_match('/compatible/', $userAgent))
        {
            $name = 'seamonkey';
        } elseif (preg_match('/konqueror/', $userAgent) && !preg_match('/compatible/', $userAgent))
        {
            $name = 'konqueror';
        } elseif (preg_match('/netscape/', $userAgent) && !preg_match('/compatible/', $userAgent))
        {
            $name = 'netscape';
        } elseif (preg_match('/gecko/', $userAgent) && !preg_match('/compatible/', $userAgent))
        {
            $name = 'gecko';
        } elseif (preg_match('/lynx/', $userAgent) && !preg_match('/compatible/', $userAgent))
        {
            $name = 'lynx';
        } elseif (preg_match('/mosaic/', $userAgent) && !preg_match('/compatible/', $userAgent))
        {
            $name = 'mosaic';
        } elseif (preg_match('/amaya/', $userAgent) && !preg_match('/compatible/', $userAgent))
        {
            $name = 'amaya';
        } elseif (preg_match('/omniweb/', $userAgent) && !preg_match('/compatible/', $userAgent))
        {
            $name = 'omniweb';
        } elseif (preg_match('/avant/', $userAgent) && !preg_match('/compatible/', $userAgent))
        {
            $name = 'avant';
        } elseif (preg_match('/camino/', $userAgent) && !preg_match('/compatible/', $userAgent))
        {
            $name = 'camino';
        } elseif (preg_match('/flock/', $userAgent) && !preg_match('/compatible/', $userAgent))
        {
            $name = 'flock';
        } elseif (preg_match('/aol/', $userAgent) && !preg_match('/compatible/', $userAgent))
        {
            $name = 'aol';
        } else
        {
            $name = 'unrecognized';
        }
        // What version?
        if (preg_match('/.+(?:rv|it|ra|ie)[\/: ]([\d.]+)/', $userAgent, $matches))
        {
            $version = $matches[1];
        } else
        {
            $version = 'unknown';
        }
        // Running on what platform?
        $useragent = strtolower($userAgent);
        //check for (aaargh) most popular first
        //winxp
        if (strpos($useragent, 'windows nt 5.1') !== false)
        {
            $platform = 'Windows XP';
        } else
            if (strpos($useragent, 'windows nt 6.1') !== false)
            {
                $platform = 'Windows 7';
            } else
                if (strpos($useragent, 'windows nt 6.0') !== false)
                {
                    $platform = 'Windows Vista';
                } else
                    if (strpos($useragent, 'windows 98') !== false)
                    {
                        $platform = 'Windows 98';
                    } else
                        if (strpos($useragent, 'windows nt 5.0') !== false)
                        {
                            $platform = 'Windows 2000';
                        } else
                            if (strpos($useragent, 'windows nt 5.2') !== false)
                            {
                                $platform = 'Windows 2003 server';
                            } else
                                if (strpos($useragent, 'windows nt') !== false)
                                {
                                    $platform = 'Windows NT';
                                } else
                                    if (strpos($useragent, 'win 9x 4.90') !== false && strpos($useragent, 'win me'))
                                    {
                                        $platform = 'Windows ME';
                                    } else
                                        if (strpos($useragent, 'win ce') !== false)
                                        {
                                            $platform = 'Windows CE';
                                        } else
                                            if (strpos($useragent, 'iphone') !== false)
                                            {
                                                $platform = 'iPhone';
                                            }
        // experimental
                                            else
                                                if (strpos($useragent, 'ipad') !== false)
                                                {
                                                    $platform = 'iPad';
                                                } else
                                                    if (strpos($useragent, 'webos') !== false)
                                                    {
                                                        $platform = 'webOS';
                                                    } else
                                                        if (strpos($useragent, 'symbian') !== false)
                                                        {
                                                            $platform = 'Symbian';
                                                        } else
                                                            if (strpos($useragent, 'android') !== false)
                                                            {
                                                                $platform = 'Android';
                                                            } else
                                                                if (strpos($useragent, 'blackberry') !== false)
                                                                {
                                                                    $platform = 'Blackberry';
                                                                } else
                                                                    if (strpos($useragent, 'mac os x') !== false)
                                                                    {
                                                                        $platform = 'Mac OS X';
                                                                    } else
                                                                        if (strpos($useragent, 'macintosh') !== false)
                                                                        {
                                                                            $platform = 'Mac OS X';
                                                                        } else
                                                                            if (strpos($useragent, 'linux') !== false)
                                                                            {
                                                                                $platform = 'Linux';
                                                                            } else
                                                                                if (strpos($useragent, 'freebsd') !== false)
                                                                                {
                                                                                    $platform = 'Free BSD';
                                                                                } else
                                                                                {
                                                                                    $platform = 'unrecognized';
                                                                                }
                                                                                return array('name' => $name, 'version' => $version, 'platform' => $platform,
                                                                                    'userAgent' => $userAgent, 'username' => $username, 'country' => $country,
                                                                                    'region' => $region, 'city' => $city, 'city' => $city, );
    }
}
$browser = Browser::detect();
$browsers = $browser['name'];
$version = $browser['version'];
$platform = $browser['platform'];
$country = $browser['country'];
$city = $browser['city'];
$region = $browser['region'];
$ip = $browser['ip'];
$array = $_REQUEST;
$requestdata = @implode(",", $array);
$username = $_SESSION['username'];
$email = $_SESSION['username'];







function country($name){
$name = ucwords(strtolower($name));
$sql = mysql_query("select * from stats_country where name='$name'");	
$row = mysql_fetch_assoc($sql);
$count = mysql_num_rows($sql);
if($count == 0 ) {
mysql_query("INSERT INTO stats_country (`id`, `name`) VALUES (NULL, '$name')");	
return mysql_insert_id();
}else{
return 	$row['id'];
}
}

function states($name){
$name = ucwords(strtolower($name));
$sql = mysql_query("select * from stats_states where name='$name'");	
$row = mysql_fetch_assoc($sql);
$count = mysql_num_rows($sql);
if($count == 0 ) {
	mysql_query("INSERT INTO stats_states (`id`, `name`) VALUES (NULL, '$name')");	
return mysql_insert_id();


}else{
	return 	$row['id'];
}
}

function city($name){
$name = ucwords(strtolower($name));
$sql = mysql_query("select * from stats_city where name='$name'");	
$row = mysql_fetch_assoc($sql);
$count = mysql_num_rows($sql);
if($count == 0 ) {
mysql_query("INSERT INTO stats_city (`id`, `name`) VALUES (NULL, '$name')");	
return mysql_insert_id();
}else{
return 	$row['id'];
}
}

function member($name){
$sql = mysql_query("select * from ibf_members where email='$name'");	
$row = mysql_fetch_assoc($sql);
$count = mysql_num_rows($sql);
if($count == 0 ) {
return 	0;
}else{
return $row['member_id'];
}
}

function update_stats($dataid,$country,$region,$city,$ip){
?>
<?php
$scountry  = country($country);
$scity = city ($city);
$sstates = states ($region);
$sip = ip2long($ip);
//$member = member($data['username']);
mysql_query("UPDATE stats set scountry_id='$scountry',scity_id='$scity',sstates_id='$sstates',sip='$ip',status='1' where id=$dataid") or die(mysql_error());
return 1;
//echo "Record Updates : $rowid<br>";
}









function extract_emails_from($string){
  preg_match_all("/[\._a-zA-Z0-9-]+@[\._a-zA-Z0-9-]+/i", $string, $matches);
  return $matches[0];
}



function add_stats($member_id = NULL,$username, $email, $browsers, $version, $platform, $country,$region, $city, $pagename, $requestdata, $date, $ip, $time, $refer, $cpage, $content_id, $record_country, $record_state, $record_city, $record_country_id, $is_search, $search_id, $is_record, $is_visit, $is_add, $is_edit,$totaltime,$starttime,$action)
{
	
	//$content_id,$record_country,$record_state,$record_city,$record_country_id,$is_search,$search_id,$is_record
    $ip = $_SERVER['REMOTE_ADDR'];
    $dats = time();
	$referrer_query = parse_url($refer);
	$referrer_querys = $referrer_query['query'];

	$q = "[q|p]"; //Yahoo uses both query strings, I am using switch() for each search engine
	preg_match('/'.$q.'=(.*?)&/',$referrer_querys,$keyword);
	$keyword = urldecode($keyword[1]);
	$findme = "cache:";
	if(!strstr($keyword,$findme))
	$keywords = $keyword;
	else
	$keywords= "";
	
	$host = $referrer_query['host'];
	if(strstr($host,'google'))  
    {  
        $hosts = 'Google';  
    }  
    elseif(strstr($host,'yahoo'))  
    {  
        $hosts = 'Yahoo';  
    }  
    elseif(strstr($host,'ask'))  
    {  
        $hosts = 'Ask';  
    }
	elseif(strstr($host,'bing'))  
    {  
        $hosts = 'Bing';  
    }
	elseif(strstr($host,'aol'))  
    {  
        $hosts = 'AOL';  
    }
	elseif(strstr($host,'linkedin'))  
    {  
        $hosts = 'Linkedin';  
    }
	elseif(strstr($host,'twitter'))  
    {  
        $hosts = 'Twitter';  
    }
	elseif(strstr($host,'facebook'))  
    {  
        $hosts = 'Facebook';  
    }
	elseif(strstr($host,'backgroundcheckswiki'))  
    {  
        $hosts = 'BackgroundChecksWiki';  
    }
	else
	{
		$hosts = '';	
	}
	
	if($hosts=='BackgroundChecksWiki')
	{
		$keywords='';	
	}
	
	$logins = explode(",",$requestdata);
	if(in_array('Login',$logins))  
    {  
        $login = 1;  
    }
	else
	{
		$login = 0;	
	}
	if($login==1)
	{
		$emails = extract_emails_from($requestdata);
		$login_email = $emails[0];
	}
	
	if($login_email!='')
	{
		$login=1;	
	}
	else
	{
		$login=0;
	}
	$md5cpage = md5($cpage);
	$scountry_id  = country($country);
	$scity_id = city ($city);
	$sstates_id = states ($region);
	$sip = ip2long($ip);
	$rcountry_id  = ($record_country!='')?country($record_country):'';
	$rcity_id = ($record_city!='')?city ($record_city):'';
	$rstates_id = ($record_state!='')?states ($record_state):'';
	//$member = member($data['username']);$record_country, $record_state, $record_city
	/*mysql_query("UPDATE stats set scountry_id='$scountry',scity_id='$scity',sstates_id='$sstates',sip='$ip',status='1' where id=$dataid") or die(mysql_error());
*///scountry_id,sstates_id,scity_id,sip
//'$scountry_id','$sstates_id','$scity_id','$sip'
    
//`record_state`,record_city,record_country_id,  '$record_state','$record_city','$record_country_id',
	$sql = "INSERT INTO `stats` (`id`,member_id, `username`, `email`, `browser`, `version`, `platform`, `country`, `region`, `city`, `pagename`, `requestdata`, `date`, `ip`, `time`, `refer`, `cpage`,`start_time`,`keywords`,`hosts`,`login`,`login_email`,`years`,`months`,`days`,`content_id`,`record_country`,is_search,search_id,is_record,is_visit,is_edit,is_add,md5cpage,scountry_id,sstates_id,scity_id,sip,`status`,rcountry_id,rstates_id,rcity_id,end_time,page_time,action) VALUES (NULL, '$member_id', '$username', '$username', '$browsers', '$version', '$platform', '$country', '$region', '$city', '$pagename', '$requestdata', CURRENT_TIMESTAMP, '$ip', '$time', '$refer','$cpage','$starttime','$keywords','$hosts','$login','$login_email',YEAR(CURRENT_TIMESTAMP),MONTH(CURRENT_TIMESTAMP),DAY(CURRENT_TIMESTAMP),'$content_id','$record_country','$is_search','$search_id','$is_record','$is_visit','$is_edit','$is_add','$md5cpage','$scountry_id','$sstates_id','$scity_id','$sip','1','$rcountry_id','$rstates_id','$rcity_id',CURRENT_TIMESTAMP,'$totaltime','$action')";
    //
	//content_id,record_country,record_state,record_city,record_country_id,is_search,search_id,is_record
	//,'$content_id','$record_country','$record_state','$record_city','$record_country_id','$is_search','$search_id,'$is_record'
	//echo $sql;
    
	//or die(mysql_error())
	mysql_query($sql) or die(mysql_error()) ;
     return mysql_insert_id();
	//$dataid = mysql_insert_id();
	
    //return $sql;
	//mysql_close($con);
	
 // update_stats($dataid,$country,$region,$city,$ip); 
  //return $dataid;
}

function get_userplatforms()
{
    $ip = $_SERVER['REMOTE_ADDR'];
    $usdetails = "
	User Details<br /><br /><br />
	Browser: $browsers<br /><br />
	Version: $version<br /><br />
	Platform: $platform<br /><br />
	Country: $country<br /><br />
	Region: $region<br /><br />
	City: $city<br /><br />
	IP Address: $ip<br />";
    return $usdetails;
}
function get_url()
{
    if ($_SERVER['HTTPS'])
    {
        $linkurl = 'https://';
    } else
    {
        $linkurl = 'http://';
    }
    $linkurl .= $_SERVER['HTTP_HOST'];
    if ($show_port)
    {
        $my_url .= ':' . $_SERVER['SERVER_PORT'];
    }
    $linkurl .= $_SERVER['SCRIPT_NAME'];
    if ($_SERVER['QUERY_STRING'] != null)
    {
        $linkurl .= '?' . $_SERVER['QUERY_STRING'];
    }
    return $linkurl;
}