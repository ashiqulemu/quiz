<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['id','answer','question','option1','option2'];

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function quiz()
    {
        return $this->belongsTo(quiz::class);
    }

    public function addAnswers($answer, $correct)
    {
        return $this->answers()->create([
            'answer' => $answer,
            'correct' => $correct
        ]);
    }
}
