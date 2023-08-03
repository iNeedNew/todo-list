<?php

namespace App\Http\Controllers\Api\Task;

use App\Enum\TaskStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Task\ChangeStatusRequest;
use App\Http\Resources\Api\Task\TaskResource;
use App\Http\Response\ApiResponse;
use App\Models\Task;
use App\Services\TaskService;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Response;

class ChangeStatusController extends Controller
{
    public function __invoke(ChangeStatusRequest $request, Task $task, TaskService $service): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();

        // If sub-tasks have status todo then response error
        if ($data['status'] == TaskStatus::DONE && $service->canMarkTaskAsDone($task)) {
            return ApiResponse::json(
                message: 'Subtasks have todo status.',
                httpCode: Response::HTTP_CONFLICT
            );
        }

        $task->update($data);

        if ($data['status'] == TaskStatus::DONE) {
            $task->completed_at = now();
        } else {
            $task->completed_at = null;
        }

        $task->save();
        $task->refresh();

        return ApiResponse::json(
            'Update task status successful.',
            new TaskResource($task),
            Response::HTTP_CREATED
        );
    }
}
