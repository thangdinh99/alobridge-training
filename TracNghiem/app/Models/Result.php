<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $table = 'results';

    protected $fillable = [
        'user_id',
        'exam_id',
        'score',
        'percentage',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function resultQuestionAnswer()
    {
        return $this->hasMany(Exam::class, 'exam_id', 'id');
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class, 'exam_id', 'id');
    }
}
