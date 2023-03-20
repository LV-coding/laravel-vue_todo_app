<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Http\Requests\Task\TaskStoreRequest;
use App\Http\Resources\Task\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function __invoke(TaskStoreRequest $request) {

        $data = $request->validated();
        $data['user_id'] = auth('sanctum')->user()->id;
        $task = Task::create($data);

        return TaskResource::collection([$task]);
    }
}
