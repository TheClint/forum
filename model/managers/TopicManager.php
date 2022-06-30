<?php
    namespace Model\Managers;

    use App\Manager;
    use App\DAO;

    class TopicManager extends Manager{

        protected $className = "Model\Entities\Topic";
        protected $tableName = "topic";

        public function __construct(){
            parent::connect();
        }

        public function listTopicsByCategorie($id){

            $sql = "SELECT * from ".$this->tableName." a 
            WHERE a.categorie_id = :id";

            return $this->getMultipleResults(DAO::Select($sql, ['id' => $id], true),
             $this->className);
        }
    }