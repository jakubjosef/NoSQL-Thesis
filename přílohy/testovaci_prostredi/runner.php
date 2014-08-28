<?php
ini_set('max_execution_time', 0);
ini_set('memory_limit', '1024M');
spl_autoload_register(function($class_name){
	if(strtolower(substr($class_name, strlen($class_name)-4))=="test"){
		require_once('tests/'.lcfirst($class_name).'.php');
	}
});
if(isset($_GET["class"]) && isset($_GET["test"])){
	$test=new $_GET['class'](explode(",", $_GET["test"]));
	$test->run();
	foreach($test->getTestResults() as $result){
		echo "$result ";
	}
}else{
	echo "No test(s) specified";
}

?>