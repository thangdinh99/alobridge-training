<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use SoftDeletes;
    protected $table = 'questions';

    // public function examQuestion()
    // {
    //     return $this->hasMany(ExamQuestion::class, 'question_id', 'id');
    // }

    public function answers()
    {
        return $this->hasMany(Answer::class, 'question_id', 'id');
    }

    public function resultQuestionAnswer()
    {
        return $this->hasMany(ResultQuestionAnswer::class, 'question_id', 'id');
    }

    public function exams(){
        return $this->belongsToMany(Exam::class, 'exam_question', 'question_id', 'exam_id');
    }
}
