<?php
/**
 * Использовать в контроллере:
  	$example=$this->getObject('Class', 'Example');
 	echo $example->test();
 * @author gm
 *
 */
class ExampleClass{

	function test(){
		echo "test";
	}
}