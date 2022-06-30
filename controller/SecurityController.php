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

                $userManager = new UserManager();
                $mail = strtolower(filter_input(INPUT_POST, 'mail', FILTER_SANITIZE_EMAIL));
                $user = $userManager->findOneByColumn('email', $mail);

                if(($user)&&(password_verify($_POST['password'], $user->getPassword()))){
                    
                        Session::setUser($user);
                        Session::addFlash(Session::CATEGORIE_SUCCESS, "Vous êtes connecté" );
                        $this->redirectTo();
                }
                else
                    Session::addFlash(Session::CATEGORIE_ERROR, "Les identifiants sont incorrects");
            }
            else
            Session::addFlash(Session::CATEGORIE_ERROR, "La connexion a échoué");
            $this->redirectTo("security", "login");
        }

        // pour se déconnecter
        public function logout(){

            unset($_SESSION['user']);
            Session::addFlash(Session::CATEGORIE_SUCCESS, "Vous êtes déconnecté" );
            $this->redirectTo();

        }

        // pour aller sur la vue de l'enregistrement
        public function register(){

            $categorieManager = new CategorieManager();

            return [
                "view" => VIEW_DIR."security\\register.php",
                "data" => [
                    "categories" => $categorieManager->findAll()
                    ]
            ];
        }

        // pour valider l'enregistrement
        public function submitRegister(){
  
        if(!isset($_POST['register']))
            $this->failedRegister("L'opération a echoué");
    
        // Filtrage des input
        $pseudo = ucfirst(strtolower(filter_input(INPUT_POST, 'pseudo', FILTER_SANITIZE_FULL_SPECIAL_CHARS)));
        $mail = strtolower(filter_input(INPUT_POST, 'mail1', FILTER_SANITIZE_EMAIL));
        $mail2 = strtolower(filter_input(INPUT_POST, 'mail2', FILTER_SANITIZE_EMAIL));
        $password2 = filter_input(INPUT_POST, 'password2', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $password1 = filter_input(INPUT_POST, 'password1', FILTER_VALIDATE_REGEXP, array(
            "options" => array("regexp" => 
            "/\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*/")));

        // Verification des input
        if($mail!=$mail2)
            $this->failedRegister('Les mails ne sont pas identiques');
        if(strlen($password1)!=strlen($password2))
            $this->failedRegister("Ce mot de passe n'est pas valide");
        if($password1!=$password2)
            $this->failedRegister('Les mots de passe ne sont pas identiques');
        $userManager = new UserManager();
        if($userManager->findOneByColumn('email', $mail))
            $this->failedRegister("Cette adresse mail est déjà utilisée");
        if($userManager->findOneByColumn('pseudonyme', $pseudo))
            $this->failedRegister("Ce pseudo est déjà utilisée");
        if(!$mail)
            $this->failedRegister("Cet email n'est pas valide");
        if(strlen($password1)<8)
            $this->failedRegister("Le mot de passe est trop court");

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

        // redirect to register with failed message
        public function failedRegister($message){
            Session::addFlash(Session::CATEGORIE_ERROR, $message);
            $this->redirectTo("security", "register");
        }

        public function editUser($id){
        }

        public function submitEditUser($id){
            $userManager = new UserManager();

            $userManager->edit(["pseudonyme" => "User8", "role" =>"admin"], $id);
            Session::setUser($userManager->findOneById($id));
            $this->redirectTo("security", "editUser");
        }
    }