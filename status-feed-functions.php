<?php



include('eoutage-functions.php');


function getIncidentsAndeOutages() {
include ('config.php');

 $hash = base64_encode( get_option('uwc_SN_USER') . ':' . get_option('uwc_SN_PASS') );
  $args = array(
      'headers' => array(
          'Authorization' => 'Basic ' . $hash,
      ),
      'timeout' => 25,
  );



  $dom = new DOMDocument();
  $dashboardArray = [];
  $eOutage = check_e_outage2();
  if ($eOutage) {
    $dom->loadHTML($eOutage);
    $titleArray = array();
    $dateArray = array();
    $contentArray = array();
    $eOutageTitles = $dom->getElementsByTagName('h4');
    $eOutageDates = $dom->getElementsByTagName('em');
    $eOutageContent = $dom->getElementsByTagName('div');
    foreach ($eOutageTitles as $title) {
        $titleArray[] = $title->nodeValue;
    }
    foreach ($eOutageDates as $date) {
       $dateArray[] = $date->nodeValue;
    }
   foreach ($eOutageContent as $content) {
      $contentArray[] = parse_eoutage2($content->textContent);
   }
   for ($i=0; $i < count($titleArray) ; $i++) {
	$dashboardArray[$i]['type']="eOutage";
	$dashboardArray[$i]['title'] = $contentArray[$i];
	$dashboardArray[$i]['service']=$titleArray[$i];
	$dashboardArray[$i]['time']=str_replace(' at ',' ',substr($dateArray[$i],9));		
	}
  }
  if ($showIncidents != "false" ) {
  $JSON = get_SN2('/incident_list.do?JSONv2&sysparm_query=active%3Dtrue%5EstateNOT%20IN6%2C7%5Epriority%3D2%5EORpriority%3D1%5Eu_sector%3DUW%5EORu_sector%3D%5Eparent_incident=NULL^cmdb_ci.u_organizational_group%3D51af60a86f2a110054aafd16ad3ee4d0&displayvalue=true', $args);
  $IDJSON =  get_SN2('/incident_list.do?JSONv2&sysparm_query=active%3Dtrue%5EstateNOT%20IN6%2C7%5Epriority%3D2%5EORpriority%3D1%5Eu_sector%3DUW%5EORu_sector%3D%5Eparent_incident%3DNULL^cmdb_ci.u_organizational_group%3D51af60a86f2a110054aafd16ad3ee4d0^ORDERBYcmdb_ci', $args);
  if(!$JSON) {  }
  elseif(empty($JSON->records)) {  }
  $sn_data = array();
      
   foreach ( $IDJSON->records as $record ) {
          if( !isset( $sn_data[$record->cmdb_ci] ) ) { 
                  $sn_data[$record->cmdb_ci] = array();
                  unset($first);
              }
	   else {
                        $first = $sn_data[$record->cmdb_ci][1];  //cannot assume order. load current first for ci
              }
              $create = $record->sys_created_on;
              if( !isset( $first ) ) {
                  $first = $create;
              }
              if($create < $first) {
                  $first = $create;
              }
              $sn_data[$record->cmdb_ci][] = $record;
              $sn_data[$record->cmdb_ci][] = $first;

      	}	
      	$classes = array();
      	foreach ($sn_data as $ci) {
        	$serviceid = $ci[0]->cmdb_ci;
        	$servJSON = get_SN2('/cmdb_ci_list.do?JSONv2&sysparm_query=u_active!%3Dfalse%5Esys_id%3D' . $serviceid . '&displayvalue=true', $args);
       		$class = $servJSON->records[0]->sys_class_name;
        	$classes[] = $class;
	}

      	if ( !empty( $JSON->records ) ) { 
        	  $sn_data = array();
          	  foreach( $JSON->records as $record ) {
              		if( !isset( $sn_data[$record->cmdb_ci] ) ) { 
                  		$sn_data[$record->cmdb_ci] = array();
                  		unset($first);
              		}
	      		else { 
				$first = $sn_data[$record->cmdb_ci][1];  //cannot assume order. load current first for ci
              		}		
	      		$create = $record->sys_created_on;
              		if( !isset( $first ) ) {
                  		$first = $create;
              		}
              		if($create < $first) {
               		      $first = $create;
              		}
              		$sn_data[$record->cmdb_ci][] = $record;
	      		$sn_data[$record->cmdb_ci][] = $first;

          	}
	        ksort($sn_data, SORT_STRING | SORT_FLAG_CASE); //sort alphabetically by ci name

              # put the services into a single ordered list
                $i = 0;
                foreach( $sn_data as $ci) {
			  $update_time = new DateTime();
		  	  $current_update_time = new DateTime();
		  	  $count = 0;
		  	  foreach ($ci as $incident) { //count incidents for ci
				if (!is_string($incident)) {
					$current_update_time = DateTime::createFromFormat("m-d-Y H:i:s", $incident->sys_updated_on);                            	 if ($count == 0 || $update_time < $current_update_time) { 											$update_time = $current_update_time; 
					}
					$count++; 
			        }
		  	} 
                  	$class = $classes[$i];
                  	$service = array_search($ci, $sn_data);
                  // handle the case of blank services and switches who's 'name' is a sequence of 5 or more numbers
			if ($service !== '' ) {
				$time = end($ci);
                          	foreach( $ci as $incident ) {
                            		if (!is_string($incident)) {
						$updateTime = str_replace("-","/",$incident->sys_updated_on);
						$updateTime = DateTime::createFromFormat('m/d/Y H:i:s',$updateTime);
						$newIncident = array (
							'service' => $service,
							'type' => $class,
							'title' => $incident->short_description,
							'time' => $updateTime->format('n/d/Y h:i:s a')
						);
						$dashboardArray[] = $newIncident;
                            		}	
                          	}
               		}
               $i++;
            }
	}
	// If there are eOutages or Incidents, sort them by created date and return them.

	}
	if (count($dashboardArray) > 0) {
		foreach ($dashboardArray as $key=>$row) {
			$dashArray[$key] = strtotime($row['time']);
		}
 		array_multisort($dashArray,SORT_DESC,$dashboardArray);
		//print json_encode($dashboardArray);
		//return json_encode($dashboardArray);
		return $dashboardArray;
	}
	else { return false; }
}

//Builds a request to Service Now and returns results as a JSON object.
function get_SN2($url, $args) {
	include('config.php');
	$currentURL = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	$snHost = $snHosts['production']; // By default use production
	if ( $instance== "test") { $snHost = $snHosts['test']; }
	else if ($instance == "eval") { $snHost = $snHosts['eval']; }
	else if ($instance == "dev") { $snHost = $snHosts['dev']; } 
    	$url = $snHost . $url;
     	$process = curl_init($url);
	curl_setopt($process, CURLOPT_USERPWD, $snUser . ":" . $snPass);
	curl_setopt($process, CURLOPT_TIMEOUT, 30);
	curl_setopt($process, CURLOPT_POST, 0);
	curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
	$return = curl_exec($process);
	curl_close($process);
   	$json = json_decode( $return ); 
   	return $json;
}
?>
