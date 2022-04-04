<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use SoftDeletes;
    protected $table = 'questions';

    public function examQuestion()
    {
        return $this->hasMany(ExamQuestion::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function resultQuestionAnswer()
    {
        return $this->hasMany(ResultQuestionAnswer::class);
    }
}
