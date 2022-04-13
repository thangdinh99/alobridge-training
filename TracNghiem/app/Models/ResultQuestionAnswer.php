<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResultQuestionAnswer extends Model
{
    protected $table = 'result_question_answer';

    public function result()
    {
        return $this->belongsTo(Result::class, 'result_id', 'id');
    }

    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id', 'id');
    }

    public function answer()
    {
        return $this->belongsTo(Answer::class, 'answer_id', 'id');
    }
}
