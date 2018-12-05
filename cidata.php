<?
$seen_ci = array();
$ci_array = array();
$uwGold = "#85754D";

$colors = array("#000000", "#FFFFFF",$uwGold); //Black, white, and UW Gold


/*$JSONDATES = get_SN4("/change_request_list.do?JSONv2&sysparm_query=approval%3Dapproved%5Etype!%3DRoutine", $args);

foreach ($JSONDATES->records as $thisci) {
if (array_search($thisci->cmdb_ci, $seen_ci)) { continue; }
else { array_push($seen_ci, $thisci->cmdb_ci); }
}

print_r($seen_ci);
*/
/*
$JSONCINAMES = get_SN3("/cmdb_ci_list.do?JSONv2&sysparm_query=active=true", $args);
foreach ($JSONCINAMES as $thisci) {
 $color = make_color($colors);
 $colors[$thisci->sys_id] = $color;

}

print json_encode($colors);
*/

$seen_ci = array();
$ci_array = array();
$uwGold = "#85754D";
$colors_ci = array();
$colors = array("#000000", "#FFFFFF",$uwGold); //Black, white, and UW Gold



$CHANGECI = get_SN5("/change_request_list.do?JSONv2&sysparm_query=approval%3Dapproved%5Etype!%3DRoutine", $args);
print (count($CHANGECI->records));


$THISCI = get_SN5("/cmn_schedule_span_list.do?JSONv2&sysparm_query=schedule%3Da41605ac6fb0f100328c8bec5d3ee465%5E", $args);
print count($THISCI->records);

/*
foreach ($JSONDATES->records as $thisci) {
print $thisci->cmdb_ci."<br>";
if (array_search($thisci->cmdb_ci, $seen_ci)) { continue; }
else { array_push($seen_ci, $thisci->cmdb_ci); }

}
*/

foreach ($seen_ci as $ci) {
 $color = make_color($colors);
 $colors_ci[$ci] = $color;
array_push($colors, $color);
}


//print count($seen_ci);
//print json_encode($colors_ci);


function make_color($colors) {
    do {
         $color = sprintf("#%06x",rand(0,16777215));
    } while (array_search($color, $colors));
    return $color;
}


function get_SN5($url, $args) {
        $currentURL == "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

$snHost = "https://uw.service-now.com";
    $snUser = "itconnect";
    $snPass = "beinthenow";
      $url = $snHost . $url;
        $process = curl_init($url);
        curl_setopt($process, CURLOPT_USERPWD, $snUser . ":" . $snPass);
        curl_setopt($process, CURLOPT_TIMEOUT, 60);
        curl_setopt($process, CURLOPT_POST, 1);
        curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
        $return = curl_exec($process);
        curl_close($process);
        $json = json_decode( $return );
        return $json;
}
?>
