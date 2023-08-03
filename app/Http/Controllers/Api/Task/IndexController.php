<?php

namespace App\Http\Controllers\Api\Task;

use App\Http\Controllers\Controller;
use App\Http\Filters\TaskFilter;
use App\Http\Requests\Api\Task\IndexRequest;
use App\Http\Resources\Api\Task\TaskResource;
use App\Http\Response\ApiResponse;
use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IndexController extends Controller
{
    public function __invoke(IndexRequest $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();

        $filter = app()->make(TaskFilter::class, ['queryParams' => array_filter($data)]);

        $tasks = Task::filter($filter)->where('user_id', auth()->id())->get();

        return ApiResponse::json(
            'Resource tasks list.',
            data: TaskResource::collection($tasks),
            httpCode: Response::HTTP_OK
        );
    }
}
