<?php

class Genre{
	protected $name;
	protected static $count = 0;

	public function __construct($name){
		$this->name = $name;
		self::$count++;
	}

	public static function getCount() {
      	return self::$count;
  	}
  	
	public function getName(){
		return $this->name;
	}
}

?>