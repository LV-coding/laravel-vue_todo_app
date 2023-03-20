<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Http\Resources\Task\TaskListResource;
use Illuminate\Http\Request;
use App\Models\Task;
use response;

class IndexController extends Controller
{
    public function __invoke() {
        
        $user = auth('sanctum')->user()->id;
        $tasks = Task::where('user_id', $user)->where('is_done', '0')->orderBy('id', 'DESC')->get();

        if($tasks) {
            return TaskListResource::collection($tasks);
        }
        return response()->noContent();
    }
}
