<?php

namespace Model\Entities;

use App\Entity;
use DateTime;

final Class User extends Entity {

    private int $id;
    private String $pseudonyme;
    private DateTime $registerDate;
    private String $email;
    private String $password;
    private String $role;
    private bool $estBanni;
    
    public function __construct($data){

        if(is_array($data)){ //dans le cas où les données arrivent sous forme de tableau
            $this->hydrate($data);
        }elseif(get_class($data)==__CLASS__){ // dans le cas où les donnés arrivent sous forme de class

            $class_vars = get_class_vars(__CLASS__);

            foreach ($class_vars as $name => $attribut) {
                $methodSet = "set".ucfirst($name);
                $methodGet = "get".ucfirst($name);
                $this->$methodSet($data->$methodGet())   ;
            }      
        }
    }

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getPseudonyme(){
        return $this->pseudonyme;
    }

    public function setPseudonyme($pseudonyme){
        $this->pseudonyme = $pseudonyme;
    }

    public function getRegisterDate(){
        return $this->registerDate->format("d-m-Y H:i:s");
    }

    public function setRegisterDate($registerDate){
        $this->registerDate = new DateTime($registerDate);
    }

    public function getEmail(){
        return $this->email;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function getPassword(){
        return $this->password;
    }

    public function setPassword($password){
        $this->password = $password;
    }

    public function getRole(){
        return $this->role;
    }

    public function setRole($role){
        $this->role = $role;
    }

    public function getEstBanni(){
        return $this->estBanni;
    }

    public function setEstBanni($estBanni){
        $this->estBanni = $estBanni;
    }

    public function __toString()
    {
        return "ceci est un utilisateur : ".$this->getPseudonyme();
    }
}