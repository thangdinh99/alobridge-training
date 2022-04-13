<?php

namespace App\Repositories\Result;

use App\Models\Result;
use App\Repositories\RepositoryAbstract;
use DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class ResultRepository extends RepositoryAbstract implements ResultRepositoryInterface
{
	public function __construct(Result $result)
	{
		$this->model = $result;
	}

	
}
