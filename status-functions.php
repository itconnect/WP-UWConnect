<?php
/* Functions to scrape the eOutage page and return whether or not there is currently an eOutage */


function check_e_outage() {
if ( get_option('uwc_SN_URL') != "https://uw.service-now.com") { 
	$url = "https://eoutage-test.uw.edu";
}

  $options = Array(
            CURLOPT_RETURNTRANSFER => TRUE,  // Setting cURL's option to return the webpage data
            CURLOPT_FOLLOWLOCATION => TRUE,  // Setting cURL to follow 'location' HTTP headers
            CURLOPT_AUTOREFERER => TRUE, // Automatically set the referer where following 'location' HTTP headers
            CURLOPT_CONNECTTIMEOUT => 120,   // Setting the amount of time (in seconds) before the request times out
            CURLOPT_TIMEOUT => 120,  // Setting the maximum amount of time for cURL to execute queries
            CURLOPT_MAXREDIRS => 10, // Setting the maximum number of redirections to follow
            CURLOPT_USERAGENT => "Mozilla/5.0 (X11; U; Linux i686; en-US; rv:1.9.1a2pre) Gecko/2008073000 Shredder/3.0a2pre ThunderBrowse/3.2.1.8",  // Setting the useragent
            CURLOPT_URL => $url, // Setting cURL's URL option with the $url variable passed into the function
        );
         
        $ch = curl_init();  // Initialising cURL 
        curl_setopt_array($ch, $options);   // Setting cURL's options using the previously assigned array data in $options
        $data = curl_exec($ch); // Executing the cURL request and assigning the returned data to the $data variable
        curl_close($ch);    // Closing cURL 
   
//	$status = scrape_between($data, "<div class=\"status\">", "</body>");
  $status = scrape_between($data, "<div class=\"status\">", "</div></div>");
	if (!strpos($data, "All systems operating normally")) {

//	if (strpos($data, "not operating normally")) {
    return $status;
	}
	else { return false; }
}

  function scrape_between($data, $start, $end){
       $data = stristr($data, $start); // Stripping all data from before $start
        $data = substr($data, strlen($start));  // Stripping $start
        $stop = stripos($data, $end);   // Getting the position of the $end of the data to scrape
        $data = substr($data, 0, $stop);    // Stripping all data from after and including the $end of the data to scrape
        return $data;   // Returning the scraped data from the function
    }

  function parse_eoutage($msg) {
	$data = substr($msg, 45); //strip Updated text


$cutoff =  stripos($data, "For accurate and up-to-date information related to system incidents,");
if ($cutoff) { $data = substr($data, 0, stripos($data, "For accurate and up-to-date information related to system incidents,"));
}
$data = str_replace('view previous messages for this outage','', $data);
$data = nl2br($data);
//$data = str_replace('. ','.<br>',$data);
//$data = str_replace('https://', '<br>https://', $data);
$data = str_replace('Next update:','<br><br>Next update:', $data);
//$data = str_replace('No further updates','No further updates', $data);
return $data;

  }
function htmlize($text){
 $text =preg_replace('/(?mi)([^"\'])((http|ftp|https):\/\/([_a-zA-z0-9\-]+\.)+[_a-zA-z0-9\-]{2,5}(\/[_a-zA-z0-9\-\.~]*)*(\?[_a-zA-z0-9\-\.~&=;]*)?)/','\1<a href="\2">\2</a>', " ".$text );
  $text = str_replace("  ", "&nbsp;&nbsp;", nl2br($text));
   return($text);
   }

?>
