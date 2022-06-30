<?php
namespace Model\Entities;

use App\Entity;

final Class Categorie extends Entity{

    private int $id;
    private String $name;

    public function __construct($data){
        $this->hydrate($data);
    }

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getName(){
        return $this->name;
    }

    public function setName($name){
        $this->name = $name;
    }

    public function __toString()
    {
        return "ceci est une categorie : ".$this->getName();
    }
}