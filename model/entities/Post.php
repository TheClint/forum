<?php

namespace Model\Entities;

use App\Entity;
use DateTime;

Class Post extends Entity{

    private int $id;
    private DateTime $messageDate;
    private String $text;
    private User $user;
    private Topic $topic;

    public function __construct($data){
        $this->hydrate($data);
    }

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getMessageDate(){
        return $this->messageDate->format("d-m-Y H:i:s");
    }

    public function setMessageDate($messageDate){
        $this->messageDate = new DateTime($messageDate);
    }

    public function getText(){
        return $this->text;
    }

    public function setText($text){
        $this->text = $text;
    }

    public function getUser(){
        return $this->user;
    }

    public function setUser($user){
        $this->user = $user;
    }

    public function getTopic(){
        return $this->topic;
    }

    public function setTopic($topic){
        $this->topic = $topic;
    }
}