<?php

namespace App\Http\Controllers\Api\Task;

use App\Enum\TaskStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Task\UpdateRequest;
use App\Http\Resources\Api\Task\TaskResource;
use App\Http\Response\ApiResponse;
use App\Models\Task;

use App\Services\TaskService;
use Symfony\Component\HttpFoundation\Response;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, Task $task, TaskService $service): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();

        // If new parent_id equal id, then response error
        if (isset($data['parent_id']) && $data['parent_id'] == $task->id) {
            return ApiResponse::json(
                message: 'Parent id equals current entry.',
                httpCode: Response::HTTP_CONFLICT
            );
        }

        $task->update($data);
        $task->save();
        $task->refresh();

        return ApiResponse::json(
            'Update task successful.',
            new TaskResource($task),
            Response::HTTP_CREATED
        );
    }
}
