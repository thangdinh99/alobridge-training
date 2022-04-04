<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $table = 'exams';

    public function userExams()
    {
        return $this->hasMany(UserExam::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

}
