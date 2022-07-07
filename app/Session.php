<?php
    namespace App;

    class Session{

        const CATEGORIE_ERROR = 'error';
        const CATEGORIE_SUCCESS = 'success';

        /**
        *   ajoute un message en session, dans la catégorie $categ
        *   @param const $categ une constante CATEGORIE
        *   @param String $msg le message a envoyé
        */
        public static function addFlash($categ, $msg){
            $_SESSION[$categ] = $msg;
        }

        /**
        *   renvoie un message de la catégorie $categ, s'il y en a !
        *   @param const $categ une constante CATEGORIE
        */
        public static function getFlash($categ){
            
            if(isset($_SESSION[$categ])){
                $msg = $_SESSION[$categ];  
                unset($_SESSION[$categ]);
            }
            else $msg = "";
            
            return $msg;
        }

        /**
        *   met un user dans la session (pour le maintenir connecté)
        */
        public static function setUser($user){
            $_SESSION["user"] = $user;
        }

        public static function getUser(){
            return (isset($_SESSION['user'])) ? $_SESSION['user'] : false;
        }

        /**
         *  met un token en session pour la protection contre la faille CSRF
         */
        public static function setTokenCSRF($token){
            $_SESSION["tokenCSRF"] = $token;
        }

        public static function getTokenCSRF(){
            return (isset($_SESSION['tokenCSRF'])) ? $_SESSION['tokenCSRF'] : false;
        }

        public static function isAdmin(){
            if(self::getUser() && self::getUser()->hasRole("ROLE_ADMIN")){
                return true;
            }
            return false;
        }

    }