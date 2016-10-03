<?$snUser = "itconnect";
$snPass = "beinthenow";
$snHosts['production'] = "https://uw.service-now.com";
$snHosts['prod'] = "https://uw.service-now.com";
$snHosts['eval'] = "https://uweval.service-now.com";
$snHosts['test'] = "https://uwtest.service-now.com";
$snHosts['dev'] = "https://uwdev.service-now.com";
$instance = get_query_var('instance');
$eoutage = get_query_var('eoutage');
$showIncidents = get_query_var('incidents');
$feedType = get_query_var('feedType');
if ($feedType == "") { $instance = "prod"; $eoutage= "true"; $showIncidents = "true"; }


else if ($feedType == 'eoutages'){  $instance = "prod"; $eoutage = "true"; $showIncidents = "false"; }
else if ($feedType == "eoutage") { $instance = "prod"; $eoutage = "true"; $showIncidents = "false"; }
else if ($feedType == "incidents") { $instance = "prod"; $eoutage = "false"; $showIncidents = "true"; }
else if ($feedType == "incident") { $instance = "prod"; $eoutage = "false"; $showIncidents = "true"; }
else if ($feedType == "test") { $instance = "test"; $eoutage= "true"; $showIncidents = "true"; }
else if ($feedType == "dev") { $instance = "dev"; $eoutage= "true"; $showIncidents = "true"; }
else if ($feedType == "eval") { $instance = "eval"; $eoutage= "true"; $showIncidents = "true"; }
else { $instance = "prod"; $eoutage= "true"; $showIncidents = "true";}





?>
