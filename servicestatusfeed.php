<?
date_default_timezone_set('America/Los_Angeles');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); 
   require('status-feed-functions.php');


 header("Content-Type: application/rss+xml; charset=ISO-8859-1");
 $rssfeed = '<?xml version="1.0" encoding="ISO-8859-1"?>';
    $rssfeed .= '<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">';
    $rssfeed .= '<channel>';
    $rssfeed .='<atom:link href="https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].'" rel="self" type="application/rss+xml" />';
    $rssfeed .= '<title>UW-IT eOutages and High Priority Incidents</title>';
    $rssfeed .= '<link>https://itconnect.uw.edu/servicestatus</link>';
    $rssfeed .= '<description>UW-IT eOutages and High Priority Incidents</description>';
    $rssfeed .= '<language>en-us</language>';
   $rssfeed .='<pubDate>'.gmdate(DATE_RSS)."</pubDate>";
$itemArray = getIncidentsAndeOutages();
	foreach ($itemArray as $item) {
		$rssfeed .= "<item>";
		$rssfeed .="<title>".$item['service']." (".$item['type'].")</title>";
		$rssfeed .="<description>".$item['title']."</description>"; 
		if ($item['type'] == "eOutage") { $rssfeed .= "<link>https://www.washington.edu/cac/outages</link>";}
		else { $rssfeed .= "<link>https://itconnect.uw.edu/servicestatus</link>"; }
		$time = new DateTime($item['time']);
		$time = gmdate(DATE_RSS, $time->getTimestamp());
		$rssfeed .= "<pubDate>".$time."</pubDate>";
		$rssfeed .= "</item>";	
}


 $rssfeed .= '</channel>';
    $rssfeed .= '</rss>';

echo $rssfeed;

