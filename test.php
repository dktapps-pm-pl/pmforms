<?php

use dktapps\pmforms\CustomForm;
use dktapps\pmforms\CustomFormResponse;
use dktapps\pmforms\element\Input;
use dktapps\pmforms\element\Label;
use pocketmine\form\FormValidationException;
use pocketmine\player\Player;

require __DIR__ . '/vendor/autoload.php';

$form = new CustomForm("Test Form", [
	new Label("Test1", "Test1"),
	new Input("Test2", "Test2", "Test2"),
	new Input("Test3", "Test3", "Test3"),
	new Label("Test4", "Test4"),
	new Input("Test5", "Test5", "Test5"),
], function(Player $player, CustomFormResponse $data) : void{
	var_dump($data);
});

var_dump($form->buildResponseFromData(["Test2", "Test3", "Test5"])); //valid, labels not included
var_dump($form->buildResponseFromData([null, "Test2", "Test3", null, "Test5"])); //valid, labels included


foreach([
	[],
	[null, "Test2", "Test3", null], //missing element 5
	["Test2", "Test3"], //missing element 5 + labels
	[null, "Test2", "Test3", null, "Test5", "Test6"],
	[2, 3, 5], //could be correct, but has wrong value types - fail
	[null, 2, 3, null, 5]
] as $test){
	try{
		var_dump($form->buildResponseFromData($test)); //invalid
		throw new \LogicException("WTF?");
	}catch(FormValidationException $e){
		echo $e->getMessage() . "\n";
	}
}
