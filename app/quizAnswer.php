<?php
namespace App;



Class quizAnswer
{
    public $radio;
    public $id;
    public $quizid;
    public function __construct($radio,$id,$quizid){
        $this->radio=$radio;
        $this->id=$id;
        $this->quizid=$quizid;
        }
}
