<?php
/**
 * Trida pro testovani MySQL databaze
 *
 * @author Jakub Josef
 */
 include "inc/NotORM.php";
 include "inc/class.BPTestCase.php";
class MysqlTest extends BPTestCase {
    private $pdo;
    private $db;
    private $insertStatement;

    protected function beforeTests(){
    $this->pdo = new PDO("mysql:dbname=bp","root","QU97Whkm");
    $this->db = new NotORM($this->pdo);
    $query="INSERT INTO `persons` (
                    `hash`, `guid`, `isActive`, `balance`, `picture`, `age`,
                    `eyeColor`, `name`, `gender`, `company`, `email`, `phone`, `address`,
                    `about`, `registered`, `latitude`, `longitude`, `greeting`, `favoriteFruit`)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
    $this->insertStatement = $this->pdo->prepare($query);
    }

    /**
     * MongoDB Insert 1000 dokumentu
     */
    protected function insert1000(){
            for($i=0;$i<1000;$i++){
                    $this->insertStatement->execute(array(
                        $this->data[$i]->hash,
                        $this->data[$i]->guid,
                        $this->data[$i]->isActive,
                        $this->data[$i]->balance,
                        $this->data[$i]->picture,
                        $this->data[$i]->age,
                        $this->data[$i]->eyeColor,
                        $this->data[$i]->name,
                        $this->data[$i]->gender,
                        $this->data[$i]->company,
                        $this->data[$i]->email,
                        $this->data[$i]->phone,
                        $this->data[$i]->address,
                        $this->data[$i]->about,
                        $this->data[$i]->registered,
                        $this->data[$i]->latitude,
                        $this->data[$i]->longitude,
                        $this->data[$i]->greeting,
                        $this->data[$i]->favoriteFruit));
            }
    }
    /**
    * MongoDB Insert 10 000 dokumentu
    */
    protected function insert10000(){
            for($i=0;$i<10000;$i++){
                    $this->insertStatement->execute(array(
                        $this->data[$i]->hash,
                        $this->data[$i]->guid,
                        $this->data[$i]->isActive,
                        $this->data[$i]->balance,
                        $this->data[$i]->picture,
                        $this->data[$i]->age,
                        $this->data[$i]->eyeColor,
                        $this->data[$i]->name,
                        $this->data[$i]->gender,
                        $this->data[$i]->company,
                        $this->data[$i]->email,
                        $this->data[$i]->phone,
                        $this->data[$i]->address,
                        $this->data[$i]->about,
                        $this->data[$i]->registered,
                        $this->data[$i]->latitude,
                        $this->data[$i]->longitude,
                        $this->data[$i]->greeting,
                        $this->data[$i]->favoriteFruit));
            }
    }
    /**
    * MongoDB Insert 100 000 dokumentu
    */
    protected function insert100000(){
            //first set
            foreach($this->data as $data){
                    $this->insertStatement->execute(array(
                        $data->hash,
                        $data->guid,
                        $data->isActive,
                        $data->balance,
                        $data->picture,
                        $data->age,
                        $data->eyeColor,
                        $data->name,
                        $data->gender,
                        $data->company,
                        $data->email,
                        $data->phone,
                        $data->address,
                        $data->about,
                        $data->registered,
                        $data->latitude,
                        $data->longitude,
                        $data->greeting,
                        $data->favoriteFruit));
            }
            //second set
            $this->nextDataset();
            foreach($this->data as $data){
                    $this->insertStatement->execute(array(
                        $data->hash,
                        $data->guid,
                        $data->isActive,
                        $data->balance,
                        $data->picture,
                        $data->age,
                        $data->eyeColor,
                        $data->name,
                        $data->gender,
                        $data->company,
                        $data->email,
                        $data->phone,
                        $data->address,
                        $data->about,
                        $data->registered,
                        $data->latitude,
                        $data->longitude,
                        $data->greeting,
                        $data->favoriteFruit));
            }
            //third set
            $this->nextDataset();
            foreach($this->data as $data){
                    $this->insertStatement->execute(array(
                        $data->hash,
                        $data->guid,
                        $data->isActive,
                        $data->balance,
                        $data->picture,
                        $data->age,
                        $data->eyeColor,
                        $data->name,
                        $data->gender,
                        $data->company,
                        $data->email,
                        $data->phone,
                        $data->address,
                        $data->about,
                        $data->registered,
                        $data->latitude,
                        $data->longitude,
                        $data->greeting,
                        $data->favoriteFruit));
            }
            //fourth set
            $this->nextDataset();
            foreach($this->data as $data){
                    $this->insertStatement->execute(array(
                        $data->hash,
                        $data->guid,
                        $data->isActive,
                        $data->balance,
                        $data->picture,
                        $data->age,
                        $data->eyeColor,
                        $data->name,
                        $data->gender,
                        $data->company,
                        $data->email,
                        $data->phone,
                        $data->address,
                        $data->about,
                        $data->registered,
                        $data->latitude,
                        $data->longitude,
                        $data->greeting,
                        $data->favoriteFruit));
            }

    }
    protected function findByID($id="257158"){
        $this->db->persons()->where("id",$id);
    }

    protected function findByAttr(){
        $this->db->persons()->where("gender","male")->where("age > ? OR isActive = ?",30,0);
    }

    protected function findAndFetchOne($id="398452"){
       iterator_to_array($this->db->persons()->where("id",$id));
    }

    protected function findAndFetchMore(){
        iterator_to_array($this->db->persons()->where("gender","male")->where("age > ? OR isActive = ?",30,0)->limit(10));
    }

    protected function update($id=400000){
        $query="UPDATE persons
                SET index=25, isActive=1, favoriteFruit='apple'
                WHERE id=$id";
        $this->pdo->query($query);
    }
    protected function addIndex(){
        $this->pdo->query("CREATE INDEX IDX_INDEX_REGISTERED ON persons (`guid`, `registered`)");
    }

    protected function delete($id="47535"){
        $this->pdo->query("DELETE FROM persons WHERE id=$id");
    }
}
