<?php

namespace App\Services;

use App\Models\Exam;
use App\Repositories\Exam\ExamRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class ExamService
{
	protected $examRepository;

	public function __construct(
		ExamRepositoryInterface $examRepository
	) {
		$this->examRepository = $examRepository;
	}

	public function getAll(): Collection
	{
		return $this->examRepository->all();
	}

	public function getQuestionsAndAnswers(Exam $exam) : Exam
	{

		return $exam->load([
			'questions:id,name,description',
			'questions.answers:id,name,description,question_id'
		]);
	}

	public function getByExamId(Exam $exam): array
	{
		$exam = $this->getQuestionsAndAnswers($exam);
		return [
			'exam' => $exam,
		];
	}

	public function checkSubmit(array $data)
	{
		// $exam = $this->examRepository->find($data['id']);
		// $score = 0;
		// $total = 0;
		// foreach ($data['answers'] as $key => $value) {
		// 	$total++;
		// 	if ($value == $exam->questions[$key]->correct_answer) {
		// 		$score++;
		// 	}
		// }
		// $percentage = ($score / $total) * 100;
		// $result = [
		// 	'user_id' => $user->id,
		// 	'exam_id' => $data['id'],
		// 	'score' => $score,
		// 	'percentage' => $percentage,
		// ];
		// $this->examRepository->store($result);
	}

	public function update(int $examId, array $data)
	{
		return $this->examRepository->find($examId)->update($data);
	}
}
