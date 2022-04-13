<?php

namespace App\Services;

use App\Models\Result;
use App\Repositories\Result\ResultRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use App\Models\User;

class ResultService
{
	protected $resultRepository;

	public function __construct(
		ResultRepositoryInterface $resultRepository
	) {
		$this->resultRepository = $resultRepository;
	}

	public function getAll(): Collection
	{
		return $this->resultRepository->all();
	}

	// public function getQuestionsAndAnswers(Result $result) : Result
	// {

	// 	return $result->load([
	// 		'questions:id,name,description',
	// 		'questions.answers:id,name,description,question_id'
	// 	]);
	// }

	// public function getByResultId(Result $result): array
	// {
	// 	$result = $this->getQuestionsAndAnswers($result);
	// 	return [
	// 		'result' => $result,
	// 	];
	// }

	public function update(int $resultId, array $data)
	{
		return $this->resultRepository->find($resultId)->update($data);
	}

	public function delete(int $resultId)
	{
		return $this->resultRepository->find($resultId)->delete();
	} 


	public function createResult(array $data,User $user)
	{
		
		$data = [
			'user_id' => $user->id,
			'exam_id' => $data['id'],
		];
		return $this->resultRepository->store($data);
	}
}
