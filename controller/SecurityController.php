<?php

    namespace Controller;

    use App\AbstractController;
    use App\ControllerInterface;
    use Exception;
    use Model\Managers\UserManager;
    use App\Session;

    class SecurityController extends AbstractController implements ControllerInterface{

        public function index(){

            return [
                "view" => VIEW_DIR."security\login.php"
            ];
        }

        public function submitLogin(){

            $userManager = new UserManager();

            try{
                if(isset($_POST['login'])){

                    $mail = filter_input(INPUT_POST, 'mail', FILTER_SANITIZE_EMAIL);
                    $user = $userManager->findOneByColumn('email', $mail);

                    if($user){
                        if(password_verify($_POST['password'], $user->getPassword())){
                            Session::setUser($user);
                            $message = "Vous êtes connecté";
                        }
                        else{
                            throw new Exception ("Le mot de passe n'est pas correct");
                        }
                    }
                    else
                        throw new Exception ("Le compte demandé n'existe pas");
                }
                else
                    throw new Exception("La connexion a échoué");
            }catch(Exception $e){
                $message = $e->getMessage();
            }
            return [
                "view" => VIEW_DIR."security\\register.php",
                "message" => $message
            ];   
        }

        // pour se déconnecter
        public function logout(){
            $_SESSION = array();

            return [
                "view" => VIEW_DIR."home.php"
            ];
        }

        public function register(){

            return [
                "view" => VIEW_DIR."security\\register.php"
            ];
        }

        public function submitRegister(){

            $userManager = new UserManager();

            try{
                if(isset($_POST['register'])){
                
                    if($_POST['mail1']!=$_POST['mail2'])
                        throw new Exception('Les mails ne sont pas identiques');
                    if($_POST['password1']!=$_POST['password2'])
                        throw new Exception('Les mots de passe ne sont pas identiques');
    
                    $pseudo = filter_input(INPUT_POST, 'pseudo', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    $mail = filter_input(INPUT_POST, 'mail1', FILTER_SANITIZE_EMAIL);
                    $password = password_hash($_POST['password1'], PASSWORD_DEFAULT);
                
                    $userManager->add([
                        'pseudonyme' => $pseudo,
                        'email' => $mail,
                        'password' => $password,
                    ]);
                    $message = "Votre inscription est un succès";
                }
                else
                    throw new Exception("L'opération a échoué");
            }catch(Exception $e){
                $message = $e->getMessage();
            }finally{
                return [
                    "view" => VIEW_DIR."security\\register.php",
                    "message" => $message
                ];
            }
        }
    }