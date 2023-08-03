<?php

namespace App\Http\Middleware\Api;

use App\Http\Response\ApiResponse;
use App\Models\Task;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class CheckTaskAuthor
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $taskId = $request->route('task')->id;

        $task = Task::findOrFail($taskId);

        if ($task->user_id !== auth()->user()->id) {
            return ApiResponse::json(
                message: 'Auth user is not the author of this task.',
                httpCode: Response::HTTP_FORBIDDEN
            );
        }
        return $next($request);
    }
}
