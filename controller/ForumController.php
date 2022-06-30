<?php

    namespace Controller;

    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;
    use Model\Managers\CategorieManager;
    use Model\Managers\TopicManager;
    use Model\Managers\PostManager;
    use Model\Managers\UserManager;
    
    class ForumController extends AbstractController implements ControllerInterface{

        public function index(){
          

           $topicManager = new TopicManager();
           $categorieManager = new CategorieManager();
           $postManager = new PostManager();

            $topics = $topicManager->findAll(["topic_date", "DESC"]);
            foreach($topics as $topic){
                $lastPost[] = $postManager->lastPostByTopic($topic->getId());
            }
         
            return [
                "view" => VIEW_DIR."forum/recentTopics.php",
                "data" => [
                    "topics" => $topicManager->findAll(["topic_date", "DESC"]),
                    "lastPosts" => $lastPost,
                    "categories" => $categorieManager->findAll()
                ]
            ];
        
        }

        // fonction pour lire les posts d'un topic
        public function readPostsFromTopic($id){

            $topicManager = new TopicManager();
            $postManager = new PostManager();
            $categorieManager = new CategorieManager();
            
            return [
                "view" =>VIEW_DIR."forum/topic.php",
                "data" => [
                    "topic" => $topicManager->findOneById($id),
                    "posts" => $postManager->findPostsByTopic($id),
                    "categories" => $categorieManager->findAll()
                ]
            ];
        }

        // fonction pour ajouter un post
        public function addPost($id){

            if(!isset($_POST['addPost'])){
                Session::addFlash(Session::CATEGORIE_ERROR, "L'ajout de post n'a pas fonctionné");
            }else{
                $text = filter_input(INPUT_POST, 'text', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                $postManager = new PostManager();
                $postManager->add([
                    'text' => $text,
                    'topic_id' => $id,
                    'user_id' => $_SESSION['user']->getid()
                ]);
                Session::addFlash(Session::CATEGORIE_SUCCESS, "Votre message a été ajouté");
            }
            $this->redirectTo("forum", "readPostsFromTopic", $id);
        }

        // function pour avoir la liste de tous les topics par une categorie
        public function ListTopicsByCategorie($id){
          
            $topicManager = new TopicManager();
            $categorieManager = new CategorieManager();
            $postManager = new PostManager();

            // Création d'un tableau contenant les derniers messages de chaque topic
            $topics = $topicManager->listTopicsByCategorie($id);
            foreach($topics as $topic){
                $lastPost[] = $postManager->lastPostByTopic($topic->getId());
            }
            
             return [
                 "view" => VIEW_DIR."forum/topicsByCategorie.php",
                 "data" => [
                     "topics" => $topicManager->listTopicsByCategorie($id),
                     "lastPosts" => $lastPost,
                     "categories" => $categorieManager->findAll(),
                     "categorie" => $categorieManager->findOneById($id)
                 ]
             ];
         
         }

         // fonction qui retourne la liste des users
         public function listUsers(){
          
            $userManager = new UserManager();
            $categorieManager = new CategorieManager();
          
             return [
                 "view" => VIEW_DIR."forum/listUsers.php",
                 "data" => [
                     "users" => $userManager->findAll(["pseudonyme", "ASC"]),
                     "categories" => $categorieManager->findAll()
                 ]
             ];
         
         }

         // fonction qui retourne le détail d'un user
        public function detailUser($id){

            $userManager = new UserManager();
            $categorieManager = new CategorieManager();
            $postManager = new PostManager();
          
             return [
                 "view" => VIEW_DIR."forum/detailUser.php",
                 "data" => [
                     "user" => $userManager->findOneById($id),
                     "posts" => $postManager->findPostsByUser($id),
                     "categories" => $categorieManager->findAll()
                 ]
             ];
        }
    }
