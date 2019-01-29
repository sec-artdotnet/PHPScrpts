<?php

if(isset($_POST['ip'])) {
	$ports = array(21, 22, 23, 25, 53, 80, 110, 135, 137, 139, 1433, 1434);
	$result = array();

	foreach($ports as $port) {
		if($scn = fsockopen($_POST['ip'], $port, $err, $err_string, 1)) {
			$result[$port] = true;
			fclose($scn);
		} else {
			$result[$port] = false;
		}
	}

	echo "<strong>Scanning Result for :</strong> <i>", $_POST['ip'], "</i><br/><br/>";
	foreach($result as $port=>$val) {
		$srv = getservbyport($port, "tcp");
		echo "Port $port [$srv] : ";
		if($val) {
			echo "<span style='color:green'>OPEN</span><br/>";
		} else {
			echo "<span style='color:red'>Closed</span><br/>";
		}
	}
		
} else {
	echo "<br/>";
	echo '<form action="" method="post">';
	echo 'Enter IP Address to Scan : <input type="text" name="ip"> ';
	echo "<input type='submit' value='Start Scan'>";
	echo "</form>";
}

?>
