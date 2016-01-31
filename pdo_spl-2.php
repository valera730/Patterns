<?php
error_reporting(E_ALL);

try {
	$dsn = new PDO("sqlite2:users.db");

	$stmt = $dsn->prepare("SELECT * FROM user ORDER BY id");

	$stmt->execute();

	// Получаем только ассоциативный массив
	$stmt->setFetchMode(PDO::FETCH_ASSOC);

	$it = new IteratorIterator($stmt);

	foreach($it as $row){
		echo '<table style="border: solid 1px black; width: 300px;">';
		// Итерируем с помощью ArrayIterator
		foreach(new ArrayIterator($row) as $key => $val){
			echo '<tr><td style="width: 150px">'.$key.'</td><td>'.$val.'</td></tr>';
		}
		echo '</table>';
	}

	$dsn = null;
}catch (PDOException $e){
	print "Error!: " . $e->getMessage() . "<br />";
}
?>