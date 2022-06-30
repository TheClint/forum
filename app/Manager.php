<?php
    namespace App;

use Model\Entities\Topic;

    abstract class Manager{

        protected function connect(){
            DAO::connect();
        }

        /**
         * get all the records of a table, sorted by optionnal field and order
         * 
         * @param array $order an array with field and order option
         * @return Collection a collection of objects hydrated by DAO, which are results of the request sent
         */
        public function findAll($order = null){

            $orderQuery = ($order) ?                 
                "ORDER BY ".$order[0]. " ".$order[1] :
                "";

            $sql = "SELECT *
                    FROM ".$this->tableName." a
                    ".$orderQuery;

            return $this->getMultipleResults(
                DAO::select($sql), 
                $this->className
            );
        }
       
        public function findOneById($id){

            $sql = "SELECT *
                    FROM ".$this->tableName." a
                    WHERE a.id_".$this->tableName." = :id
                    ";

            return $this->getOneOrNullResult(
                DAO::select($sql, ['id' => $id], false), 
                $this->className
            );
        }

        public function findOneByColumn($column, $parameter){

            $sql = "SELECT DISTINCT * 
                    FROM ".$this->tableName." a
                    WHERE a.".$column." = :parameter";
                    
            return $this->getOneOrNullResult(
                DAO::select($sql, ['parameter' => $parameter], false), 
                $this->className
            );
            
        }

        //$data = ['username' => 'Squalli', 'password' => 'dfsyfshfbzeifbqefbq', 'email' => 'sql@gmail.com'];

        public function add($data){
            //$keys = ['username' , 'password', 'email']
            $keys = array_keys($data);
            //$values = ['Squalli', 'dfsyfshfbzeifbqefbq', 'sql@gmail.com']
            $values = array_values($data);
            //"username,password,email"
            $sql = "INSERT INTO ".$this->tableName."
                    (".implode(',', $keys).") 
                    VALUES
                    (:".implode(", :",$keys).")";
                    //"'Squalli', 'dfsyfshfbzeifbqefbq', 'sql@gmail.com'"
            /*
                INSERT INTO user (username,password,email) VALUES ('Squalli', 'dfsyfshfbzeifbqefbq', 'sql@gmail.com') 
            */
            try{
                return DAO::insert($sql, $data);
            }
            catch(\PDOException $e){
                echo $e->getMessage();
                die();
            }
        }

        /** méthode générique pour update des données
        * @param array $data tableau associatif [colonne => nouvelle donnée]
        * @param int $id $id de la ligne à update
        * @return void
        */
        public function edit($data, $id){
          
            // Création des paramètres de la requête pour la préparer
            $chaineConcatene = "";
            foreach($data as $key => $value){
                $chaineConcatene.=$key." =  :".$key.", ";
            }
            $chaineConcatene = substr($chaineConcatene, 0, -2);
            $sql = "UPDATE ".$this->tableName."
                    SET ".$chaineConcatene."
                    WHERE id_".$this->tableName." = :id";

            // inclusion de l'id dans le tableau de donnée
            $data["id"]=$id;

            try{
                return DAO::insert($sql, $data);
            }
            catch(\PDOException $e){
                echo $e->getMessage();
                die();
            }
        }
        
        public function delete($id){
            $sql = "DELETE FROM ".$this->tableName."
                    WHERE id_".$this->tableName." = :id
                    ";

            return DAO::delete($sql, ['id' => $id]); 
        }

        private function generate($rows, $class){

            foreach($rows as $row){
                // yield permet de faire un générateur, et agi comme un return multiple qui retourne un tableau avec un "return" pour chaque itération
                yield new $class($row); 
            }
        }
        
        protected function getMultipleResults($rows, $class){
            if(is_iterable($rows)){ // vérifie que ce soit un tableau, soit un objet iterable
                return $this->generate($rows, $class);
            }
            else return null;
        }

        protected function getOneOrNullResult($row, $class){

            if($row != null){
                return new $class($row);
            }
            return false;
        }

        protected function getSingleScalarResult($row){

            if($row != null){
                $value = array_values($row);
                return $value[0];
            }
            return false;
        }
    
    }