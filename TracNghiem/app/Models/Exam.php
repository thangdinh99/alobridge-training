<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Exam extends Model
{
    use SoftDeletes;
    protected $table = 'exams';

    public function results()
    {
        return $this->hasMany(Result::class, 'exam_id', 'id');
    }

    // public function examQuestions()
    // {
    //     return $this->hasMany(ExamQuestion::class, 'exam_id', 'id');
    // }

    public function questions()
    {
        return $this->belongsToMany(Question::class, 'exam_question', 'exam_id', 'question_id');
    }
    
}
