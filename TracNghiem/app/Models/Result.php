<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $table = 'results';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function resultQuestionAnswer()
    {
        return $this->hasMany(Exam::class);
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }
}
