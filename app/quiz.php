<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class quiz extends Model
{
    protected $fillable = ['quiz','quiz_type','status','expiry_date','admin_id'];

    public function questions ()
    {
        return $this->hasMany(Question::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scores()
    {
        return $this->hasMany(Score::class);
    }

    public function addQuestion($question)
    {
        return $this->questions()->create(compact('question'));
    }

    public function addScore($score)
    {
        return $this->scores()->create(compact('score'));
    }
}
