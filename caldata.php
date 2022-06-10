<?
//8ae178ee6fc47500328c8bec5d3ee4c3
include ('config.php');
$start = $_GET['start'];
$end = $_GET['end'];
$ci = $_GET['ci'];
if (!$start) { $start = "2017-01-01"; }
if (!$end) { $end = "2017-12-31"; }
if (validateDate($start) && validateDate($end)) {
if (!$ci) { $ci = ""; }
else { $ci="%5Ecmdb_ci%3D".$ci; }


$events = array();
$uwGold = "#85754D";
$colors = array("#000000", "#FFFFFF",$uwGold); //Black, white, and UW Gold


//Get list of changes from UW Connect
$JSONDATES = get_SN3("/change_request_list.do?JSONv2&sysparm_query=approval%3Dapproved%5Estart_date%3E%3Djavascript%3Ags.dateGenerate('".$start."','00%3A00%3A00')%5Eend_date%3C%3Djavascript%3Ags.dateGenerate('".$end."','23%3A59%3A59')%5Etype!%3DRoutine%5Eu_cab!%3D81711d2a13dffa403156bb722244b0c1^u_sector=^ORu_sector=UW".$ci, $args);

foreach ($JSONDATES->records as $event) {
    $number = $event->number;
    $title = $event->short_description." ".$number;
    $url = 'https://uw.service-now.com/fro.do?record='.$number;
    $startTime = $event->start_date;
    $time = strtotime($startTime." UTC");
    $startTime = date("Y-m-d\TH:i:s", $time);
    $endTime = $event->end_date;
    $time = strtotime($endTime." UTC");
    $endTime = date("Y-m-d\TH:i:s", $time);
/*if (array_key_exists($event->u_cab, $colors)) { $color = $colors[$event->cmdb_ci]; }
    else {
        $color = make_color($colors);
        $colors[$event->u_cab] = $color;
    }*/
   $type = $event->type;
   if ($type == "Comprehensive") { $color = "blue"; }
   else { $color= "red"; }

    $oneEvent = array(
        "title" => $title,
        "start" => $startTime,
        "end" => $endTime,
        "url" => $url,
        "color" => $color,
        "allDay" => false);
    array_push($events, $oneEvent);
}

//Get list of Make No Changes periods from UW Connect
$JSONMNC = get_SN3("/cmn_schedule_span_list.do?JSONv2&sysparm_query=schedule%3Da41605ac6fb0f100328c8bec5d3ee465%5E", $args);
foreach ($JSONMNC->records as $mncday) {
//$title = "Make No Changes";
    $title = $mncday->name;
    $startTime = $mncday->start_date_time;
    $endTime = $mncday->end_date_time;
    $oneEvent = array(
        "title" => $title,
        "start" => $startTime,
        "end" => $endTime,
	"timezone" => "America/Los_Angeles",
        "color"=>'black',
        "allDay" => false);
    array_push($events, $oneEvent);
}

//Access UW Calendar RSS Feed for Quarter start days
    $uwCalendar = "http://www.trumba.com/calendars/sea_campus.rss?filterview=No+Ongoing+Events&filter5=_409198_&filterfield5=30051&search=instruction%20begins&months=60&startdate=".date('Y')."0101";
    $feed = implode(file($uwCalendar));
    $xml = simplexml_load_string($feed);
    $json = json_encode($xml);
    $array = json_decode($json,TRUE);
    foreach ($array['channel']['item'] as $quarterday) {
        if (startsWith($quarterday['title'], "Instruction Begins for")) {
          $qDate = str_replace("/","-",explode(" ",$quarterday['category'])[0]);
          $oneEvent = array(
             "title" => $quarterday['title'],
             "start" => $qDate,
             "color"=> $uwGold,
             "allDay" => true);
          array_push($events, $oneEvent);
    }
    else { continue; }
}

echo json_encode($events);

}
else { return false; }


function make_color($colors) {
    do {
         $color = sprintf("#%06x",rand(0,16777215));
    } while (array_search($color, $colors));
    return $color;
}

function startsWith($haystack, $needle)
{
     $length = strlen($needle);
          return (substr($haystack, 0, $length) === $needle);
}

function validateDate($date, $format = 'Y-m-d')
{
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}


function get_SN3($url, $args) {{
        $currentURL == "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $snHost = "https://uw.service-now.com";
	    $snUser = "itconnect";
	    $snPass = $snPass;
	    $url = $snHost . $url;
        $process = curl_init($url);
        curl_setopt($process, CURLOPT_USERPWD, $snUser . ":" . $snPass);
        curl_setopt($process, CURLOPT_TIMEOUT, 30);
        //curl_setopt($process, CURLOPT_POST, 1);
        curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
        $return = curl_exec($process);
        curl_close($process);
        $json = json_decode( $return );
        return $json;
}
?>
