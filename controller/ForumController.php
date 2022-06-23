<?php

    namespace Controller;

    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;
    use Model\Managers\CategorieManager;
    use Model\Managers\TopicManager;
    use Model\Managers\PostManager;
    
    class ForumController extends AbstractController implements ControllerInterface{

        public function index(){
          

           $topicManager = new TopicManager();
         
            return [
                "view" => VIEW_DIR."forum/recentTopics.php",
                "data" => [
                    "topics" => $topicManager->findAll(["topic_date", "DESC"])
                ]
            ];
        
        }

        public function read($id){

            $topicManager = new TopicManager();
            $postManager = new PostManager();
            
            return [
                "view" =>VIEW_DIR."forum/topic.php",
                "data" => [
                    "topic" => $topicManager->findOneById($id),
                    "posts" => $postManager->findAll(["message_date", "DESC"])
                ]
            ];
        }
        

    }
