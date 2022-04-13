<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Console\Question\Question;
use Illuminate\Database\Eloquent\SoftDeletes;

class Answer extends Model
{
    use SoftDeletes;
    protected $table = 'answers';

    protected $fillable = [
        'id',
        'name'
    ];

    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id', 'id');
    }
}
