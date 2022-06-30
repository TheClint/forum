<?php
    namespace Model\Managers;

    use App\Manager;
    use App\DAO;
    use Model\Entities\Post;

    class PostManager extends Manager{

        protected $className = "Model\Entities\Post";
        protected $tableName = "post";

        public function __construct(){
            parent::connect();
        }
    

    // fonction pour retourner la list des posts d'un topic
    public function findPostsByTopic($id){

        $sql = "SELECT *
                FROM ".$this->tableName." a
                WHERE topic_id = :id
                ORDER BY a.message_date ASC";

        return $this->getMultipleResults(
            DAO::select($sql, ['id' => $id], true), 
            $this->className
        );
    }

    // fonction pour retourner les posts d'un user
    public function findPostsByUser($id){

        $sql = "SELECT *
                FROM ".$this->tableName." a
                WHERE user_id = :id
                ORDER BY a.message_date DESC";

        return $this->getMultipleResults(
            DAO::select($sql, ['id' => $id], true), 
            $this->className
        );
    }

    // fonction pour retourner le dernier post d'un topic
    public function lastPostByTopic($id){

        $sql = "SELECT DISTINCT *
                FROM ".$this->tableName." a
                WHERE topic_id = :id AND message_date = 
                    (SELECT MAX(message_date)
                    FROM post a
                    WHERE topic_id = :id
                    GROUP BY topic_id)";

        return $this->getOneOrNullResult(
            DAO::select($sql, ['id' => $id], true)[0], 
            $this->className
        );

    }

}