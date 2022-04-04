<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Exam extends Model
{
    use SoftDeletes;
    protected $table = 'exams';

    public function userExams()
    {
        return $this->hasMany(UserExam::class);
    }

    public function examQuestions()
    {
        return $this->hasMany(ExamQuestion::class);
    }

}
