<?php

include("serverInfo.php");

$queryData = $_POST['dbQuery'];   // Database Query, Ex: select * from tableName
$queryType = $_POST['queryType'];  // Specify Query Type, Ex: I|U|D|S

$r = mysql_connect($host, $user, $pass);

if (!$r) {
    //echo "Could not connect to server</br>";
    echo json_encode(array("message" => "Could not connect to server", "error" => mysql_error(), "status" => "NO"));
    trigger_error(mysql_error(), E_USER_ERROR);
} else {
    //echo "Connection established</br>"; 
}

$r2 = mysql_select_db($db);

if (!$r2) {
    //echo "Cannot select database</br>";
    echo json_encode(array("message" => "Cannot select database", "error" => mysql_error(), "status" => "NO"));
    trigger_error(mysql_error(), E_USER_ERROR); 
} else {
    //echo "Database selected</br>";
}

$query = array();
$query[] = $queryData;

$results = array();
foreach($query as $key => $val)
{
	$rs = mysql_query(stripcslashes($val));
	
	if ($queryType == "S") {
		if (!$rs) {
		    //echo "Could not execute query: $query";
		    echo json_encode(array("message" => "Could not execute query: $query", "error" => mysql_error(), "status" => "NO"));
	    	trigger_error(mysql_error(), E_USER_ERROR); 
		} 
	}

	if ($queryType == "S") {
		$user = array();
		while ($row = mysql_fetch_assoc($rs)) {
		    $user[] = $row;
		}
		
		$results = array("result" => $user, "status" => "YES");
		//$results = array("Result".$key => $user);
	} 
	else if ($queryType == "I" || $queryType == "U") 
	{
		if ($rs) {
			$results = array("message" => "Success", "error" => mysql_error(), "status" => "YES");
		} else {
			$results = array("message" => "Failed", "error" => mysql_error(), "status" => "NO");
		}
	} 
	else if ($queryType == "D") 
	{
		if (mysql_affected_rows() > 0) {
			$results = array("message" => "Success", "error" => mysql_error(), "status" => "YES");
		} else {
			$results = array("message" => "Failed", "error" => mysql_error(), "status" => "NO");
		}
	} 
	else 
	{
		$results = array("message" => "Please provide query type", "error" => mysql_error(), "status" => "NO");
	}
}

echo $final = json_encode($results);

mysql_close();

?>
