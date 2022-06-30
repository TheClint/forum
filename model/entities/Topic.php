<?php
namespace Model\Entities;

use App\Entity;
use DateTime;

final Class Topic extends Entity{

    private int $id;
    private String $title;
    private DateTime $topicDate;
    private bool $isLocked;
    private Categorie $categorie;
    private User $user;

    public function __construct($data){
        $this->hydrate($data);
    }

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = (int)$id;
    }

    public function getTitle(){
        return $this->title;
    }

    public function setTitle($title){
        $this->title = $title;
    }

    public function getTopicDate(){
        return $this->topicDate->format("d-m-Y H:i:s");
    }

    public function setTopicDate($topicDate){
        $this->topicDate = new DateTime($topicDate);
    }

    public function getIsLocked(){
        return $this->isLocked;
    }

    public function setIsLocked($isLocked){
        $this->isLocked = $isLocked;
    }

    public function getCategorie(){
        return $this->categorie;
    }

    public function setCategorie($categorie){
        $this->categorie = $categorie;
    }

    public function getUser(){
        return $this->user;
    }

    public function setUser($user){
        $this->user = new User($user);
    }

    public function __toString()
    {
        return "ceci est un topic : ".$this->getTitle();
    }
}