<?php

    namespace Controller;

    use App\AbstractController;
    use App\ControllerInterface;
    use App\Session;
    use Exception;
    use Model\Managers\UserManager;
    use Model\Managers\CategorieManager;

    class SecurityController extends AbstractController implements ControllerInterface{

        public function index(){

            $categorieManager = new CategorieManager();

            //initialisation d'un token pour le formulaire de connexion
            Session::setTokenCSRF(bin2hex(random_bytes(64)));

            return [
                "view" => VIEW_DIR."security\login.php",
                "data" => [
                    "categories" => $categorieManager->findAll()
                    ]
            ];
        }

        // fonction pour se connecter sur le site
        public function submitLogin(){

            if(isset($_POST['login'])){

                if(Session::getTokenCSRF() !== $_POST['csrfToken']){
                    $this->logout();
                }
                else{
                    $userManager = new UserManager();
                    $mail = strtolower(filter_input(INPUT_POST, 'mail', FILTER_SANITIZE_EMAIL));
                    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_EMAIL);
                    $user = $userManager->findOneByColumn('email', $mail);

                    if(($user)&&(password_verify($password, $user->getPassword()))){
                        
                            Session::setUser($user);
                            //initialisation d'un token pour toute la session user
                            Session::setTokenCSRF(bin2hex(random_bytes(64)));
                            Session::addFlash(Session::CATEGORIE_SUCCESS, "Vous êtes connecté" );
                            $this->redirectTo();
                    }
                    else
                        Session::addFlash(Session::CATEGORIE_ERROR, "Les identifiants sont incorrects");
                }
            }
            else
            Session::addFlash(Session::CATEGORIE_ERROR, "La connexion a échoué");
            $this->redirectTo("security", "login");
        }

        // pour se déconnecter
        public function logout(){

            unset($_SESSION['user']);
            unset($_SESSION['tokenCSRF']);
            Session::addFlash(Session::CATEGORIE_SUCCESS, "Vous êtes déconnecté" );
            $this->redirectTo();

        }

        // pour aller sur la vue de l'enregistrement
        public function register(){

            $categorieManager = new CategorieManager();

            //initialisation d'un token pour le formulaire d'inscription
            Session::setTokenCSRF(bin2hex(random_bytes(64)));

            return [
                "view" => VIEW_DIR."security\\register.php",
                "data" => [
                    "categories" => $categorieManager->findAll()
                    ]
            ];
        }

        // pour valider l'enregistrement
        public function submitRegister(){
  
            if(!isset($_POST['register'])){
                Session::addFlash(Session::CATEGORIE_ERROR, "L'opération a echoué");
                $this->redirectTo("security", "register");
            }else{

                if(Session::getTokenCSRF() !== $_POST['csrfToken']){
                    $this->logout();
                }
                else{

                    // Filtrage des input
                    $pseudo = ucfirst(strtolower(filter_input(INPUT_POST, 'pseudo', FILTER_SANITIZE_FULL_SPECIAL_CHARS)));
                    $mail = strtolower(filter_input(INPUT_POST, 'mail1', FILTER_SANITIZE_EMAIL));
                    $mail2 = strtolower(filter_input(INPUT_POST, 'mail2', FILTER_SANITIZE_EMAIL));
                    $password2 = filter_input(INPUT_POST, 'password2', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    $password1 = filter_input(INPUT_POST, 'password1', FILTER_VALIDATE_REGEXP, array(
                        "options" => array("regexp" => 
                        "/\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*/")));
                        
                        $userManager = new UserManager();
                        
                        // Verification des input
                        if(strlen($pseudo)>12){
                            Session::addFlash(Session::CATEGORIE_ERROR, 'Le pseudonyme est trop long (pas plus de 12 caractères)');
                            $this->redirectTo("security", "register");
                        }
                        else{

                            if($mail!=$mail2){
                                Session::addFlash(Session::CATEGORIE_ERROR, 'Les mails ne sont pas identiques');
                                $this->redirectTo("security", "register");
                            }
                            elseif(strlen($password1)!=strlen($password2)){
                                Session::addFlash(Session::CATEGORIE_ERROR, "Ce mot de passe n'est pas valide");
                                $this->redirectTo("security", "register");
                            }
                            elseif($password1!=$password2){
                                Session::addFlash(Session::CATEGORIE_ERROR, 'Les mots de passe ne sont pas identiques');
                                $this->redirectTo("security", "register");
                            }
                            elseif($userManager->findOneByColumn('email', $mail)){
                                Session::addFlash(Session::CATEGORIE_ERROR, "Cette adresse mail est déjà utilisée");
                                $this->redirectTo("security", "register");
                            }
                            elseif($userManager->findOneByColumn('pseudonyme', $pseudo)){
                                Session::addFlash(Session::CATEGORIE_ERROR, "Ce pseudo est déjà utilisée");
                                $this->redirectTo("security", "register");
                            }
                            elseif(!$mail){
                                Session::addFlash(Session::CATEGORIE_ERROR, "Cet email n'est pas valide");
                                $this->redirectTo("security", "register");
                            }
                            elseif(strlen($password1)<8){
                                Session::addFlash(Session::CATEGORIE_ERROR, "Le mot de passe est trop court");
                                $this->redirectTo("security", "register");
                            }
                            else{
                                // Hashage du password
                                $hash = password_hash($password1, PASSWORD_DEFAULT);
                                
                                // persistence des données
                                $userManager->add([
                                    'pseudonyme' => $pseudo,
                                    'email' => $mail,
                                    'password' => $hash
                                ]);
                                
                                Session::addFlash(Session::CATEGORIE_SUCCESS, "L'opération est un succès");
                                $this->redirectTo("security", "register");  
                            }
                    }
                }
            }
        }

        public function editUser($id){
            $userManager = new UserManager();
            $categorieManager = new CategorieManager();

            return [
                "view" => VIEW_DIR."security\\".__FUNCTION__.".php",
                "data" => [
                    "user" => $userManager->findOneById($id),
                    "categories" => $categorieManager->findAll()
                    ]
            ]; 
        }

        public function submitEditUser($id){
            $userManager = new UserManager();
            $user = $userManager->findOneById($id);

            // Vérification que le post existe
            if(!isset($_POST[__FUNCTION__]))
            {
                Session::addFlash(Session::CATEGORIE_ERROR, "L'opération a echoué");
                $this->redirectTo("forum", "detailUser", $id);
            }else{

                if(Session::getTokenCSRF() !== $_POST['csrfToken']){
                    $this->logout();
                }
                else{
                    // Vérification du password
                    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_EMAIL);
                    if(!password_verify($password, $user->getPassword()))
                    {
                        Session::addFlash(Session::CATEGORIE_ERROR, "Le mot de passe n'est pas correct");
                        $this->redirectTo("forum", "detailUser", $id);
                    }else{

                        // Filtrage des input
                        $pseudo = filter_input(INPUT_POST, 'pseudo', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                        $email1 = filter_input(INPUT_POST, 'email1', FILTER_SANITIZE_EMAIL);
                        $email2 = filter_input(INPUT_POST, 'email2', FILTER_SANITIZE_EMAIL);

                        if($email1!=$email2){
                            Session::addFlash(Session::CATEGORIE_ERROR, 'Les mails ne sont pas identiques');
                            $this->redirectTo("security", "register");
                        }else{
                            $userVerifMail = $userManager->findOneByColumn('email', $email1);
                            if($userVerifMail&&($userVerifMail->getId()!=$user->getId())){
                                Session::addFlash(Session::CATEGORIE_ERROR, "Cette adresse mail est déjà utilisée");
                                $this->redirectTo("security", "register");
                            }else{
                                if(strlen($pseudo)>12){
                                    Session::addFlash(Session::CATEGORIE_ERROR, 'Le pseudonyme est trop long (pas plus de 12 caractères)');
                                    $this->redirectTo("security", "register");
                                }
                                else{

                                    $userVerifPseudo = $userManager->findOneByColumn('pseudonyme', $pseudo);
                                    if($userVerifPseudo&&($userVerifPseudo->getId()!=$user->getId())){
                                        Session::addFlash(Session::CATEGORIE_ERROR, "Ce pseudo est déjà utilisée");
                                        $this->redirectTo("security", "register");
                                    }else{
                                        if(!$email1){
                                            Session::addFlash(Session::CATEGORIE_ERROR, "Cet email n'est pas valide");
                                            $this->redirectTo("security", "register");
                                        }else{
                                            
                                            $data = [
                                                "pseudonyme" => $pseudo,
                                                "email" => $email1
                                            ];
                                            
                                            $userManager->edit($data, $id);
                                            Session::setUser($userManager->findOneById($id));
                                            Session::addFlash(Session::CATEGORIE_SUCCESS, "L'opération a réussi");
                                            $this->redirectTo("security", "editUser", $id);
                                            
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

        public function editPassword($id){
            $userManager = new UserManager();
            $categorieManager = new CategorieManager();

            return [
                "view" => VIEW_DIR."security\\".__FUNCTION__.".php",
                "data" => [
                    "user" => $userManager->findOneById($id),
                    "categories" => $categorieManager->findAll()
                    ]
            ];
        }

        public function submitEditPassword($id){

            // Vérification que le post existe
            if(!isset($_POST[__FUNCTION__])){
                Session::addFlash(Session::CATEGORIE_ERROR, "L'opération a echoué");
                $this->redirectTo("forum", "detailUser", $id);
            }else{

                if(Session::getTokenCSRF() !== $_POST['csrfToken']){
                    $this->logout();
                }
                else{

                    $userManager = new UserManager();
                    $user = $userManager->findOneById($id);

                    // Vérification de l'ancien password
                    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_EMAIL);
                    if(!password_verify($password, $user->getPassword())){
                        Session::addFlash(Session::CATEGORIE_ERROR, "L'ancien mot de passe est incorect");
                        $this->redirectTo("forum", "detailUser", $id);
                    }else{
        
                        // Filtrage des input
                        $password2 = filter_input(INPUT_POST, 'password2', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                        $password1 = filter_input(INPUT_POST, 'password1', FILTER_VALIDATE_REGEXP, array(
                            "options" => array("regexp" => 
                            "/\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*/")));

                        // Verification des input
                        if(strlen($password1)!=strlen($password2)){
                            Session::addFlash(Session::CATEGORIE_ERROR, "Ce mot de passe n'est pas valide");
                            $this->redirectTo("forum", "detailUser", $id);
                        }
                        elseif($password1!=$password2){
                            Session::addFlash(Session::CATEGORIE_ERROR, 'Les mots de passe ne sont pas identiques');
                            $this->redirectTo("forum", "detailUser", $id);
                        }
                        elseif(strlen($password1)<8){
                            Session::addFlash(Session::CATEGORIE_ERROR, "Le mot de passe est trop court");
                            $this->redirectTo("forum", "detailUser", $id);
                        }else{

                            // stockage dans une variable dont le nom est le dernier mot de la fonction
                            $hash = password_hash($password1, PASSWORD_DEFAULT);
                            
                            $userManager->edit(["password" => $hash ], $id);
                            Session::setUser($userManager->findOneById($id));
                            Session::addFlash(Session::CATEGORIE_SUCCESS, "L'opération a réussi");
                            $this->redirectTo("forum", "detailUser", $id);
                        }
                    }
                }
            }
        }
    }
        
    