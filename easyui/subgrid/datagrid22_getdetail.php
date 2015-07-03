<?php

	include 'conn.php';
	
	$itemid = mysql_real_escape_string($_REQUEST['itemid']);
	
	$rs = mysql_query("select * from lineitem where itemid='$itemid'");
	$items = array();
	while($row = mysql_fetch_object($rs)){
		array_push($items, $row);
	}
	echo json_encode($items);


?>
