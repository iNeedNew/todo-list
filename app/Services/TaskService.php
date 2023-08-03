<?php

namespace App\Services;

use App\Enum\TaskStatus;
use App\Models\Task;

class TaskService
{
    /**
     * Do subtasks have todo status
     * @param Task $task
     * @return bool
     */
    public function canMarkTaskAsDone(Task $task): bool
    {
        return $this->hasChildrenTodoStatus($task);
    }

    /**
     * Recursive function to check if any children task has status 'done'
     * @param Task $task
     * @return bool
     */
    private function hasChildrenTodoStatus(Task $task): bool
    {
        foreach ($task->children ?? [] as $child) {

            if ($child->status == TaskStatus::TODO) return true;

            if ($this->hasChildrenTodoStatus($child)) return true;
        }
        return false;
    }

    /**
     * Recursive function to get all children
     * @param Task $task
     * @param array $children
     * @return array
     */
    public function getTaskChildren(Task $task, array $children = []): array
    {
        foreach ($task->children ?? [] as $child) {

            $children[] = $child;

            $this->getTaskChildren($child, $children);
        }
        return $children;
    }
}
