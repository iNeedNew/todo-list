<?php

namespace App\Http\Controllers\Api\Task;

use App\Enum\TaskStatus;
use App\Http\Controllers\Controller;
use App\Http\Response\ApiResponse;
use App\Models\Task;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DestroyController extends Controller
{
    public function __invoke(Request $request, Task $task): \Illuminate\Http\JsonResponse
    {

        if ($task->status == TaskStatus::DONE) {
            return ApiResponse::json(
                message: 'Task already marked as done.',
                httpCode: Response::HTTP_CONFLICT
            );
        }
        $task->delete();
        return ApiResponse::json(
            message: 'Resource task deleted.',
            httpCode: Response::HTTP_OK
        );

    }
}
