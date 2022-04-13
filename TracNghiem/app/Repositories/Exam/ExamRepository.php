<?php

namespace App\Repositories\Exam;

use App\Models\Exam;
use App\Repositories\RepositoryAbstract;
use DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class ExamRepository extends RepositoryAbstract implements ExamRepositoryInterface
{
	public function __construct(Exam $exam)
	{
		$this->model = $exam;
	}

	
}
