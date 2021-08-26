<?php

class Game{
    private $objects;
    private $questions;
    public function __construct(){
        $this->objects = ["İNSAN", "KEDİ", "COMER"];
        $this->questions = [
            "Aklında tuttuğun şey canlı mı?",
            "Bu şey düşünebilir mi?",
            "Bu şey miyavlar mı?",
            "Bu şey bir yazılım mı?"
        ];
    }

    public function calculate($question, $answer){
        $response = array();
        $response["question"] = "";
        $response["object"] = "";

       
        if($question==$this->questions[0]){
            if($answer=="Evet"){
                $response["question"] = $this->questions[1];
            }else if($answer=="Hayır"){
                $response["question"] = $this->questions[3];
            }
        }
               
        if($question==$this->questions[1]){
            if($answer=="Evet"){
                $response["object"] = $this->objects[0];
            }else if($answer=="Hayır"){
                $response["question"] = $this->questions[2];
            }
        }
               
        if($question==$this->questions[2]){
            if($answer=="Evet"){
                $response["object"] = $this->objects[1];
            }else if($answer=="Hayır"){
                $response["question"] = $this->questions[0];
            }
        }
               
        if($question==$this->questions[3]){
            if($answer=="Evet"){
                $response["object"] = $this->objects[2];
            }else if($answer=="Hayır"){
                $response["question"] = $this->questions[0];
            }
        }

        return $response;
    }

    public function getObjects(){ return $this->objects; }

    public function getQuestions(){ return $this->questions; }

    public function getAnswersObjects(){ return $this->answersObjects; }

    public function getAnswersQuestions(){ return $this->answersQuestions; }
}