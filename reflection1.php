<?php
class ClassOne{
	public function sayHelloOne(){
		echo "Ïðèâåò îò ".__CLASS__."!";
	}
}
class ClassTwo{
	public function sayHelloTwo(){
		echo "Ïðèâåò îò ".__CLASS__."!";
	}
}
class ClassThree{
	public function sayHelloThree(){
		echo "Ïðèâåò îò ".__CLASS__."!";
	}
}
class ClassDelegator{
	private $list;
	function __construct(){
		//Ýêçåìïëÿð êëàññà ïî óìîë÷àíèþ
		$this->list[] = new stdClass();
	}
	function addObject($obj){
		//Äîáàâëåíèå îáúåêòà â ñïèñîê
		$this->list[] = $obj;
	}
	function __call($name, $args){
		//Ïåðåáèðàåì ñïèñîê
		foreach($this->list as $obj){
			//Ïîëó÷àåì îïèñàíèå êëàññà
			$r = new ReflectionClass($obj);
			//Åñòü íóæíûé íàì ìåòîä?
			if($r->hasMethod($name)){
                $method = $r->getMethod($name);
				if($method->isPublic() && !$method->isAbstract()){
					return $method->invoke($obj,$args);
				}
			}
		}
	}
}

$obj = new ClassDelegator();
$obj->addObject(new ClassOne());
$obj->addObject(new ClassThree());
$obj->sayHelloOne();
$obj->sayHelloTwo();
$obj->sayHelloThree();
?>
