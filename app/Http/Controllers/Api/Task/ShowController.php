<?php

namespace App\Http\Controllers\Api\Task;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Task\TaskResource;
use App\Http\Response\ApiResponse;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceResponse;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ShowController extends Controller
{
    public function __invoke(Request $request, Task $task): \Illuminate\Http\JsonResponse
    {
        return ApiResponse::json(
            'Resource task item.',
            new TaskResource($task),
            Response::HTTP_OK
        );
    }
}
