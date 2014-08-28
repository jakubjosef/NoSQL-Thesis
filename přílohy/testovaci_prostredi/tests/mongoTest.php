<?php
/**
 * Trida pro testovani MongoDB databáze
 * @author Jakub Josef
 */
include "inc/class.BPTestCase.php";
class MongoTest extends BPTestCase{
	private $collection;

	protected function beforeTests(){
		$m = new MongoClient("mongodb://localhost:49168");
		$db = $m->database;
		$this->collection=$db->testData;
	}

	/**
	 * MongoDB Insert 1000 dokumentu
	 */
	protected function insert1000(){
		for($i=0;$i<1000;$i++){
			$this->collection->insert($this->data[$i]);
		}
	}
	/**
	* MongoDB Insert 10 000 dokumentu
	*/
	protected function insert10000(){
		for($i=0;$i<10000;$i++){
			$this->collection->insert($this->data[$i]);
		}
	}
	/**
	* MongoDB Insert 100 000 dokumentu
	*/
	protected function insert100000(){
		//first set
		foreach($this->data as $data){
			$this->collection->insert($data);
		}
		//second set
		$this->nextDataset();
		foreach($this->data as $data){
			$this->collection->insert($data);
		}
		//third set
		$this->nextDataset();
		foreach($this->data as $data){
			$this->collection->insert($data);
		}
		//fourth set
		$this->nextDataset();
		foreach($this->data as $data){
			$this->collection->insert($data);
		}

	}
        protected function findByID($id="53e6381537947b4910d7c1a5"){
            $this->collection->find(array("_id" => new MongoId($id)));
        }

        protected function findByAttr(){
            $findArray=array(
                "gender" => "male",
                "tags" => "elit",
                '$or' => array(
                    array("age" => array('$gte' => 30)),
                    array("isActive" => false)
                )
            );
            $this->collection->find($findArray);
        }

        protected function findAndFetchOne($id="53e5fcaf37947b4210d69cab"){
           iterator_to_array($this->collection->find(array("_id" => new MongoId($id))));
        }

        protected function findAndFetchMore(){
            $findArray=array(
                "gender" => "male",
                "tags" => "elit",
                '$or' => array(
                    array("age" => array('$gte' => 30)),
                    array("isActive" => false)
                )
            );
            iterator_to_array($this->collection->find($findArray)->limit(10));
        }

        protected function update($id="53e5fcaf37947b4210d69cab"){
            $this->collection->update(array("_id" => new MongoId($id)),array('$set' => array("index" => 25,"isActive" => true,"favoriteFruit" => "apple")));
        }
        protected function addIndex(){
            $this->collection->ensureIndex(array('index' => 1, 'registered' => -1));
        }

        protected function delete($id="53e5fcaf37947b4210d69cab"){
            $this->collection->remove(array("_id" => new MongoId($id)));
        }
}


?>