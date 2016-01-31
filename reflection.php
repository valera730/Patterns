<?php
class ClassOne{
	public function sayHelloOne(){
		echo "Привет от ".__CLASS__."!";
	}
}
class ClassTwo{
	public function sayHelloTwo(){
		echo "Привет от ".__CLASS__."!";
	}
}
class ClassThree{
	public function sayHelloThree(){
		echo "Привет от ".__CLASS__."!";
	}
}
class ClassDelegator{
	private $list;
	function __construct(){
		//Экземпляр класса по умолчанию
		$this->list[] = new stdClass();
	}
	function addObject($obj){
		//Добавление объекта в список
		$this->list[] = $obj;
	}
	function __call($name, $args){
		//Перебираем список
		foreach($this->list as $obj){
			//Получаем описание класса
			$r = new ReflectionClass($obj);
			//Есть нужный нам метод?
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