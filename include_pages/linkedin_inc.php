<?php
	$fname=$doc['FirstName'];
	$lName=$doc['LastName'];
?>

<div class="innercontent" >

<div id="LKD">
<?php
if(($lName !='') || ($fname !='')){
function Querye($url){
      $div = '';
      $ch = curl_init($url);
      curl_setopt($ch, CURLOPT_URL, $url); 
      curl_setopt($ch, CURLOPT_HEADER, 1);
      curl_setopt($ch, CURLOPT_HEADER, 1);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
      $HTMLtext = curl_exec($ch); 
      curl_close($ch); 

      $regex_pattern =  '/<div *id=\"content\".*>(.*)<\/div>/isU';

      preg_match_all(
          $regex_pattern,
          $HTMLtext, 
          $matches, 
          PREG_SET_ORDER
      );
        foreach($matches as $match) {
            $div = $div .$match[0];
       }
      return $div;
}
    $url = "http://www.linkedin.com/pub/dir/?first=$fname+&last=$lName&search=Go";
    $html = Querye($url);

    $dome = new domDocument; 
    @$dome->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', "UTF-8")); 
    $dome->preserveWhiteSpace = false;
    $ol = $dome->getElementsByTagName('ol')->item(0)->nodeValue;
    if(gettype($ol)!=='NULL'){
    $lis = $dome->getElementsByTagName('ol')->item(0)->getElementsByTagName('li');
        $liCount = 0;
        $disp='block';
        foreach ($lis  as $li) {
            
            $uInfo = $li->getElementsByTagName('h2')->item(0);
            if($uInfo->nodeValue!=''){
                echo '<div style="display:'.$disp.';" class="container">';
                $link = $uInfo->getElementsByTagName('a')->item(0);
                $as = $li->getElementsByTagName('a');
                $image ='default_thumb.png';
                foreach ($as  as $a) {
                    if($a->getAttribute("class") == "profile-photo"){
                        $image = $a->getElementsByTagName('img')->item(0)->getAttribute("src");
                    }
                    if($a->getAttribute("class") == "btn-primary"){
                        $fpLink = $a->getAttribute("href");
                    }
                    
                }
                if($image!='') echo '<div style="float:left; width:90px;"><img height="80" width="80" src="'.$image.'" /></div><div style="float:right;width:550px;">';
                echo '<div><a style="float:left;" href="'.$link->getAttribute("href").'" target="_blank">'.$uInfo->nodeValue.'</a><a class="lkdvp" style="float:right;" href="'.$fpLink.'" target="_blank" >View Full Profile</a><div class="clear"></div></div><ul>';
                $dls = $li->getElementsByTagName('dl');
                $tmp=0;
                foreach ($dls  as $dl) {
                    $dts = $dl->getElementsByTagName('dt');
                    $itm=0;
                    $title = '';
                    foreach ($dts  as $dt) {
                        if($tmp>0) $title = '<span class="title">'.$dt->nodeValue.'</span>';
                            $desc = trim($dl->getElementsByTagName('dd')->item($itm)->nodeValue);
                            $desc = str_replace('  ',"",$desc);
                        if(strlen($desc)>150){
                            $desc = substr($desc, 0, 150)."...";	
                        }		
                        echo '<li>'.$title.' '.$desc.'</li>';
                        $itm=$itm+1;
                    }					
                    $tmp=$tmp+1;
                }
                echo '</ul></div>';
            echo '<div class="clear"></div></div>';
                $liCount = $liCount+1;
                if($liCount > 9) $disp='none';
            }
        }
        if(($liCount > 9)&& !isset($isShow)) echo '<div id="srBTN" align="center"><a class="srBtn" href="javascript:void(0)" onclick="showMoreResults('."'LKD','container','srBTN'".')">Show More...</a><div class="clear"></div></div>';
        }else{ ?>
            <h2 align="center">No Record Fonud</h2>
        <?php } 
}else{ ?>
    <div class="notification info"><h2 align="center">No Record Fonud</h2></div>
<?php } ?>
<div class="clear"></div>
</div>    
<div class="clear"></div>
</div>
