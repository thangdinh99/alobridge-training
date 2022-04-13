<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Services\ExamService;
use App\Services\ResultService;
use Illuminate\Http\JsonResponse;
use App\Http\Traits\ResponseTrait;
use App\Http\Requests\SubmitExamRequest;

class ExamController extends Controller
{
    use ResponseTrait;
    protected $examService;
    protected $resultService;

    public function __construct(ExamService $examService,ResultService $resultService)
    {
        $this->examService = $examService;
        $this->resultService = $resultService;
    }

    public function list(Request $request) : JsonResponse
    {
        $exams = $this->examService->getAll();
        return $this->responseData(200, 'Success', $exams);
    }

    public function find(Exam $exam) : JsonResponse
    {
        $exam = $this->examService->getByExamId($exam);
        return $this->responseData(200, 'Success', $exam);
    }

    public function submitExam(SubmitExamRequest $request) : JsonResponse 
    {
        // dd($request->json()->all());
        $checkSubmit = $this->examService->checkSubmit($request->json()->all());
        $result = $this->resultService->createResult($request->json()->all(),Auth::user());
        $exam = (object)$request->json()->all();
        // dd($exam);
        return $this->responseData(200, 'Success', $request->json()->all());
    }
}
