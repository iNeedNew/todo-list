<?php

namespace App\Http\Controllers\Api\Task;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Task\StoreRequest;
use App\Http\Resources\Api\Task\TaskResource;
use App\Http\Response\ApiResponse;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();

        /** @var Task $task */
        $task = Auth::user()->tasks()->save(Task::create($data))->refresh();

        return ApiResponse::json(
            'Create task successful.',
            new TaskResource($task),
            Response::HTTP_CREATED
        );
    }
}
