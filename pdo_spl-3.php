<table style="border: solid 1px black; width: 400px;">
<tr><td>ID</td><td>Name</td><td>Email</td></tr>
<?php
error_reporting(E_ALL);

// наследуем RecursiveIteratorIterator
class TableRows extends RecursiveIteratorIterator{
	function __construct($it){
		parent::__construct($it, self::LEAVES_ONLY);
	}

	function beginChildren(){
		echo '<tr>';
	}

	function endChildren() {
		echo '</tr>'."\n";
	}
} // конец описания класса

try {
	$dsn = new PDO("sqlite2:users.db");

	$stmt = $dsn->prepare('SELECT * FROM user');

	$stmt->execute();

	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

	foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v){
		echo '<td style="width: 150px; border: 1px solid black;">'.$v.'</td>';
	}

	$dsn = null;
}catch (PDOException $e){
	print "Error!: " . $e->getMessage() . '<br />';
}
?>
</table>