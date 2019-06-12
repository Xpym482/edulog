<?php 

class MyDB extends SQLite3 {
	function __construct() {
		 $this->open('../../../database.sqlite.sqbpro');
	}
}
$db = new MyDB();
if(!$db) {
	echo $db->lastErrorMsg();
} else {
	echo "Opened database successfully\n";
}

function sqlite_table_exists($logs) {
	$db = sqlite_open('database.sqlite.sqbpro', 0666, $sqliteerror);
		$query = sqlite_query($db, "SELECT lessons FROM database.sqlite WHERE type='logs'");
		$tables = sqlite_fetch_array($query);
		if ($tables != '') {
			foreach ($tables as $logs) {
				if ($logs == $mytable) {
					return("TRUE");
				}
				else {
					return("FALSE");
				}
			}
		}
		else {
			return("FALSE");
		}
	}

	//test

function insertActivities($activities) {
	$db = "INSERT INTO activities (name_et)";
	$db->close();

}

function selectTest($activities){
	$result = $db->query("SELECT slug FROM activities");
	foreach($result as $row)
    {
        print $row['slug'] . "\n";
    }

}





?>