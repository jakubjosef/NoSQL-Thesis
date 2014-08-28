<?php
/**
 * Abstraktni predek pro casove testy v Bakalarske praci
 * @author Jakub Josef
 */

abstract class BPTestCase{
	private $testMethods=array();
	private $testResults=array();
	private $logging=false;
	private $runtime;
	private $set=1;
	private $setsNum=4;

	protected $data=array();

	public function __construct(array $testMethods,$fillData=true,$logging=false){
		$this->testMethods=$testMethods;
		$this->logging=$logging;
		if($fillData){
			$this->fillData();
		}
	}
	public function run(){
		if($this->logging){
			echo '<html><meta charset="UTF-8"><body>';
			echo "Spouštím testy<br/>";
		}
		if(method_exists($this, "beforeTests")){$this->beforeTests();}
		$this->runtime=microtime(true);
		foreach($this->testMethods as $test){
			$t=microtime(true);
			$this->$test();
			$this->testResults[$test]= microtime(true)-$t;
			if($this->logging){
				echo "Test $testName dokončen<br/>";
			}
		}
		$this->runtime=microtime(true)-$this->runtime;
		if($this->logging){
			echo "Všechny testy dokončeny</br> Celkový čas: $this->runtime </body></html>";
		}

	}
	public function getTestResult($name){
		return $this->testResults[$name];
	}
	public function getTestResults(){
		return $this->testResults;
	}
	public function viewResults(){
		var_dump($this->testResults);
	}
	public function fillData($setID=null){
		if($setID==null){
			$setID=$this->set;
		}
		$this->data=json_decode(file_get_contents("data/set".$setID.".json"));
	}
	public function nextDataset(){
		if($this->set<$this->setsNum){
			$this->data=json_decode(file_get_contents("data/set".($this->set+1).".json"));
		}
	}
	protected function countDataTest(){
		echo "Count: ".count($this->data)." ";
	}
	protected function echoDataTest(){
		echo json_encode(array_slice($this->data,0,25000));
	}
}
?>