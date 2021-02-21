<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class quizAnswer extends Model
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
