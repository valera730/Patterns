<?php
abstract class FileNamingStrategy{
	abstract function createLinkName($fileName);
}
class ZipFile extends FileNamingStrategy{
	function createLinkName($fileName){
		return "http://localhost/download/$fileName.zip";
	}
}
class TarGzFile extends FileNamingStrategy{
	function createLinkName($fileName){
		return "http://localhost/download/$fileName.tar.gz";
	}
}
if(strstr($_SERVER["HTTP_USER_AGENT"], "Win"))
	$obj = new ZipFile();	
else
	$obj = new TarGzFile();

$link1 = $obj->createLinkName("file_one");
$link2 = $obj->createLinkName("file_two");	

print <<<LIST
<h1>Список файлов для скачивания:</h1>
<p>
<a href="$link1">Первый файл</a><br>
<a href="$link2">Второй файл</a>
</p>
LIST;
?>