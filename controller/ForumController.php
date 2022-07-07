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
                if(Session::getTokenCSRF() !== $_POST['csrfToken']){
                    unset($_SESSION['user']);
                    unset($_SESSION['tokenCSRF']);
                    Session::addFlash(Session::CATEGORIE_ERROR, "Vous avez été déconnecté" );
                    $this->redirectTo();
                }
                else{    
                    $text = filter_input(INPUT_POST, 'text', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                    $postManager = new PostManager();
                    $postManager->add([
                        'text' => $text,
                        'topic_id' => $id,
                        'user_id' => $_SESSION['user']->getid()
                    ]);
                    Session::addFlash(Session::CATEGORIE_SUCCESS, "Votre message a été ajouté");
                }
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

        public function editPost($id){

            $postManager = new PostManager();
        
            if(!isset($_POST['editPost'])){
                Session::addFlash(Session::CATEGORIE_ERROR, "La modification du message n'a pas fonctionné");
                $this->redirectTo("forum", "readPostsFromTopic", $postManager->findOneById($id)->getTopic()->getId());
            }else{
                if(Session::getTokenCSRF() !== $_POST['csrfToken']){
                    unset($_SESSION['user']);
                    unset($_SESSION['tokenCSRF']);
                    Session::addFlash(Session::CATEGORIE_ERROR, "Vous avez été déconnecté" );
                    $this->redirectTo();
                }
                else{
                    $post = $postManager->findOneById($id);
                    
                    if(Session::getUser()==$post->getUser()){
                        $text = filter_input(INPUT_POST, 'text', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                        
                        $postManager->edit(['text' => $text], $id);
                        
                        Session::addFlash(Session::CATEGORIE_SUCCESS, "Votre message a bien été modifié");
                        $this->redirectTo("forum", "readPostsFromTopic", $post->getTopic()->getId());
                    }
                    else{
                        Session::addFlash(Session::CATEGORIE_ERROR, "Vous ne pouvez modifier que vos messages");
                        $this->redirectTo("forum", "readPostsFromTopic", $post->getTopic()->getId());
                    }
                }
            }
        }

        public function deletePost($id){

            $postManager = new PostManager();
        
            if(!isset($_POST['deletePost'])){
                Session::addFlash(Session::CATEGORIE_ERROR, "La suppression du message n'a pas fonctionné");
                $this->redirectTo("forum", "readPostsFromTopic", $postManager->findOneById($id)->getTopic()->getId());
            }else{
                if(Session::getTokenCSRF() !== $_POST['csrfToken']){
                    unset($_SESSION['user']);
                    unset($_SESSION['tokenCSRF']);
                    Session::addFlash(Session::CATEGORIE_ERROR, "Vous avez été déconnecté" );
                    $this->redirectTo();
                }
                else{
                    $post = $postManager->findOneById($id);
                    
                    if(Session::getUser()==$post->getUser()){
                        
                        $postManager->delete($id);

                        Session::addFlash(Session::CATEGORIE_SUCCESS, "Votre message a bien été supprimé");
                        $this->redirectTo("forum", "readPostsFromTopic", $post->getTopic()->getId());
                    }
                    else{
                        Session::addFlash(Session::CATEGORIE_ERROR, "Vous ne pouvez supprimer que vos messages");
                        $this->redirectTo("forum", "readPostsFromTopic", $post->getTopic()->getId());
                    }
                }
            }
        }

        public function editTopic($id){

            if(!isset($_POST['editTopic'])){
                Session::addFlash(Session::CATEGORIE_ERROR, "La modification de votre sujet n'a pas fonctionné");
                $this->redirectTo("forum", "readPostsFromTopic", $id);
            }else{
                if(Session::getTokenCSRF() !== $_POST['csrfToken']){
                    unset($_SESSION['user']);
                    unset($_SESSION['tokenCSRF']);
                    Session::addFlash(Session::CATEGORIE_ERROR, "Vous avez été déconnecté" );
                    $this->redirectTo();
                }
                else{
                    $topicManager = new TopicManager();
                    
                    if(Session::getUser()==$topicManager->findOneByID($id)->getUser()){
                        $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                        
                        $topicManager->edit(['title' => $title], $id);
                        
                        Session::addFlash(Session::CATEGORIE_SUCCESS, "Votre sujet a bien été modifié");
                        $this->redirectTo("forum", "readPostsFromTopic", $id);
                    }
                    else{
                        Session::addFlash(Session::CATEGORIE_ERROR, "Vous ne pouvez modifier que vos sujets");
                        $this->redirectTo("forum", "readPostsFromTopic", $id);
                    }
                }
            }
        }

        public function deleteTopic($id){

            if(!isset($_POST['deleteTopic'])){
                Session::addFlash(Session::CATEGORIE_ERROR, "La suppression du sujet n'a pas fonctionné");
                $this->redirectTo("forum", "readPostsFromTopic", $id);
            }else{
                if(Session::getTokenCSRF() !== $_POST['csrfToken']){
                    unset($_SESSION['user']);
                    unset($_SESSION['tokenCSRF']);
                    Session::addFlash(Session::CATEGORIE_ERROR, "Vous avez été déconnecté" );
                    $this->redirectTo();
                }
                else{
                    
                    $topicManager = new TopicManager();
                    $topic = $topicManager->findOneById($id);
                    if(Session::getUser()==$topic->getUser()){
                        $categorie = $topic->getCategorie();
                        $topicManager->delete($id);

                        Session::addFlash(Session::CATEGORIE_SUCCESS, "Votre sujet a bien été supprimé");
                        $this->redirectTo("forum", "readPostsFromTopic", $categorie->getId());
                    }
                    else{
                        Session::addFlash(Session::CATEGORIE_ERROR, "Vous ne pouvez supprimer que vos sujets");
                        $this->redirectTo("forum", "ListTopicsByCategorie", $id);
                    }
                }
            }
        }

        public function lockTopic($id){

            if(!isset($_POST['lockTopic'])){
                Session::addFlash(Session::CATEGORIE_ERROR, "Le verouillage du sujet n'a pas fonctionné");
                $this->redirectTo("forum", "readPostsFromTopic", $id);
            }else{
                if(Session::getTokenCSRF() !== $_POST['csrfToken']){
                    unset($_SESSION['user']);
                    unset($_SESSION['tokenCSRF']);
                    Session::addFlash(Session::CATEGORIE_ERROR, "Vous avez été déconnecté" );
                    $this->redirectTo();
                }
                else{
                    
                    $topicManager = new TopicManager();
                    $topic = $topicManager->findOneById($id);
                    if(Session::getUser()==$topic->getUser()){
                        
                        $topicManager->edit(['is_locked' => true], $id);

                        Session::addFlash(Session::CATEGORIE_SUCCESS, "Votre sujet a bien été verouillé");
                        $this->redirectTo("forum", "readPostsFromTopic", $id);
                    }
                    else{
                        Session::addFlash(Session::CATEGORIE_ERROR, "Vous ne pouvez verouiller que vos sujets");
                        $this->redirectTo("forum", "ListTopicsByCategorie", $id);
                    }
                }
            }
        }

        public function unlockTopic($id){

            if(!isset($_POST['unlockTopic'])){
                Session::addFlash(Session::CATEGORIE_ERROR, "Le déverouillage du sujet n'a pas fonctionné");
                $this->redirectTo("forum", "readPostsFromTopic", $id);
            }else{
                if(Session::getTokenCSRF() !== $_POST['csrfToken']){
                    unset($_SESSION['user']);
                    unset($_SESSION['tokenCSRF']);
                    Session::addFlash(Session::CATEGORIE_ERROR, "Vous avez été déconnecté" );
                    $this->redirectTo();
                }
                else{
                    
                    $topicManager = new TopicManager();
                    $topic = $topicManager->findOneById($id);
                    if(Session::getUser()==$topic->getUser()){
                        
                        $topicManager->edit(['is_locked' => (int)false], $id);

                        Session::addFlash(Session::CATEGORIE_SUCCESS, "Votre sujet a bien été déverouillé");
                        $this->redirectTo("forum", "readPostsFromTopic", $id);
                    }
                    else{
                        Session::addFlash(Session::CATEGORIE_ERROR, "Vous ne pouvez déverouiller que vos sujets");
                        $this->redirectTo("forum", "ListTopicsByCategorie", $id);
                    }
                }
            }
        }

        public function addTopic($id){

        if(!isset($_POST['addTopic'])){
            Session::addFlash(Session::CATEGORIE_ERROR, "La création de votre sujet n'a pas fonctionné");
            $this->redirectTo("forum", "ListTopicsByCategorie", $id);
        }else{
            if(Session::getTokenCSRF() !== $_POST['csrfToken']){
                unset($_SESSION['user']);
                unset($_SESSION['tokenCSRF']);
                Session::addFlash(Session::CATEGORIE_ERROR, "Vous avez été déconnecté" );
                $this->redirectTo();
            }
            else{
                $topicManager = new TopicManager();
                
                $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                    if($topicManager->findOneByColumn('title', $title)){
                        Session::addFlash(Session::CATEGORIE_ERROR, "Ce sujet existe déjà");
                        $this->redirectTo("forum", "ListTopicsByCategorie", $id);
                    }else{

                        $topicManager->add([
                            'title' => $title,
                            'categorie_id' => $id,
                            'user_id' => $_SESSION['user']->getid()
                        ], $id);
                        
                        Session::addFlash(Session::CATEGORIE_SUCCESS, "Votre sujet a bien été créé");
                        $this->redirectTo("forum", "readPostsFromTopic", $topicManager->findOneByColumn('title', $title)->getId());
                    }
                }
            }
        }
    }
